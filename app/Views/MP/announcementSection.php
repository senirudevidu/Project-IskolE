<div class="bottem active" id="announcements">

    <div class="box">
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