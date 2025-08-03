<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="/ProjectIskole/">

    <base href="/projectIskole/">

    <link rel="stylesheet" href="../../../public/css/teacherDashboard.css">
    <script src="../../../public/js/teacherNavbar.js"></script>
</head>

<body>
    <?php include("../layouts/sumTab.php"); ?>

    <!--NavBar-->
    <nav class="teacher-navbar">
        <ul class="nav-links">
            <li class="nav-item active-item" id="active" onclick="tabChange(0)">Marks Entry</a></li>
            <li class="nav-item" onclick="tabChange(1)">Attendance</a></li>
            <li class="nav-item" onclick="tabChange(2)">Announcement</a></li>
            <li class="nav-item" onclick="tabChange(3)">Materials</a></li>
            <li class="nav-item" onclick="tabChange(4)">Reports</a></li>
        </ul>
    </nav>

    <!--Nav1 : Marks Entry-->
    <section class="marks-entry tab-panel active-tab">

        <!-- Fav icon -->
        <link rel="icon" type="image/x-icon" href="/ProjectIskole/public/assests/logo.png" />

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/ProjectIskole/public/css/header.css" />
        <link rel="stylesheet" href="/ProjectIskole/public/css/sumTab.css">
        <link rel="stylesheet" href="/ProjectIskole/public/css/Teacher/teacherDashboard.css">
        <link rel="stylesheet" href="/ProjectIskole/public/css/styles.css">

        <!-- JavaScript files -->
        <script src="/ProjectIskole/public/js/logout.js"></script>
        <script src="/ProjectIskole/public/js/teacherNavbar.js"></script>
        <title>Teacher Dashboard</title>
        </head>

        <body class="roboto-regular">
            <?php include 'teacherHeader.html'; ?>
            <?php include 'sumTab.html'; ?>
            <?php include 'teacherBody.html'; ?>
        </body>

</html>