<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />  

        <!-- Preconnect to Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Fav icon -->
        <link rel="icon" type="image/x-icon" href="../../../public/assests/logo.png" />

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../../../public/css/header.css" />
        <link rel="stylesheet" href="../../../public/css/sumTab.css">
        <link rel="stylesheet" href="../../../public/css/Teacher/teacherDashboard.css">
        <link rel="stylesheet" href="../../../public/css/styles.css">

        <!-- JavaScript files -->
        <script src="../../../public/js/logout.js"></script>
        <script src="../../../public/js/teacherNavbar.js"></script>
        <script src="../../../public/js/dateValidation/dateValidation.js" defer></script>
        <title>Teacher Dashboard</title>
    </head>

    <body class="roboto-regular">
        <?php include_once 'teacherHeader.html'; ?>
        <?php include_once 'sumTab.html'; ?>
        
        <div class="teacher-body">
            <?php include_once 'teacherNavbar.php'; ?>
            <div class="tab-content">
                <div id="announcement" class="tab-pane active">
                    <?php include_once 'teacherAnnouncement.php'; ?>
                </div>
                <div id="attendance" class="tab-pane">
                    <?php include_once 'teacherAttendance.php'; ?>
                </div>
                <div id="materials" class="tab-pane">
                    <?php include_once 'teacherMaterials.php'; ?>
                </div>
                <div id="reports" class="tab-pane">
                    <?php include_once 'teacherReports.php'; ?>
                </div>
                <div id="leave" class="tab-pane">
                    <?php include_once 'teacherLeave.php'; ?>
                </div>
                <div id="student-absence" class="tab-pane">
                    <?php include_once 'teacherStudentAbsence.php'; ?>
                </div>
                <div id="releaf" class="tab-pane">
                    <?php include_once 'teacherRelief.php'; ?>
                </div>
                <div id="timetable" class="tab-pane">
                    <?php include_once 'teacherTimetable.php'; ?>
                </div>
                <div id="marks-entry" class="tab-pane">
                    <?php include_once 'teacherMarksEntry.php'; ?>
                </div>
        </div>

    </body>
</html>