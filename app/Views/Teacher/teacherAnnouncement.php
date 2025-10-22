<?php
require_once __DIR__ . '/../../Controllers/announcement/readAnnouncementController.php';

$announcementCtrl = new ReadAnnouncementController();
$announcements = [];
try {
  $announcements = $announcementCtrl->getAllAnnouncements();
} catch (Throwable $e) {
  $announcements = [];
}
?>
<!--Nav1 : Announcement-->
<section class="announcement-entry tab-panel active-tab">
  <div class="view-announcements">
    <div class="heading">
      <h1 class="first-heading">Recent Announcement</h1>
      <p class="first-description">Announcements from heads</p>
    </div>

    <div class="announcement-list">
      <?php if (!empty($announcements)): ?>
        <?php foreach ($announcements as $ann): ?>
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title"><?php echo htmlspecialchars($ann['title'] ?? ''); ?></h2>
              <span class="announcemt-sender">From:
                <?php echo htmlspecialchars($ann['role'] ?? ($ann['published_by'] ?? '')); ?></span>
              <p class="announcement-content">
                <?php echo nl2br(htmlspecialchars($ann['content'] ?? '')); ?>
              </p>
            </div>

            <p class="announcement-date">Date:
              <?php echo isset($ann['created_at']) && $ann['created_at'] ? date('Y-m-d', strtotime($ann['created_at'])) : ''; ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="announcement-item">
          <div class="announcement-item-container1">
            <h2 class="announcement-title">No announcements</h2>
            <p class="announcement-content">
              There are no announcements yet.
            </p>
          </div>

          <p class="announcement-date"></p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- <div class="published-announcements">
        <div class="heading">
          <h1 class="first-heading">Published Announcement</h1>
          <p class="first-description">Announcements published by you</p>
        </div>

        <div class="announcement-list">

          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title">Parents meeting</h2>
              <span class="announcemt-receiver">To: Parents</span>
              <p class="announcement-content">
                On 2025-10-02 we planned to have a parents meeting at 10.00 AM in the school auditorium.
              </p>
            </div>

            <div class="announcement-item-container2">
              <p class="announcement-date">Date: 2023-10-01</p>
              <div class="announcement-actions">
                <button class="edit-announcement-btn">Edit</button>
                <button class="delete-announcement-btn">Delete</button>
              </div>
            </div>
          </div> 

          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title">Parents meeting for Term</h2>
              <span class="announcemt-receiver">To: Students</span>
              <p class="announcement-content">
                On 2025-10-02 we planned to have a parents meeting at 10.00 AM in the school auditorium.
              </p>
            </div>

            <div class="announcement-item-container2">
              <p class="announcement-date">Date: 2023-10-02</p>
              <div class="announcement-actions">
                <button class="edit-announcement-btn">Edit</button>
                <button class="delete-announcement-btn">Delete</button>
              </div>
            </div>
          </div>

        </div>
      </div> -->

  <div class="create-announcement">
    <div class="heading">
      <h1 class="first-heading">Create Announcement</h1>
      <p class="first-description">
        Share important information with students and parents
      </p>
    </div>

    <form action="../../Controllers/announcement/addAnnouncementController.php" method="POST">
      <div class="announcement-form">
        <label for="announcement-title" class="announcement-label">Title:</label>
        <input type="text" id="announcement-title" name="title" class="announcement-input" placeholder="Enter title" />

        <label for="message" class="announcement-label">Announcement Content:</label>
        <textarea id="message" name="message" class="announcement-textarea"
          placeholder="Write your announcement here..." rows="6"></textarea>

        <label for="target-audience" class="announcement-label">Target Audience:</label>
        <select id="target-audience" name="group" class="announcement-select">
          <option value="null">Select Audience</option>
          <option value="">Students</option>
          <option value="parents">Parents</option>
          <option value="students&parent">Student & Parent</option>
        </select>
      </div>
      <!-- Submit Marks Button -->
      <div class="submit-btn">
        <button type="submit" class="publish-announcement-btn">
          Publish Announcement
        </button>
      </div>
    </form>
  </div>
</section>