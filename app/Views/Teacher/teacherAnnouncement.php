<?php
require_once __DIR__ . '/../../Controllers/announcement/readAnnouncementController.php';

$announcementCtrl = new ReadAnnouncementController();
$announcements = [];
$myAnnouncements = [];

try {
  $announcements = $announcementCtrl->getAllAnnouncements();
  $myAnnouncements = $announcementCtrl->getMyAnnouncements();
} catch (Throwable $e) {
  $announcements = [];
  $myAnnouncements = [];
}
?>
<!--Nav1 : Announcement-->
<section class="announcement-entry tab-panel active-tab">
  <!-- Recent Announcements Section -->
  <div class="view-announcements">
    <div class="heading">
      <h1 class="first-heading">Recent Announcements</h1>
      <p class="first-description">Announcements from heads</p>
    </div>

    <div class="announcement-list">
      <?php if (!empty($announcements)): ?>
        <?php foreach ($announcements as $announcement): ?>
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title"><?php echo htmlspecialchars($announcement['title'] ?? ''); ?></h2>
              <span class="announcemt-sender">
                From: <?php echo htmlspecialchars($announcement['role'] ?? $announcement['published_by'] ?? 'Unknown'); ?>
              </span>
              <p class="announcement-content">
                <?php echo nl2br(htmlspecialchars($announcement['content'] ?? '')); ?>
              </p>
            </div>
            <p class="announcement-date">
              Date: <?php echo isset($announcement['created_at']) && $announcement['created_at']
                      ? date('Y-m-d', strtotime($announcement['created_at']))
                      : 'N/A'; ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="announcement-item">
          <div class="announcement-item-container1">
            <h2 class="announcement-title">No Announcements</h2>
            <p class="announcement-content">There are no announcements yet.</p>
          </div>
          <p class="announcement-date"></p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Published Announcements Section -->
  <div class="published-announcements">
    <div class="heading">
      <h1 class="first-heading">Published Announcements</h1>
      <p class="first-description">Announcements published by you</p>
    </div>

    <div class="announcement-list">
      <?php if (!empty($myAnnouncements)): ?>
        <?php foreach ($myAnnouncements as $announcement): ?>
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></h2>
              <span class="announcemt-receiver"><?php echo htmlspecialchars($announcement['audienceName']); ?></span>
              <p class="announcement-content">
                <?php echo nl2br(htmlspecialchars($announcement['content'])); ?>
              </p>
            </div>
            <div class="announcement-item-container2">
              <p class="announcement-date"><?php echo htmlspecialchars($announcement['created_at']); ?></p>
              <div class="announcement-actions">
                <button class="edit-announcement-btn" data-id="<?php echo $announcement['id'] ?? ''; ?>">Edit</button>
                <button class="delete-announcement-btn" data-id="<?php echo $announcement['id'] ?? ''; ?>">Delete</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="no-announcements">You haven't published any announcements yet.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Create Announcement Section -->
  <div class="create-announcement">
    <div class="heading">
      <h1 class="first-heading">Create Announcement</h1>
      <p class="first-description">Share important information with students and parents</p>
    </div>

    <form action="../../Controllers/announcement/addAnnouncementController.php" method="POST">
      <div class="announcement-form">
        <label for="announcement-title" class="announcement-label">Title:</label>
        <input
          type="text"
          id="announcement-title"
          name="title"
          class="announcement-input"
          placeholder="Enter title"
          required />

        <label for="message" class="announcement-label">Announcement Content:</label>
        <textarea
          id="message"
          name="message"
          class="announcement-textarea"
          placeholder="Write your announcement here..."
          rows="6"
          required></textarea>

        <label for="target-audience" class="announcement-label">Target Audience:</label>
        <select id="target-audience" name="group" class="announcement-select" required>
          <option value="">Select Audience</option>
          <option value="students">Students</option>
          <option value="parents">Parents</option>
          <option value="students_and_parents">Students & Parents</option>
        </select>
      </div>

      <!-- Submit Button -->
      <div class="submit-btn">
        <button type="submit" class="publish-announcement-btn">
          Publish Announcement
        </button>
      </div>
    </form>
  </div>
</section>