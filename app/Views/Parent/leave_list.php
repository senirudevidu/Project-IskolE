<?php
// app/Views/Parent/leave_list.php
?>
<div class="main-box">
  <h2>Leave Requests</h2>

  <?php if (!empty($_GET['ok'])): ?>
    <script>
      (function() {
        const map = { saved: 'Submitted successfully ✅', updated: 'Updated successfully ✅', deleted: 'Deleted successfully 🗑️' };
        alert(map['<?= addslashes($_GET['ok']) ?>'] || 'Done.');
      })();
    </script>
  <?php endif; ?>

  <p><a class="download-btn" href="?action=create">+ New Leave Request</a></p>

  <?php if (empty($rows)): ?>
    <p>No leave requests yet.</p>
  <?php else: ?>
    <table class="table">
      <thead>
        <tr>
          <td>ID</td><td>From</td><td>To</td><td>Reason</td><td>Action</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= (int)$r['request_id'] ?></td>
            <td><?= htmlspecialchars($r['from_date']) ?></td>
            <td><?= htmlspecialchars($r['to_date']) ?></td>
            <td><?= htmlspecialchars($r['reason']) ?></td>
            <td style="white-space:nowrap;">
              <a class="badge" href="?action=edit&id=<?= (int)$r['request_id'] ?>">Edit</a>
              <form method="post" action="?action=delete" style="display:inline"
                    onsubmit="return confirm('Delete this request?');">
                <input type="hidden" name="request_id" value="<?= (int)$r['request_id'] ?>">
                <button type="submit" class="download-btn" style="background:#dc3545;color:#fff;border:none;">Remove</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
