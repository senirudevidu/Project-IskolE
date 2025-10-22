<div class="content-sections">
  <div>
    <h2>School Announcements</h2>
  </div>
  <div class="subtitle">Information updates and notification.</div>

  <?php
  require_once __DIR__ . '/../../Controllers/announcement/readAnnouncementController.php';
  $controller = new ReadAnnouncementController();
  $announcements = $controller->getAllAnnouncements();
  ?>

  <?php if (!empty($announcements)): ?>
    <?php foreach ($announcements as $a): ?>
      <?php
      $title = htmlspecialchars($a['title'] ?? '');
      $content = nl2br(htmlspecialchars($a['content'] ?? ''));
      $createdAt = null;
      if (!empty($a['created_at'])) {
        try {
          $createdAt = new DateTime($a['created_at']);
        } catch (Exception $e) {
          $createdAt = null;
        }
      }
      $dateStr = $createdAt ? $createdAt->format('j F Y, h:i A') : '';
      ?>
      <div class="announcement-card">
        <div class="announcement-info">
          <h4><?php echo $title; ?></h4>
          <p><?php echo $content; ?></p>
        </div>
        <div class="announcement-status">
          <div class="date-line">
            <?php if ($dateStr !== ''): ?><span class="time"> <?php echo $dateStr; ?></span><?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="announcement-card">
      <div class="announcement-info">
        <h4>No announcements</h4>
        <p>There are no recent announcements.</p>
      </div>
    </div>
  <?php endif; ?>
</div>