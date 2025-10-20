<?php include_once '../header/Header.php';
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
        session_start();
}
?>
<html lang="en">

<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />


        <!-- Preconnect to Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
                rel="stylesheet">

        <!-- Fav icon -->
        <link rel="icon" type="image/x-icon" href="../../../public/assests/logo.png" />

        <!-- Stylesheets -->

        <link rel="stylesheet" href="../../../public/css/sumTab.css">
        <link rel="stylesheet" href="../../../public/css/styles.css">
        <link rel="stylesheet" href="../../../public/css/header/header.css" />
        <link rel="stylesheet" href="../../../public/css/parent/parentDashboard.css">

        <!-- JavaScript files -->
        <script src="../../../public/js/logout.js" defer></script>
        <script src="../../../public/js/parentNavbar.js" defer></script>
        <title>Parent Dashboard</title>
</head>

<body class="roboto-regular">
        <?php include_once 'sumTab.html'; ?>

        <div>
                <?php include_once 'parentChildSelect.php'; ?>
                <?php include_once 'parentNavBar.php'; ?>

                <div id="academic" class="content-section active">
                        <?php include_once 'parentAcademic.php'; ?>
                </div>

                <div id="attendance" class="content-section">
                        <?php include_once 'parentAttendance.php'; ?>
                </div>

                <div id="time-table" class="content-section">
                        <?php include_once 'parentTimetable.php'; ?>
                </div>

                <div id="behavior" class="content-section">
                        <?php include_once 'parentBehavior.php'; ?>
                </div>

                <div id="teachers" class="content-section">
                        <?php include_once 'parentTeacher.php'; ?>
                </div>

                <div id="requests" class="content-section">
                        <?php include_once 'parentRequests.php'; ?>
                </div>

                <div id="events" class="content-section">
                        <?php include_once 'parentEvents.php'; ?>
                </div>
        </div>
</body>

</html>