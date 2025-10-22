    <!--Nav1 : Announcement-->
    <?php
    include_once __DIR__ . '/../../controllers/announcement/readAnnouncementController.php';

    ?>

    <section class="announcement-entry tab-panel active-tab">
      <div class="view-announcements">
        <div class="heading">
          <h1 class="first-heading">Recent Announcement</h1>
          <p class="first-description">Announcements from heads</p>
        </div>

        <div class="announcement-list">
          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title">There will be system maintenance</h2>
              <span class="announcemt-sender">From: Admin</span>
              <p class="announcement-content">
                2026/12/01 will system freez for maintenance
              </p>
            </div>

            <p class="announcement-date">Date: 2025-10-01</p>
          </div>

          <div class="announcement-item">
            <div class="announcement-item-container1">
              <h2 class="announcement-title">Staff Meeting</h2>
              <span class="announcemt-sender">From: Management Panel</span>
              <p class="announcement-content">
                2026/12/01 at 12.00 there will be a staff meeting in the conference room.
              </p>
            </div>

            <p class="announcement-date">Date: 2025-10-02</p>
          </div>
        </div>
      </div>

      <div class="published-announcements">
        <div class="heading">
          <h1 class="first-heading">Published Announcement</h1>
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
                    <?php echo htmlspecialchars($announcement['content']); ?>
                  </p>
                </div>

                <div class="announcement-item-container2">
                  <p class="announcement-date"><?php echo htmlspecialchars($announcement['created_at']); ?></p>
                  <div class="announcement-actions">
                    <button class="edit-announcement-btn">Edit</button>
                    <button class="delete-announcement-btn">Delete</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="no-announcements">You haven't published any announcements yet.</p>
          <?php endif; ?>
        </div>
      </div>

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
            <input
              type="text"
              id="announcement-title"
              name="title"
              class="announcement-input"
              placeholder="Enter title" />

            <label for="message" class="announcement-label">Announcement Content:</label>
            <textarea
              id="message"
              name="message"
              class="announcement-textarea"
              placeholder="Write your announcement here..."
              rows="6"></textarea>

            <label for="target-audience" class="announcement-label">Target Audience:</label>
            <select
              id="target-audience"
              name="group"
              class="announcement-select">
              <option value="null">Select Audience</option>
              <option value="6">Students</option>
              <option value="5">Parents</option>
              <option value="7">Student & Parent</option>
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