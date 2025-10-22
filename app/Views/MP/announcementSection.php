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
                        $id = isset($a['announcementID']) ? (int) $a['announcementID'] : 0;
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
                        ?>
                        <div class="border-container info-box">
                            <div class="left">
                                <span class="heading-name"><?php echo $title; ?></span>
                                <span class="sub-heading">TO : <?php echo $audience; ?></span>
                                <?php if ($dateStr !== ''): ?><span
                                        class="sub-heading"><?php echo $dateStr; ?></span><?php endif; ?>
                                <?php if ($timeStr !== ''): ?><span
                                        class="sub-heading"><?php echo $timeStr; ?></span><?php endif; ?>
                            </div>
                            <div class="right two-com">
                                <button class="btn" data-id="<?php echo $_SESSION[] ?>">Edit</button>
                                <button class="btn btn-red" data-id="<?php echo $id; ?>">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>$
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
                                <span class="sub-heading">TO:
                                    <?php echo htmlspecialchars($announcement['audienceName']); ?></span>
                                <span
                                    class="sub-heading"><?php echo date('M d', strtotime($announcement['created_at'])); ?></span>
                                <span
                                    class="sub-heading"><?php echo date('h:i A', strtotime($announcement['created_at'])); ?></span>
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
                                <option value="6">Management Panel</option>
                                <option value="7">Teachers</option>
                                <option value="2">Management Panel & Teachers</option>
                                <option value="3">Teachers & Students</option>
                                <option value="9">Students</option>
                                <option value="8">Parents</option>
                                <option value="5">Student & Parent</option>
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