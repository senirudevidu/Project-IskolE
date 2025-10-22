<?php
require_once __DIR__ . '/../../Controllers/announcement/readAnnouncementController.php';
$controller = new ReadAnnouncementController();
$announcements = $controller->getAllAnnouncements();
$myAnnouncements = $controller->getMyAnnouncements();
?>

<div class="bottem active" id="announcements">

    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Recent Announcement</span>
                <span class="sub-heding-text">Announcements from heads</span>
            </div>
            <div class="content">

                <?php if (!empty($announcements)): ?>
                    <?php foreach ($announcements as $a): ?>
                        <?php
                        $title = htmlspecialchars($a['title'] ?? '');
                        $audience = htmlspecialchars($a['audienceName'] ?? 'All Users');
                        $id = isset($a['announcement_id']) ? (int) $a['announcement_id'] : 0;
                        $createdAt = null;
                        if (!empty($a['created_at'])) {
                            try {
                                $createdAt = new DateTime($a['created_at']);
                            } catch (Exception $e) {
                                $createdAt = null;
                            }
                        }
                        $dateStr = $createdAt ? strtoupper($createdAt->format('M d')) : '';
                        $timeStr = $createdAt ? $createdAt->format('h.i A') : '';
                        $content = htmlspecialchars($a['content'] ?? '');
                        $audienceID = isset($a['audienceID']) ? (int) $a['audienceID'] : 0;
                        ?>
                        <div class="border-container info-box announcement-item">
                            <div class="left">
                                <span class="heading-name announcement-title"><?php echo $title; ?></span>
                                <span class="sub-heading announcement-audience" data-audience-id="<?php echo $audienceID; ?>">TO : <?php echo $audience; ?></span>
                                <?php if ($dateStr !== ''): ?><span
                                        class="sub-heading"><?php echo $dateStr; ?></span><?php endif; ?>
                                <?php if ($timeStr !== ''): ?><span
                                        class="sub-heading"><?php echo $timeStr; ?></span><?php endif; ?>
                                <span class="announcement-content" style="display:none;"><?php echo $content; ?></span>
                            </div>
                            <div class="right two-com">
                                <button class="btn edit-announcement-btn" data-id="<?php echo $id; ?>">Edit</button>
                                <button class="btn btn-red delete-announcement-btn" data-id="<?php echo $id; ?>">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="border-container info-box">
                        <div class="left">
                            <span class="heading-name">No announcements available</span>
                            <span class="sub-heading">TO : -</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Published Announcements</span>
                <span class="sub-heding-text">Announcements published by you</span>
            </div>
            <div class="content">
                <?php if (!empty($myAnnouncements)): ?>
                    <?php foreach ($myAnnouncements as $announcement): ?>
                        <div class="border-container info-box">
                            <div class="left">
                                <span class="heading-name"><?php echo htmlspecialchars($announcement['title']); ?></span>
                                <span class="sub-heading">TO: <?php echo htmlspecialchars($announcement['audienceName']); ?></span>
                                <span class="sub-heading"><?php echo date('M d', strtotime($announcement['created_at'])); ?></span>
                                <span class="sub-heading"><?php echo date('h:i A', strtotime($announcement['created_at'])); ?></span>
                            </div>
                            <div class="right two-com">
                                <button class="btn">Edit</button>
                                <button class="btn btn-red">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="border-container info-box">
                        <div class="left">
                            <span class="sub-heading">You haven't published any announcements yet.</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> -->

    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Create Announcements</span>
                <span class="sub-heding-text">Create announcements according to groups</span>
            </div>
            <form action="../../Controllers/announcement/addAnnouncementController.php" method="POST">
                <div class="content">
                    <div class="row">
                        <div class="text-field">
                            <span class="heading">Title:</span>
                            <input type="text" name="title" class="select-box" placeholder="Enter title"
                                id="announcementTitle" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-field">
                            <span class="heading">Announcement Content:</span>
                            <textarea name="message" rows="10" placeholder="Write your announcement here..."
                                id="announcementMessage" class="select-box"></textarea>
                        </div>
                    </div>

                    <div class=" row">
                        <div class="text-field">
                            <span class="heading">Target Audience:</span>
                            <select name="group" class="select-box" id="targetAudience">
                                <option value="null" selected disabled>Select Audience</option>
                                <option value="1">Management Panel, Teachers & Students</option>
                                <option value="2">Management Panel</option>
                                <option value="3">Teachers</option>
                                <option value="4">Management Panel & Teachers</option>
                                <option value="8">Teachers & Students</option>
                                <option value="6">Students</option>
                                <option value="5">Parents</option>
                                <option value="7">Student & Parent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-field">
                            <span>
                                <button type="submit" class="btn btn-blue">Publish Announcement</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<div id="editAnnouncementModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
    <div class="modal-content" style="background:#fff; margin:5% auto; padding:20px; border-radius:8px; width:90%; max-width:600px; position:relative;">
        <span class="close-modal" style="position:absolute; top:10px; right:15px; font-size:24px; cursor:pointer;">&times;</span>
        <h2 style="margin-bottom: 20px;">Edit Announcement</h2>
        <form id="editAnnouncementForm" method="POST" action="../../Controllers/announcement/updateAnnouncementController.php">
            <input type="hidden" name="announcement_id" id="edit-announcement-id" />
            <input type="hidden" name="published_by" id="edit-published-by" value="<?php echo $_SESSION['user_id'] ?? ''; ?>" />
            <input type="hidden" name="role" id="edit-role" value="<?php echo $_SESSION['role'] ?? ''; ?>" />

            <div class="content">
                <div class="row">
                    <div class="text-field">
                        <span class="heading">Title:</span>
                        <input type="text" name="title" id="edit-announcement-title" class="select-box" placeholder="Enter title" required />
                    </div>
                </div>
                <div class="row">
                    <div class="text-field">
                        <span class="heading">Announcement Content:</span>
                        <textarea name="content" id="edit-announcement-content" rows="10" placeholder="Write your announcement here..." class="select-box" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="text-field">
                        <span class="heading">Target Audience:</span>
                        <select name="audienceID" id="edit-target-audience" class="select-box" required>
                            <option value="">Select Audience</option>
                            <option value="1">Management Panel, Teachers & Students</option>
                            <option value="2">Management Panel</option>
                            <option value="3">Teachers</option>
                            <option value="4">Management Panel & Teachers</option>
                            <option value="8">Teachers & Students</option>
                            <option value="6">Students</option>
                            <option value="5">Parents</option>
                            <option value="7">Student & Parent</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="text-field">
                        <span>
                            <button type="submit" class="btn btn-blue">Update Announcement</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Edit Announcement
    document.querySelectorAll('.edit-announcement-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var item = btn.closest('.announcement-item');
            var announcementId = btn.getAttribute('data-id');
            var title = item.querySelector('.announcement-title').textContent.trim();
            var content = item.querySelector('.announcement-content').textContent.trim();
            var audienceSpan = item.querySelector('.announcement-audience');
            var audienceID = audienceSpan.getAttribute('data-audience-id');

            document.getElementById('edit-announcement-id').value = announcementId;
            document.getElementById('edit-announcement-title').value = title;
            document.getElementById('edit-announcement-content').value = content;
            document.getElementById('edit-target-audience').value = audienceID;

            document.getElementById('editAnnouncementModal').style.display = 'block';
        });
    });

    // Delete Announcement
    document.querySelectorAll('.delete-announcement-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var announcementId = btn.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this announcement?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../../Controllers/announcement/deleteAnnouncementController.php';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'announcement_id';
                input.value = announcementId;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
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