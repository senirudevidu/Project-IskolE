<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/public/assets/favicon.ico" type="image/x-icon">


  <!-- Stylesheets -->

  <link rel="stylesheet" href="../../../public/css/sumTab.css">
  <link rel="stylesheet" href="../../../public/css/header/header.css">
  <link rel="stylesheet" href="../../../public/css/MP/academicSection.css">
  <link rel="stylesheet" href="../../../public/css/MP/management.css">
  <title>management Panel</title>
</head>

<body class="roboto-regular">
  <?php include "../header/Header.php" ?>
  <!-- <?php include "./sumTab.php" ?> -->

  <!-- JavaScript -->
  <script src="../../../public/js/scripts.js"></script>
  <script type="module" src="../../../public/js/logout.js"></script>
  <script type="module" src="../../../public/js/MP/toggleSeeMore.js"></script>
  <script type="module" src="../../../public/js/validation.js"></script>
  <script type="module" src="../../../public/js/MP/mpDashboard.js"></script>
  <script src="../../../public/js/logout.js"></script>



  <div class="mpDashboard">
    <!-- top section -->
    <?php include "./topSection.php" ?>

    <!-- nab bar -->
    <div class="nav">
      <div class="nav-item active" data-target="announcements">Announcements</div>
      <div class="nav-item" data-target="events">Events</div>
      <div class="nav-item" data-target="academic">Academic</div>
      <div class="nav-item" data-target="requests">Requests</div>
      <div class="nav-item  " data-target="management">Management</div>
      <div class="nav-item" data-target="reports">Reports</div>

    </div>

    <!-- management  -->
    <?php include "./managementSection.php" ?>

    <!-- academic panel -->
    <?php include "./academicSection.php" ?>

    <!-- requests panel -->
    <?php include "./requestSection.php" ?>

    <!-- events panel -->
    <?php include "./eventSection.php" ?>

    <!-- report panel -->
    <?php include "./reportSection.php" ?>

    <!-- announcement panel -->
    <?php include "./announcementSection.php" ?>

</body>

</html>