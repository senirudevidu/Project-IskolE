<?php
$mode   = $mode ?? 'create';
$btn    = $mode === 'edit' ? 'Update Request' : 'Submit Request';
$apiUrl = 'leave_api.php';  // <<< CHANGE ONLY if your folder isn’t /projectiskole
?>
<div class="main-box">
  <h3><?= $mode==='edit' ? 'Edit Leave Request' : 'Submit Leave Request' ?></h3>

  <form id="leave-form" class="leave-request-form">
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
      <textarea id="reason-details" name="reason_details" class="textarea-details" required><?= htmlspecialchars($data['reason_details'] ?? '') ?></textarea>
    </div>

    <!-- action button -->
    <button type="submit" class="btn-submit"><?= $btn ?></button>
    <a class="badge" href="?action=index" style="margin-left:8px;">Back</a>
  </form>
</div>

<script>
(function () {
  const form = document.getElementById('leave-form');
  const API  = "<?= $apiUrl ?>";
  const action = "<?= $mode === 'edit' ? 'update' : 'store' ?>";

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const fd = new FormData(form);
    fd.set('action', action);

    try {
      const res  = await fetch(API, { method: 'POST', body: fd });
      const json = await res.json();
      if (res.ok && json.ok) {
        alert(json.message || 'Submitted successfully ✅');
        if (action === 'store') form.reset();
      } else {
        alert(json.message || 'Submit failed.');
      }
    } catch (err) {
      alert('Network error.');
    }
  });
})();
</script>
