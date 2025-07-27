<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <base href="/projectIskole/">
        <link rel="icon" type="image/x-icon" href="/projectIskole/public/assests/logo.png" />
        <link rel="stylesheet" href="/projectIskole/public/css/header.css" />
        <link rel="stylesheet" href="/projectIskole/public/css/sumTab.css">
        <link rel="stylesheet" href="/projectIskole/public/css/Teacher/teacherDashboard.css">

        <script src="/projectIskole/public/js/logout.js"></script>
        <script src="/projectIskole/public/js/teacherNavbar.js"></script>
        <title>Teacher Dashboard</title>
    </head>
    
    <body>
        <?php include 'teacherHeader.html'; ?>
        <?php include("sumTab.html"); ?>
        <?php include("teacherBody.html"); ?>
    </body>
</html>