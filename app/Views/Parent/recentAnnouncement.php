<!-- <div class="content-section" id="events">
      <div class="container">
        <div class="heading-section">
          <div class="heading-text">School Events & Calender</div>
          <div class="sub-heading-text">
            Upcoming events and important dates
          </div>
        </div>

        <div class="events-list">
          <div class="event-card">
            <div class="event-info">
              <div class="event-name">Parent-Teacher Conference</div>
              <div class="event-date">Nov 22, 2025 • 2:00 PM - 4:00 PM</div>
            </div>
            <span class="event-badge">meeting</span>
          </div>
          <div class="event-card">
            <div class="event-info">
              <div class="event-name">Annual Science Fair</div>
              <div class="event-date">Dec 5, 2025 • 10:00 AM - 3:00 PM</div>
            </div>
            <span class="event-badge">fair</span>
          </div>
          <div class="event-card">
            <div class="event-info">
              <div class="event-name">Winter Break Begins</div>
              <div class="event-date">Dec 20, 2025</div>
            </div>
            <span class="event-badge">holiday</span>
          </div>
          <div class="event-card">
            <div class="event-info">
              <div class="event-name">Mathematics Competition</div>
              <div class="event-date">Jan 15, 2026 • 9:00 AM - 12:00 PM</div>
            </div>
            <span class="event-badge">competition</span>
          </div>
        </div>
      </div>
    </div> -->

<?php
require_once __DIR__ . '/../../Controllers/announcement/readAnnouncementController.php';
$announcementController = new ReadAnnouncementController();
$announcements = $announcementController->getAllAnnouncements();
?>
<div class="container">
  <div class="view-announcements">
    <div class="heading">
      <h1 class="first-heading">Recent Announcement</h1>
      <p class="first-description">Announcements from heads</p>
    </div>

    <div class="announcement-list">
      <!-- dynamic announcements will be rendered here -->
      <?php if (!empty($announcements)): ?>
        <?php foreach ($announcements as $ann): ?>
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title"><?= htmlspecialchars($ann['title']) ?></h2>
              <span class="announcemt-sender">From:
                <?= htmlspecialchars(!empty($ann['published_by']) ? $ann['published_by'] : ($ann['role'] ?? '')) ?></span>
              <p class="announcement-content">
                <?= nl2br(htmlspecialchars($ann['content'])) ?>
              </p>
            </div>
            <p class="announcement-date">Date:
              <?= isset($ann['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($ann['created_at']))) : '' ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="announcement-item">
          <div class="announcement-item-container1">
            <h2 class="announcement-title">No announcements</h2>
            <span class="announcemt-sender">From: System</span>
            <p class="announcement-content">There are no announcements at this time.</p>
          </div>
          <p class="announcement-date"></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>