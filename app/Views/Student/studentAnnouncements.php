<?php
require_once __DIR__ . '/../../Controllers/announcementController.php';

$announcementController = new AnnouncementController();
$allAnnouncements = $announcementController->getAllAnnouncements();

$studentAnnouncements = array_filter($allAnnouncements, function($announcement) {
    return in_array($announcement['audienceID'], [1, 3, 5, 9]);
});
?>

<div class="content-sections">
  <div>
    <h2>School Announcements</h2>
  </div>
  <div class="subtitle">Information updates and notification.</div>

  <?php if (!empty($studentAnnouncements)): ?>
    <?php foreach ($studentAnnouncements as $announcement): ?>
      <div class="announcement-card">
        <div class="announcement-info">
          <h4><?php echo htmlspecialchars($announcement['title']); ?></h4>
          <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
        </div>
        <div class="announcement-status">
          <div class="date-line">
            <span class="time">
              <?php 
                echo date('j F Y, h:i A', strtotime($announcement['created_at'])); 
              ?>
            </span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="announcement-card">
      <div class="announcement-info">
        <p style="text-align: center; color: #666;">
          No announcements available at the moment.
        </p>
      </div>
    </div>
  <?php endif; ?>
</div>