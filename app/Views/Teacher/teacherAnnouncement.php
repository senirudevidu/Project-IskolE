<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../Controllers/announcementController.php';

$announcementController = new AnnouncementController();
$allAnnouncements = $announcementController->getAllAnnouncements();

$teacherReceivedAnnouncements = array_filter($allAnnouncements, function($announcement) {
    return in_array($announcement['audienceID'], [0, 1, 2, 4]);
});

// Filter announcements published by current teacher
//$currentTeacher = $_SESSION['username'] ?? '';
$currentTeacher = $_SESSION['userID'] ?? '';

$teacherPublishedAnnouncements = array_filter($allAnnouncements, function($announcement) use ($currentTeacher) {
    return $announcement['published_by'] === $currentTeacher;
});
?>

<!--Nav1 : Announcement-->
<section class="announcement-entry tab-panel active-tab">
  <!-- SECTION 1: Announcements FROM Management/Admin -->
  <div class="view-announcements">
    <div class="heading">
      <h1 class="first-heading">Recent Announcements</h1>
      <p class="first-description">Announcements from heads</p>
    </div>

    <div class="announcement-list">
      <?php if (!empty($teacherReceivedAnnouncements)): ?>
        <?php foreach ($teacherReceivedAnnouncements as $announcement): ?>
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

  <!-- SECTION 2: Published Announcements BY Teacher -->
  <div class="published-announcements">
    <div class="heading">
      <h1 class="first-heading">Published Announcements</h1>
      <p class="first-description">Announcements published by you</p>
    </div>

    <div class="announcement-list">
      <?php if (!empty($teacherPublishedAnnouncements)): ?>
        <?php foreach ($teacherPublishedAnnouncements as $announcement): ?>
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></h2>
              <span class="announcemt-receiver">
                To: <?php echo htmlspecialchars($announcement['audienceName']); ?>
              </span>
              <p class="announcement-content">
                <?php echo nl2br(htmlspecialchars($announcement['content'])); ?>
              </p>
            </div>

            <div class="announcement-item-container2">
              <p class="announcement-date">
                Date: <?php echo date('Y-m-d', strtotime($announcement['created_at'])); ?>
              </p>
              <div class="announcement-actions">
                <button class="edit-announcement-btn" 
                        onclick="editAnnouncement(<?php echo $announcement['announcementID']; ?>)">
                  Edit
                </button>
                <button class="delete-announcement-btn" 
                        onclick="deleteAnnouncement(<?php echo $announcement['announcementID']; ?>)">
                  Delete
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="announcement-item">
          <div class="announcement-item-container1">
            <p class="announcement-content" style="text-align: center; color: #666;">
              You haven't published any announcements yet.
            </p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- SECTION 3: Create New Announcement -->
  <div class="create-announcement">
    <div class="heading">
      <h1 class="first-heading">Create Announcement</h1>
      <p class="first-description">
        Share important information with students and parents
      </p>
    </div>

    <?php if (!empty($_GET['added'])): ?>
      <div class="flash-message" style="margin: 8px 0; padding: 10px; background: #d4edda; color: #155724; border-radius: 4px;">
        Announcement published successfully!
      </div>
    <?php endif; ?>

    <?php if (!empty($_GET['updated'])): ?>
      <div class="flash-message" style="margin: 8px 0; padding: 10px; background: #d4edda; color: #155724; border-radius: 4px;">
        Announcement updated successfully!
      </div>
    <?php endif; ?>

    <?php if (!empty($_GET['deleted'])): ?>
      <div class="flash-message" style="margin: 8px 0; padding: 10px; background: #d4edda; color: #155724; border-radius: 4px;">
        Announcement deleted successfully!
      </div>
    <?php endif; ?>

    <form action="../../Controllers/addAnnouncementController.php" method="POST">
      <div class="announcement-form">
        <label for="announcement-title" class="announcement-label">Title:</label>
        <input
          type="text"
          id="announcement-title"
          name="title"
          class="announcement-input"
          placeholder="Enter title"
          required
        />

        <label for="message" class="announcement-label">Announcement Content:</label>
        <textarea
          id="message"
          name="message"
          class="announcement-textarea"
          placeholder="Write your announcement here..."
          rows="6"
          required
        ></textarea>

        <label for="target-audience" class="announcement-label">Target Audience:</label>
        <select
          id="target-audience"
          name="group"
          class="announcement-select"
          required
        >
          <option value="" disabled selected>Select Audience</option>
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
</section>

<!-- Edit Modal -->
<div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
  <div style="background: white; margin: 50px auto; padding: 20px; max-width: 600px; border-radius: 8px;">
    <h2>Edit Announcement</h2>
    <form id="editForm" action="../../Controllers/updateAnnouncementController.php" method="POST">
      <input type="hidden" id="edit-id" name="id">
      
      <label>Title:</label>
      <input type="text" id="edit-title" name="title" class="announcement-input" required>
      
      <label>Content:</label>
      <textarea id="edit-message" name="message" class="announcement-textarea" rows="6" required></textarea>
      
      <label>Target Audience:</label>
      <select id="edit-group" name="group" class="announcement-select" required>
        <option value="5">Parents & Students</option>
        <option value="8">Parents</option>
        <option value="9">Students</option>
      </select>
      
      <div style="margin-top: 20px;">
        <button type="submit" class="publish-announcement-btn">Update</button>
        <button type="button" onclick="closeEditModal()" style="margin-left: 10px;">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
function editAnnouncement(id) {
  // Fetch announcement data
  fetch('../../Controllers/getAnnouncementController.php?id=' + id)
    .then(response => response.json())
    .then(data => {
      document.getElementById('edit-id').value = data.announcementID;
      document.getElementById('edit-title').value = data.title;
      document.getElementById('edit-message').value = data.content;
      document.getElementById('edit-group').value = data.audienceID;
      document.getElementById('editModal').style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}

function deleteAnnouncement(id) {
  if (confirm('Are you sure you want to delete this announcement?')) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '../../Controllers/deleteAnnouncementController.php';
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'id';
    input.value = id;
    
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
  }
}

// Auto-hide flash messages after 3 seconds
setTimeout(() => {
  const flashMessages = document.querySelectorAll('.flash-message');
  flashMessages.forEach(msg => msg.style.display = 'none');
}, 3000);
</script>