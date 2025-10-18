<div class="main-box">
  <h3>Leave Requests</h3>
  <p><a class="download-btn" href="?action=create">+ New Leave Request</a></p>

  <?php if (empty($rows)): ?>
    <p>No leave requests yet.</p>
  <?php else: ?>
    <table class="table">
      <thead>
        <tr><td>ID</td><td>From</td><td>To</td><td>Reason</td><td>Action</td></tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['request_id']) ?></td>
            <td><?= htmlspecialchars($r['from_date']) ?></td>
            <td><?= htmlspecialchars($r['to_date']) ?></td>
            <td><?= htmlspecialchars($r['reason']) ?></td>
            <td style="white-space:nowrap;">
              <a class="badge" href="?action=edit&id=<?= (int)$r['request_id'] ?>">Edit</a>
              <form method="post" action="?action=delete" style="display:inline">
                <input type="hidden" name="request_id" value="<?= (int)$r['request_id'] ?>">
                <button type="submit" class="download-btn">Remove</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
