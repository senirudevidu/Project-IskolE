<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/projectIskole/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/projectIskole/">
    <link rel="stylesheet" href="public/css/teacherDashboard.css">
    <title>Document</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/projectIskole/app/Views/layouts/sumTab.php"; ?>
    
    <!--NavBar
    <nav class="teacher-navbar">
        <ul class="nav-links">
            <li class="nav-item"><a href="#marks-entry" class="nav-link">Marks Entry</a></li>
            <li class="nav-item"><a href="#attendance-entry" class="nav-link">Attendance</a></li>
            <li class="nav-item"><a href="#announcement-entry" class="nav-link">Announcement</a></li>
            <li class="nav-item"><a href="#material-entry" class="nav-link">Materials</a></li>
            <li class="nav-item"><a href="#reports-entry" class="nav-link">Reports</a></li>
        </ul>
    </nav>
    -->
    <!--Nav1 : Marks Entry-->
    <section class="marks-entry">

        <div class="heading">
            <h1 class="first-heading">Enter Student Marks</h1>
            <p class="first-description">Record marks for recent examination</p>
        </div>

        <div class="markentry-form">
            <form action="#" method="POST">
                <div class="form-filter-tabs">
                    <div class="grade-tab">
                        <label for="grade" class="tab-label">Select Grade:</label>
                        <select name="Grade" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12" class="mark-tabs-option">12</option>
                            <option value="13" class="mark-tabs-option">13</option>
                        </select>
                    </div>

                    <div class="class-tab">
                        <label for="class" class="tab-label">Select Class:</label>
                        <select name="class" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12">A</option>
                            <option value="13">B</option>
                            <option value="12">C</option>
                            <option value="13">D</option>
                        </select>
                    </div>

                    <div class="semester-tab">
                        <label for="semester" class="tab-label">Select Semester:</label>
                        <select name="semester" id="semester" class="tab-select">
                            <option value="null"></option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                        </select>
                    </div>

                    <div class="search-btn-container">
                        <button type="submit" class="search-btn">
                            <img src="public\assests\search.png" alt="search icon" height="40px" width="40px">
                        </button>
                    </div>

                </div>
                
            </form>
        </div>

        <div class="marks-table">
            <form action="#">
                <!-- Marks Entering Table -->
                <table class="marks-table-content">
                    <thead>
                        <tr>
                            <th class="rollnumber">Roll Number</th>
                            <th class="studentName">Student Name</th>
                            <th class="studentMarks">Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>John Doe</td>
                            <td class="input-coloumn"><input type="number" name="marks" min="0" max="100" class="marks-input" placeholder="0-100"> / 100</td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>Jane Smith</td>
                            <td class="input-coloumn"><input type="number" name="marks" min="0" max="100"class="marks-input" placeholder="0-100"> / 100</td>
                        </tr>
                    </tbody>
                </table>
        
                <!-- Submit Marks Button -->
                <div class="submit-btn">
                    <button type="submit" class="submit-marks-btn">Submit Marks</button>
                </div>

            </form>
        </div>

    </section>

    
    <!--Nav2 : Attendance-->
    <section class="attendance-entry">

        <div class="heading">
            <h1 class="first-heading">Mark Attendance</h1>
            <p class="first-description">Record daily attendence for your classes</p>
        </div>

        <div class="attendance-filter">
            <form action="#" method="POST">
                <div class="form-filter-tabs">
                    <div class="grade-tab">
                        <label for="grade" class="tab-label">Select Grade:</label>
                        <select name="Grade" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12" class="mark-tabs-option">12</option>
                            <option value="13" class="mark-tabs-option">13</option>
                        </select>
                    </div>

                    <div class="class-tab">
                        <label for="class" class="tab-label">Select Class:</label>
                        <select name="class" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12">A</option>
                            <option value="13">B</option>
                            <option value="12">C</option>
                            <option value="13">D</option>
                        </select>
                    </div>

                    <div class="date-tab">
                        <label for="date" class="tab-label">Select Date:</label>
                        <input type="date" name="date" id="date" class="tab-select">
                    </div>

                    <div class="search-btn-container">
                        <button type="submit" class="search-btn">
                            <img src="public\assests\search.png" alt="search icon" height="40px" width="40px">
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="attendance-table">
            <form action="#">
                <!-- Attendance Table -->
                <table class="attendance-table-content">
                    <thead>
                        <tr>
                            <th class="rollnumber">Roll Number</th>
                            <th class="studentName">Student Name</th>
                            <th class="status">Status</th>
                            <th class="change-attendence">Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>John Doe</td>
                            <td>Present</td>
                            <td>
                                <button class="present-btn">Present</button>
                                <button class="absent-btn">Absent</button>
                            </td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>Jane Smith</td>
                            <td>Absent</td>
                            <td>
                                <button class="present-btn">Present</button>
                                <button class="absent-btn">Absent</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="save-cancel-btns">
                    <div class="cancel-btn">
                        <button type="reset" class="cancel-attendance-btn">Cancel</button>
                    </div>

                    <div class="save-btn">
                        <button type="submit" class="save-attendance-btn">Submit Attendance</button>
                    </div>
                </div>
            </form>
        </div>

        
    </section>

    <!--Nav3 : Announcement-->
    <section class="announcement-entry">

        <div class="view-announcements">
            <div class="heading">
                <h1 class="first-heading">Recent Announcement</h1>
                <p class="first-description">Announcements from heads</p>
            </div>

            <div class="announcement-list">
                <div class="announcement-item">
                    <div class="announcement-item-container1">
                        <h2 class="announcement-title">Announcement Title</h2>
                        <span class="announcemt-sender">From: Management Panel</span>
                        <p class="announcement-content">This is the content of the announcement. It contains important information for students and parents.</p>
                    </div>
                    
                    <p class="announcement-date">Date: 2023-10-01</p>
                </div>
                
                <div class="announcement-item">
                    <div class="announcement-item-container1">
                        <h2 class="announcement-title">Announcement Title</h2>
                        <span class="announcemt-sender">From: Management Panel</span>
                        <p class="announcement-content">This is the content of the announcement. It contains important information for students and parents.</p>
                    </div>
                    
                    <p class="announcement-date">Date: 2023-10-01</p>
                </div>
            </div>
        </div>

        <div class="published-announcements">
            <div class="heading">
                <h1 class="first-heading">Published Announcement</h1>
                <p class="first-description">Announcements published by you</p>
            </div>

            <div class="announcement-list">
                <div class="announcement-item">
                    <div class="announcement-item-container1">
                        <h2 class="announcement-title">Announcement Title</h2>
                        <span class="announcemt-receiver">To: Management Panel</span>
                        <p class="announcement-content">This is the content of the announcement. It contains important information for students and parents.</p>
                    </div>
                    
                    <p class="announcement-date">Date: 2023-10-01</p>
                </div>
                
                <div class="announcement-item">
                    <div class="announcement-item-container1">
                        <h2 class="announcement-title">Announcement Title</h2>
                        <span class="announcemt-receiver">From: Management Panel</span>
                        <p class="announcement-content">This is the content of the announcement. It contains important information for students and parents.</p>
                    </div>
                    
                    <p class="announcement-date">Date: 2023-10-01</p>
                </div>
            </div>
        </div>
        
        <div class="create-announcement">
            
            <div class="heading">
                <h1 class="first-heading">Create Announcement</h1>
                <p class="first-description">Share important information with students and parents</p>
            </div>

            <form action="#">
                <div class="announcement-form">
                    <label for="announcement-title" class="announcement-label">Title:</label>
                    <input type="text" id="announcement-title" name="announcement-title" class="announcement-input" placeholder="Enter title">

                    <label for="message" class="announcement-label">Announcement Content:</label>
                    <textarea id="message" name="message" class="announcement-textarea" placeholder="Write your announcement here..." rows="6"></textarea>

                    <label for="target-audience" class="announcement-label">Target Audience:</label>
                    <select id="target-audience" name="target-audience" class="announcement-select">
                        <option value="null">Select Audience</option>
                        <option value="students">Students</option>
                        <option value="parents">Parents</option>
                        <option value="students&parent">Student & Parent</option>
                    </select>
                </div>
                <!-- Submit Marks Button -->
                <div class="submit-btn">
                    <button type="submit" class="publish-announcement-btn">Publish Announcement</button>
                </div>
            </form>
        </div>
        
    </section>


    <!--Nav4 : Materials-->
    <section class="material-entry">

        <div class="heading">
            <h1 class="first-heading">Upload Teaching Materials</h1>
            <p class="first-description">Share lesson plans and worksheets with students</p>
        </div>

        <div class="upload-section">
            <form action="#">
                <div class="form-filter-tabs">
                    <div class="grade-tab">
                        <label for="grade" class="tab-label">Select Grade:</label>
                        <select name="Grade" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12" class="mark-tabs-option">12</option>
                            <option value="13" class="mark-tabs-option">13</option>
                        </select>
                    </div>

                    <div class="class-tab">
                        <label for="class" class="tab-label">Select Class:</label>
                        <select name="class" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12">A</option>
                            <option value="13">B</option>
                            <option value="12">C</option>
                            <option value="13">D</option>
                        </select>
                    </div>

                    <div class="subject-tab">
                        <label for="subject" class="tab-label">Select subject:</label>
                        <select name="subject" id="subject" class="tab-select">
                            <option value="null"></option>
                            <option value="1">subject 1</option>
                            <option value="2">subject 2</option>
                            <option value="3">subject 3</option>
                        </select>
                    </div>
                </div>

                <div class="uploadform-elements">
                    <label for="material-title" class="material-label">Material Title:</label>
                    <input type="text" id="material-title" name="material-title" class="material-input" placeholder="Enter title">

                    <label for="material-description" class="material-label">Description:</label>
                    <textarea id="material-description" name="material-description" class="material-textarea" placeholder="Write a brief description..." rows="4"></textarea>

                    <label for="file-upload" class="material-label">Upload File:</label>
                    <input type="file" id="file-upload" name="file-upload" class="material-file-input">
                </div>

                <div class="submit-btn">
                    <button type="submit" class="publish-material-btn">Publish Material</button>
                </div>
                
            </form>
        </div>

        <div class="material-list">
            <div class="heading">
                <h1 class="first-heading">Uploaded Materials</h1>
                <p class="first-description">Materials uploaded by you</p>
            </div>

            <div class="material-list">
                <div class="material-item">
                    <div class="material-item-container1">
                        <h2 class="material-title">Material Title</h2>
                        <p class="material-content">This is the content of the material. It contains important information for students and parents.</p>
                    </div>
                    
                    <div class="material-item-right">
                        <p class="material-date">Date: 2023-10-01</p>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>
                
                <div class="material-item">
                    <div class="material-item-container1">
                        <h2 class="material-title">Material Title</h2>
                        <p class="material-content">This is the content of the material. It contains important information for students and parents.</p>
                    </div>

                    <div class="material-item-right">
                        <p class="material-date">Date: 2023-10-01</p>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!--Nav5 : Reports-->
    <section class="reports-entry">

        <div class="heading">
            <h1 class="first-heading">Student Performance Reports</h1>
            <p class="first-description">View student reports</p>
        </div>

        <p style="padding: 20px ; color: red;">This section will be implimented by actor student and take from it</p>
        
    </section>

</body>
</html>