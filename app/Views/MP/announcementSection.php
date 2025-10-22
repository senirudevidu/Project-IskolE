<?php
include_once __DIR__ . '/../../controllers/announcement/readAnnouncementController.php';
?>

<div class="bottem active" id="announcements">

    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Recent Announcement</span>
                <span class="sub-heding-text">Announcements from heads</span>
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
    </div>

    <div class="box">
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
    </div>

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