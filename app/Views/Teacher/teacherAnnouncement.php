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
                <button class="edit-announcement-btn" data-id="<?php echo $announcement['announcement_id'] ?? ''; ?>">Edit</button>
                <button class="delete-announcement-btn" data-id="<?php echo $announcement['announcement_id'] ?? ''; ?>">Delete</button>
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
          <option value="5">Parents & Students</option>
          <option value="8">Parents</option>
          <option value="9">Students</option>
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

  <!-- Edit Announcement Popup Modal -->
  <div id="editAnnouncementModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
    <div class="modal-content" style="background:#fff; margin:5% auto; padding:20px; border-radius:8px; width:90%; max-width:500px; position:relative;">
      <span class="close-modal" style="position:absolute; top:10px; right:15px; font-size:24px; cursor:pointer;">&times;</span>
      <h2>Edit Announcement</h2>
      <form id="editAnnouncementForm" method="POST" action="../../Controllers/announcement/updateAnnouncementController.php">
        <input type="hidden" name="announcement_id" id="edit-announcement-id" />
        <input type="hidden" name="published_by" id="edit-published-by" value="<?php echo $_SESSION['userID'] ?? ''; ?>" />
        <input type="hidden" name="role" id="edit-role" value="<?php echo $_SESSION['role'] ?? ''; ?>" />
        <div class="announcement-form">
          <label for="edit-announcement-title" class="announcement-label">Title:</label>
          <input type="text" id="edit-announcement-title" name="title" class="announcement-input" required />

          <label for="edit-message" class="announcement-label">Announcement Content:</label>
          <textarea id="edit-message" name="content" class="announcement-textarea" rows="6" required></textarea>

          <label for="edit-target-audience" class="announcement-label">Target Audience:</label>
          <select id="edit-target-audience" name="audienceID" class="announcement-select" required>
            <option value="">Select Audience</option>
            <option value="6">Students</option>
            <option value="5">Parents</option>
            <option value="7">Students & Parents</option>
          </select>
        </div>
        <div class="submit-btn">
          <button type="submit" class="publish-announcement-btn">Update Announcement</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Open modal and populate form
    document.querySelectorAll('.edit-announcement-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var item = btn.closest('.announcement-item');
        document.getElementById('edit-announcement-id').value = btn.getAttribute('data-id');
        document.getElementById('edit-announcement-title').value = item.querySelector('.announcement-title').textContent.trim();
        document.getElementById('edit-message').value = item.querySelector('.announcement-content').textContent.trim();
        // Try to get the audience value from the receiver span
        var audience = item.querySelector('.announcemt-receiver')?.textContent.trim();
        var select = document.getElementById('edit-target-audience');
        if (audience === 'Students') select.value = '6';
        else if (audience === 'Parents') select.value = '5';
        else if (audience === 'Students & Parents') select.value = '7';
        else select.value = '';
        document.getElementById('editAnnouncementModal').style.display = 'block';
      });
    });
    // Close modal
    document.querySelector('.close-modal').onclick = function() {
      document.getElementById('editAnnouncementModal').style.display = 'none';
    };
    // Close modal when clicking outside
    window.onclick = function(event) {
      var modal = document.getElementById('editAnnouncementModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    };
  </script>
</section>