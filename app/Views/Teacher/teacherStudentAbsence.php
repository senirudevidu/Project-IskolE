<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../../Controllers/leaveReqController.php';
$leaveController = new LeaveReqController();
$absences = $leaveController->getAbsenceRequestsForCurrentTeacher(null, 20);
?>
<!--Nav7 : student-absence-request-->
<section class="student-absence tab-panel">
  <div class="view-student-absence">
    <div class="heading">
      <h1 class="first-heading">Student Absence Requests</h1>
      <p class="first-description">Review and manage student absence requests</p>
    </div>

    <div class="requests-list">
      <?php if (!empty($absences)): ?>
        <?php foreach ($absences as $req): ?>
          <?php
          $fromTs = isset($req['from_date']) && $req['from_date'] !== '' ? strtotime($req['from_date']) : false;
          $toTs = isset($req['to_date']) && $req['to_date'] !== '' ? strtotime($req['to_date']) : false;
          $fromFmt = $fromTs ? date('F j, Y', $fromTs) : 'N/A';
          $toFmt = $toTs ? date('F j, Y', $toTs) : 'N/A';
          $studentName = trim(($req['fName'] ?? '') . ' ' . ($req['lName'] ?? ''));
          $classStr = (isset($req['grade']) ? $req['grade'] : '-') . '-' . (isset($req['class']) ? $req['class'] : '-');
          ?>
          <div class="request-card">
            <div class="request-info">
              <div class="request-date">
                <?php echo htmlspecialchars($fromFmt . ' - ' . $toFmt); ?>
              </div>
              <div class="request-reason"><?php echo htmlspecialchars($req['reason'] ?? ''); ?></div>
              <div class="request-sub-date">Student: <?php echo htmlspecialchars($studentName ?: 'Unknown'); ?>
                (<?php echo htmlspecialchars($classStr); ?>)</div>
            </div>
            <div class="request-action">
              <!-- Actions (approve/reject) can be added here later for teachers -->
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="request-card">
          <div class="request-info">
            <div class="request-reason">No absence requests found.</div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>