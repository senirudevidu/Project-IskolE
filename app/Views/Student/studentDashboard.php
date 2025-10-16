<?php include_once '../header/Header.php'; ?>

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
    <link rel="icon" type="image/x-icon" href="../../../public/assests/logo.png" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/student/student.css">
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/sumTab.css">


    <!-- JavaScript files -->

    <title>Student Dashboard</title>
</head>

<!-- JavaScript files -->
<script src="../../../public/js/logout.js"></script>
<script src="../../../public/js/studentNavbar.js"></script>
<title>Student Dashboard</title>
</head>

<body class="roboto-regular">
    <?php include("sumTab.php"); ?>

    <div class="student-body">
        <?php include("studentNavbar.php"); ?>
        <div class="tab-content">
            <div id="announcements" class="content-section active">
                <?php include("studentAnnouncements.php") ?>
            </div>
            <div id="marks" class="content-section">
                <?php include("studentMymarks.php") ?>
            </div>
            <div id="attendance" class="content-section">
                <?php include("studentAttendance.php") ?>
            </div>
            <div id="timetable" class="content-section">
                <?php include("studentTimetable.php") ?>
            </div>
            <div id="materials" class="content-section">
                <?php include("studentMaterials.php") ?>
            </div>




        </div>


        <script src="../../../public/js/logout.js" defer></script>
        <script src="../../../public/js/studentNavbar.js" defer></script>

</body>







</html>