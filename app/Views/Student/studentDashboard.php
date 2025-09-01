<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <base href="/projectIskole/">

        <!-- Preconnect to Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Fav icon -->
        <link rel="icon" type="image/x-icon" href="public/assests/logo.png" />

        <!-- Stylesheets -->
        <link rel="stylesheet" href="public/css/header.css">
        <link rel="stylesheet" href="public/css/student/student.css">
        <link rel="stylesheet" href="public/css/styles.css">
        <link rel="stylesheet" href="public/css/sumTab.css">



        <!-- JavaScript files -->
        <script src="public/js/logout.js"></script>
        <script src="public/js/studentNavbar.js"></script>
        <title>Student Dashboard</title>
    </head>


 <body class="roboto-regular">
        <?php include("studentHeader.html"); ?>
        <?php include("sumTab.html"); ?>

    <div class="student-body">
        <?php include_once 'studentNavbar.php'; ?>
        <div class="tab-content">
             <div id="marks" class="content-section active">
                <?php include_once 'studentMymarks.php'; ?>
            </div>
            <div id="attendance" class="content-section">
                <?php include_once 'studentAttendance.php'; ?>
            </div>
             <div id="timetable" class="content-section">
                <?php include_once 'studentTimetable.php'; ?>
            </div>
            <div id="materials" class="content-section">
                <?php include_once 'Materials/studentMaterials.php'; ?>
            </div>
            <div id="announcements" class="content-section">
                <?php include_once 'studentAnnouncement.php'; ?>
            </div>

            <div class="content-section" id="events">
                <?php include_once 'studentEvents.php'; ?>
            </div>

        </div>

</body>







</html>