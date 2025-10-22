<div class="bottem active" id="announcements">

    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Recent Announcements</span>
                <span class="sub-heding-text">Manage publish announcements</span>
            </div>
            <div class="content">
                <?php
                // Fetch announcements via controller
                require_once __DIR__ . '/../../Controllers/announcement/readAnnouncementController.php';
                $controller = new ReadAnnouncementController();
                $announcements = $controller->getAllAnnouncements();
                ?>

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
                                <button class="btn" data-id="<?php echo $id; ?>">Edit</button>
                                <button class="btn btn-red" data-id="<?php echo $id; ?>">Delete</button>
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

    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">Create Announcements</span>
                <span class="sub-heding-text">Create announcements according to groups</span>
            </div>
            <form action="">
                <div class="content">
                    <div class="row">
                        <div class="text-field">
                            <span class="heading">Target Audience</span>
                            <select name="group" class="select-box" id="targetAudience">
                                <option value="" selected disabled>Select Audience</option>
                                <option value="all">Management Panel, Teachers & Students</option>
                                <option value="mp">Management Panel</option>
                                <option value="teachers">Teachers</option>
                                <option value="mp_teachers">Management Panel & Teachers</option>
                                <option value="students">Teachers & Students</option>
                                <option value="students">Students</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-field">
                            <span class="heading">announcement Title</span>
                            <input type="text" class="select-box" placeholder="Enter the announcement title"
                                id="announcementTitle" />
                        </div>
                    </div>

                    <div class=" row">
                        <div class="text-field">
                            <span class="heading">Message</span>
                            <textarea name="Message" rows="10" placeholder="Type your announcement message here"
                                id="announcementMessage" class="select-box"></textarea>
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