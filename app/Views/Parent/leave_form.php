<?php
// app/Views/Parent/leave_form.php
$mode   = $mode ?? 'create';
$action = ($mode === 'edit') ? '?action=update' : '?action=store';
$btn    = ($mode === 'edit') ? 'Update Request' : 'Submit Request';
?>
<div class="main-box">
  <h2><?= $mode === 'edit' ? 'Edit Leave Request' : 'Submit Leave Request' ?></h2>
  <?php if (!empty($_GET['error'])): ?>
    <div class="badge" style="background:#ffd9d9;color:#a00;margin:8px 0;">
      <?= htmlspecialchars($_GET['error']) ?>
    </div>
  <?php endif; ?>

  <form class="leave-request-form" action="<?= $action ?>" method="post">
    <?php if (!empty($data['request_id'])): ?>
      <input type="hidden" name="request_id" value="<?= (int)$data['request_id'] ?>">
    <?php endif; ?>

    <?php if (!empty($studentID)): ?>
      <input type="hidden" name="student_id" value="<?= (int)$studentID ?>">
    <?php endif; ?>
    <?php if (!empty($studentName)): ?>
      <input type="hidden" name="student_name" value="<?= htmlspecialchars($studentName) ?>">
    <?php endif; ?>

    <div class="date-row">
      <div class="form-group">
        <label for="from-date">From Date</label>
        <input type="date" id="from-date" name="from_date" class="input-date"
               value="<?= htmlspecialchars($data['from_date'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label for="to-date">To Date</label>
        <input type="date" id="to-date" name="to_date" class="input-date"
               value="<?= htmlspecialchars($data['to_date'] ?? '') ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="reason-details">Reason</label>
      <textarea id="reason-details" name="reason_details" class="textarea-details"
                rows="3" required><?= htmlspecialchars($data['reason_details'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn-submit"><?= $btn ?></button>
    <a href="?action=index" class="badge" style="margin-left:8px;">Back</a>
  </form>
</div>
