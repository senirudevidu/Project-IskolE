<div class="bottem active" id="announcements">

<?php
require_once __DIR__ . '/../Controllers/announcementController.php';

$announcementController = new AnnouncementController();
$announcements = $announcementController->getAllAnnouncements();
?>

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
                            <span class="sub-heading">TO :
                                <?php
                                    echo ucfirst(htmlspecialchars($announcement['role']));
                                ?>
                            </span>
                            <span class="sub-heading">
                                <?= date('M d', strtotime($announcement['created_at'])) ?>
                            </span>
                            <span class="sub-heading">
                                <?= date('h:i A', strtotime($announcement['created_at'])) ?>
                            </span>
                        </div>
                        <div class="right two-com">
                            <form action="/app/Controllers/editAnnouncementController.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $announcement['announcement_id'] ?>">
                                <button class="btn" type="submit">Edit</button>
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

    <!--<div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Recent Announcements</span>
                <span class="sub-heding-text">Manage publish announcements</span>
            </div>
            <div class="content">
                <div class="border-container info-box">
                    <div class="left">
                        <span class="heading-name">Teachers Conferance</span>
                        <span class="sub-heading">TO : Teachers</span>
                        <span class="sub-heading">NOV 06</span>
                        <span class="sub-heading">10.10 AM</span>
                    </div>
                    <div class="right two-com">
                        <button class="btn">Edit</button>
                        <button class="btn btn-red">Delete</button>
                    </div>
                </div>

                <div class="border-container info-box">
                    <div class="left">
                        <span class="heading-name">2<sup>nd</sup> Term Test Schedule</span>
                        <span class="sub-heading">TO : All Users</span>
                        <span class="sub-heading">NOV 10</span>
                        <span class="sub-heading">10.10 AM</span>
                    </div>
                    <div class="right two-com">
                        <button class="btn">Edit</button>
                        <button class="btn btn-red">Delete</button>
                    </div>
                </div>
                <div class="border-container info-box">
                    <div class="left">
                        <span class="heading-name">1<sup>st</sup> Term Test Schedule</span>
                        <span class="sub-heading">TO : All Users</span>
                        <span class="sub-heading">NOV 10</span>
                        <span class="sub-heading">10.10 AM</span>
                    </div>
                    <div class="right two-com">
                        <button class="btn">Edit</button>
                        <button class="btn btn-red">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

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
                                <option value="all">Management Panel, Teachers & Students</option>
                                <option value="mp">Management Panel</option>
                                <option value="teachers">Teachers</option>
                                <option value="mp_teachers">Management Panel & Teachers</option>
                                <option value="teachers_students">Teachers & Students</option>
                                <option value="students">Students</option>
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