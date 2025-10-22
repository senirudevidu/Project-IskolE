<?php
require_once __DIR__ . '/../../Controllers/announcementController.php';

$announcementController = new AnnouncementController();
$allAnnouncements = $announcementController->getAllAnnouncements();

$parentAnnouncements = array_filter($allAnnouncements, function($announcement) {
    return in_array($announcement['audienceID'], [1, 4, 5, 8]);
});
?>

<div class="container">
  <div class="view-announcements">
    <div class="heading">
      <h1 class="first-heading">Recent Announcements</h1>
      <p class="first-description">Announcements from heads</p>
    </div>

    <div class="announcement-list">
      <?php if (!empty($parentAnnouncements)): ?>
        <?php foreach ($parentAnnouncements as $announcement): ?>
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></h2>
              <span class="announcemt-sender">
                From: <?php echo htmlspecialchars($announcement['published_by'] . ' (' . $announcement['role'] . ')'); ?>
              </span>
              <p class="announcement-content">
                <?php echo nl2br(htmlspecialchars($announcement['content'])); ?>
              </p>
            </div>
            <p class="announcement-date">
              Date: <?php echo date('Y-m-d', strtotime($announcement['created_at'])); ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="announcement-item">
          <div class="announcement-item-container1">
            <p class="announcement-content" style="text-align: center; color: #666;">
              No announcements available at the moment.
            </p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>