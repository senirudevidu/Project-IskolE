<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <base href="/Project-Iskole/">

        <!-- Preconnect to Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Fav icon -->
        <link rel="icon" type="image/x-icon" href="/public/assests/logo.png" />

        <!-- Stylesheets -->
        
        <!-- <link rel="stylesheet" href="/public/css/sumTab.css">
        <link rel="stylesheet" href="/public/css/styles.css">
        <link rel="stylesheet" href="/public/css/header.css"/>
        <link rel="stylesheet" href="/public/css/parent/parentDashboard.css"> -->

        <link rel="stylesheet" href="/projectIskole/public/css/header.css" />
        <link rel="stylesheet" href="/projectIskole/public/css/sumTab.css">
        <link rel="stylesheet" href="/projectIskole/public/css/parent/parentDashboard.css">
        <link rel="stylesheet" href="/projectIskole/public/css/styles.css">
        
   

        <!-- JavaScript files
        <script src="/public/js/logout.js"></script>
        <script src="/public/js/parentnavbar.js"></script> -->

        <!-- JavaScript files -->
        <script src="/projectIskole/public/js/logout.js"></script>
        <script src="/projectIskole/public/js/parentnavbar.js"></script>

        <title>Parent Dashboard</title>
    </head>

    <body class="roboto-regular">
        <?php include 'parentHeader.html'; ?>
        <?php include("sumTab.html"); ?>
        <?php include("parentDashboard.html"); ?>
    </body>
</html>