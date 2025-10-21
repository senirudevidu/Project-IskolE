<div class="bottem active" id="announcements">

<?php
require_once __DIR__ . '/../../Controllers/announcementController.php';

$announcementController = new AnnouncementController();
$announcements = $announcementController->getAllAnnouncements();
?>

<style>
/* Popup Overlay */
.popup-overlay {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
}

.popup-overlay.active {
    display: flex;
}

.popup-content {
    background-color: #fff;
    border-radius: 8px;
    width: 90%;
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: slideDown 0.3s;
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>

<div class="box">
    <div class="container info-box-large">
        <div class="heading-section">
            <span class="heading-text">Recent Announcements</span>
            <span class="sub-heding-text">Manage published announcements</span>
        </div>

        <div class="content">
            <?php if (!empty($announcements)): ?>
                <?php foreach ($announcements as $announcement): ?>
                    <div class="border-container info-box">
                        <div class="left">
                            <span class="heading-name"><?= htmlspecialchars($announcement['title']) ?></span>
                            <span class="sub-heading">To: 
                                <?php
                                    if (!empty($announcement['audienceName'])) {
                                        echo htmlspecialchars($announcement['audienceName']);
                                    } else {
                                        echo "N/A";
                                    }
                                ?>
                            </span>
                            <span class="sub-heading"> 
                                <?= htmlspecialchars($announcement['content']) ?>
                            </span>
                            <span class="sub-heading">
                                <?= date('M d, h:i A', strtotime($announcement['created_at'])) ?>
                            </span>
                            
                        </div>
                        <div class="right two-com">
                            <!--<form action="/app/Controllers/updateAnnouncementController.php" method="GET" style="display:inline;">-->
                            <form action="/app/Controllers/updateAnnouncementController.php" method="GET" style="display:inline;">

                                <input type="hidden" name="id" value="<?= $announcement['announcement_id'] ?>">
                                <button class="btn" type="button" onclick='openPopup(<?= json_encode($announcement) ?>)'>Edit</button>
                            </form>

                            <form action="/app/Controllers/deleteAnnouncementController.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                <input type="hidden" name="id" value="<?= $announcement['announcement_id'] ?>">
                                <button class="btn btn-red" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No announcements available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="popupForm" class="popup-overlay">
    <div class="popup-content">
        <div class="box">
            <div class="container info-box-large">
                <div class="heading-section" style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <span class="heading-text">Update Announcements</span>
                        <span class="sub-heding-text">Update announcement details</span>
                    <!--<button onclick="closePopup()" style="background: none; border: none; font-size: 28px; cursor: pointer; color: #aaa;">&times;</button>-->
                </div>
                
                <form action="/app/Controllers/updateAnnouncementController.php" method="POST">
                    <input type="hidden" id="edit_announcement_id" name="id">
                    
                    <div class="content">
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Target Audience</span>
                                <select name="group" class="select-box" id="edit_targetAudience" required>
                                    <option value="" disabled>Select Audience</option>
                                    <option value="0">Management Panel, Teachers, Parents & Students</option>
                                    <option value="1">Management Panel & Teachers</option>
                                    <option value="2">Teachers & Students</option>
                                    <option value="3">Management Panel</option>
                                    <option value="4">Teachers</option>
                                    <option value="5">Parents</option>
                                    <option value="6">Students</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Announcement Title</span>
                                <input type="text" class="select-box" placeholder="Enter the announcement title"
                                    id="edit_announcementTitle" name="title" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Message</span>
                                <textarea name="message" rows="10" placeholder="Type your announcement message here"
                                    id="edit_announcementMessage" class="select-box" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <span>
                                    <button class="btn btn-blue" type="submit">Update Announcement</button>
                                    <button class="btn" type="button" onclick="closePopup()">Cancel</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Create Announcements</span>
                <span class="sub-heding-text">Create announcements according to groups</span>
            </div>
            <form action="/app/Controllers/addAnnouncementController.php" method="post">
                <div class="content">
                    <div class="row">
                        <div class="text-field">
                            <span class="heading">Target Audience</span>
                            <select name="group" class="select-box" id="targetAudience" name="group" required>
                                <option value="" selected disabled>Select Audience</option>
                                <option value="0">Management Panel, Teachers, Parents & Students</option>
                                <option value="1">Management Panel & Teachers</option>
                                <option value="2">Teachers & Students</option>
                                <option value="3">Management Panel</option>
                                <option value="4">Teachers</option>
                                <option value="5">Parents</option>
                                <option value="6">Students</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-field">
                            <span class="heading">announcement Title</span>
                            <input type="text" class="select-box" placeholder="Enter the announcement title"
                                id="announcementTitle" name="title" required />
                        </div>
                    </div>

                    <div class=" row">
                        <div class="text-field">
                            <span class="heading">Message</span>
                            <textarea name="message" rows="10" placeholder="Type your announcement message here"
                                id="announcementMessage" class="select-box" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-field">
                            <span>
                                <button class="btn btn-blue">Publish Announcemnt</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openPopup(announcement) {
    // Fill the form with announcement data
    document.getElementById('edit_announcement_id').value = announcement.announcement_id;
    document.getElementById('edit_announcementTitle').value = announcement.title;
    document.getElementById('edit_announcementMessage').value = announcement.content;
    document.getElementById('edit_targetAudience').value = announcement.audienceID;
    
    // Show the popup
    document.getElementById("popupForm").classList.add("active");
    document.body.style.overflow = 'hidden';
}

function closePopup() {
    document.getElementById("popupForm").classList.remove("active");
    document.body.style.overflow = 'auto';
}

// Close popup when clicking outside
window.onclick = function(event) {
    const popup = document.getElementById('popupForm');
    if (event.target === popup) {
        closePopup();
    }
}

// Close popup with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closePopup();
    }
});
</script>