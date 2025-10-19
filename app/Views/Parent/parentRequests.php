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
            <div class="request-sub-date">

            </div>
          </div>
          <?php if (!empty($req['status'])): ?>
            <span
              class="status-badge <?php echo strtolower($req['status']); ?>"><?php echo htmlspecialchars(ucfirst($req['status'])); ?></span>
          <?php endif; ?>
          <div class="request-action">
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