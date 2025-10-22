<div class="bottem active" id="announcements-create">
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
                            <select name="group" class="select-box" id="targetAudience" required>
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
                            <span class="heading">Announcement Title</span>
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
                                <button class="btn btn-blue" type="submit">Publish Announcement</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>