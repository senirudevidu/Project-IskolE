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
    
    <!--NavBar-->
    <nav class="teacher-navbar">
        <ul class="nav-links">
            <li class="nav-item"><a href="#marks-entry" class="nav-link">Marks Entry</a></li>
            <li class="nav-item"><a href="#attendance-entry" class="nav-link">Attendance</a></li>
            <li class="nav-item"><a href="#announcement-entry" class="nav-link">Announcement</a></li>
            <li class="nav-item"><a href="#material-entry" class="nav-link">Materials</a></li>
            <li class="nav-item"><a href="#reports-entry" class="nav-link">Reports</a></li>
        </ul>
    </nav>
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

        <div class="heading">
            <h1 class="first-heading">Create Announcement</h1>
            <p class="first-description">Share important information with students and parents</p>
        </div>
        
    </section>


    <!--Nav4 : Materials-->
    <section class="material-entry">

        <div class="heading">
            <h1 class="first-heading">Upload Teaching Materials</h1>
            <p class="first-description">Share lesson plans and worksheets with students</p>
        </div>
        
    </section>


    <!--Nav5 : Reports-->
    <section class="reports-entry">

        <div class="heading">
            <h1 class="first-heading">Student Performance Reports</h1>
            <p class="first-description">View student reports</p>
        </div>
        
    </section>

</body>
</html>