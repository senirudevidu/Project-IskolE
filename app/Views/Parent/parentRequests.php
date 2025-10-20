<?php
// Start session and include controller to fetch recent leave requests
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../../Controllers/leaveReqController.php';
$leaveController = new LeaveReqController();
$recentRequests = $leaveController->getRecentLeaveRequestsForCurrentUser(5);
?>
<div class="container">
  <div class="heading-section">
    <div class="heading-text">Absence Reason Status</div>
    <div class="sub-heading-text">
      Track your submitted absence reasons
    </div>
  </div>

  <div class="requests-list">
    <?php if (!empty($recentRequests)): ?>
      <?php foreach ($recentRequests as $req): ?>
        <div class="request-card">
          <div class="request-info">
            <?php
            $fromTs = isset($req['from_date']) && $req['from_date'] !== null && $req['from_date'] !== '' ? strtotime($req['from_date']) : false;
            $toTs = isset($req['to_date']) && $req['to_date'] !== null && $req['to_date'] !== '' ? strtotime($req['to_date']) : false;
            $fromFmt = $fromTs ? date('F j, Y', $fromTs) : 'N/A';
            $toFmt = $toTs ? date('F j, Y', $toTs) : 'N/A';
            ?>
            <div class="request-date">
              <?php echo htmlspecialchars($fromFmt . ' - ' . $toFmt); ?>
            </div>
            <div class="request-reason"><?php echo htmlspecialchars($req['reason'] ?? ''); ?></div>
            <div class="request-sub-date"></div>
          </div>
          <?php if (!empty($req['status'])): ?>
            <span
              class="status-badge <?php echo strtolower($req['status']); ?>"><?php echo htmlspecialchars(ucfirst($req['status'])); ?></span>
          <?php endif; ?>
          <div class="request-action" style="display:flex; gap:8px;">
            <?php
            $fromInput = $fromTs ? date('Y-m-d', $fromTs) : '';
            $toInput = $toTs ? date('Y-m-d', $toTs) : '';
            ?>
            <button type="button" class="btn btn-primary btn-edit-leave"
              data-id="<?php echo isset($req['request_id']) ? (int) $req['request_id'] : (isset($req['id']) ? (int) $req['id'] : 0); ?>"
              data-from="<?php echo htmlspecialchars($fromInput); ?>" data-to="<?php echo htmlspecialchars($toInput); ?>"
              data-reason="<?php echo isset($req['reason']) ? htmlspecialchars($req['reason'], ENT_QUOTES) : ''; ?>">
              Edit
            </button>
            <form method="POST" action="../../Controllers/leaveReqController.php"
              onsubmit="return confirm('Delete this request?');">
              <input type="hidden" name="delete_request_id"
                value="<?php echo isset($req['request_id']) ? (int) $req['request_id'] : (isset($req['id']) ? (int) $req['id'] : 0); ?>">
              <button class="btn btn-red rejected" type="submit">Delete</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="request-card">
        <div class="request-info">
          <div class="request-reason">No recent absence requests.</div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="container">
    <div class="heading-section">
      <div class="heading-text">Submit Absence Request</div>
      <div class="sub-heading-text">Request absence in advance</div>
    </div>

    <form class="leave-request-form" action="../../Controllers/leaveReqController.php" method="POST">
      <div class="date-row">
        <div class="form-group">
          <label for="from-date">From Date</label>
          <input type="date" id="from-date" name="fromDate" class="input-date" placeholder="dd/mm/yyyy" />
        </div>
        <div class="form-group">
          <label for="to-date">To Date</label>
          <input type="date" id="to-date" name="toDate" class="input-date" placeholder="dd/mm/yyyy" />
        </div>
      </div>

      <div class="form-group">
        <label for="reason">Reason</label>
        <textarea id="reason" name="reason" class="textarea-details" placeholder="Provide necessary details"></textarea>
      </div>

      <button type="submit" class="btn-submit">Submit Request</button>
    </form>
  </div>
</div>

<!-- Edit Leave Modal -->
<div id="editLeaveModal" class="modal-backdrop">
  <div class="modal-card">
    <div class="modal-header">
      <h3>Edit Absence Request</h3>
      <button class="modal-close" aria-label="Close">×</button>
    </div>
    <form id="editLeaveForm" method="POST" action="../../Controllers/leaveReqController.php">
      <input type="hidden" name="edit_request_id" value="">
      <div class="modal-body">
        <div class="date-row">
          <div class="form-group">
            <label for="edit-from-date">From Date</label>
            <input type="date" id="edit-from-date" name="fromDate" class="input-date" />
          </div>
          <div class="form-group">
            <label for="edit-to-date">To Date</label>
            <input type="date" id="edit-to-date" name="toDate" class="input-date" />
          </div>
        </div>
        <div class="form-group">
          <label for="edit-reason">Reason</label>
          <textarea id="edit-reason" name="reason" class="textarea-details" placeholder="Update details"></textarea>
        </div>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary modal-cancel">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script src="/public/js/parent/parentRequests.js"></script>