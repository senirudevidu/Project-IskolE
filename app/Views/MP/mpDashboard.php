<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/public/assets/favicon.ico" type="image/x-icon">


  <!-- Stylesheets -->
  <link rel="stylesheet" href="../../../public/css/MP/management.css">
  <link rel="stylesheet" href="../../../public/css/sumTab.css">
  <link rel="stylesheet" href="../../../public/css/header/header.css">
  <title>management Panel</title>
</head>

<body class="roboto-regular">
  <?php include "./header.php" ?>
  <!-- <?php include "./sumTab.php" ?> -->

  <!-- JavaScript -->
  <script src="../../../public/js/scripts.js"></script>
  <script type="module" src="../../../public/js/logout.js"></script>
  <script type="module" src="../../../public/js/validation.js"></script>
  <script type="module" src="../../../public/js/mpDashboard.js"></script>



  <div class="mpDashboard">
    <!-- top section -->
    <div class="top">
      <div class="container info-box-small data-box">
        <span class="info-box-heading">Total Students</span>
        <span class="info-box-sub-heading heading-blue">1245</span>
      </div>
      <div class="container info-box-small data-box">
        <span class="info-box-heading">Total Teachers</span>
        <span class="info-box-sub-heading heading-blue">108</span>
      </div>
      <div class="container info-box-small data-box">
        <span class="info-box-heading">Pending Requests</span>
        <span class="info-box-sub-heading heading-red">1245</span>
      </div>
      <div class="container info-box-small data-box">
        <span class="info-box-heading">School Average</span>
        <span class="info-box-sub-heading heading-green">86.1%</span>
      </div>
    </div>

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