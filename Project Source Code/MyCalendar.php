<?php
session_start();

require "userStatusCheck.php";
require "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Project - My Calender</title>
    <link rel="stylesheet" href="styleMyCalendar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #0b0b23; box-shadow: 0 4px 3px -3px gray;">
        <a href="Browse.php" class="navbar-brand mb-0 h1 ms-3">
            <i class="bi bi-tv"></i>
            Year in Computing Project
        </a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation"
            class="navbar-toggler border-0">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3 justify-content-end" id="mainNavigation">
            <ul class="navbar-nav">
                <li class="nav-item me-4">
                    <a href="Browse.php" class="nav-link">
                        Browse
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a href="MyShows.php" class="nav-link">
                        My Shows
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a href="MyCalendar.php" class="nav-link active">
                        My Calendar
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a href="userSignOut.php" class="nav-link">
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container-md mt-5" id="content"></div>

    <!-- SCRIPT TAGS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>
    <script src="myCalendar.js"></script>

    <!-- PHP -->
    <?php
    $myCalendarQuery = $db -> prepare("SELECT `SeriesID` FROM ProjectMyShows WHERE Username = ?");
    $myCalendarQuery -> execute(array($_SESSION["userId"]));


    while($column = $myCalendarQuery -> fetch()) {
        echo '<script>getNextEpisodeDates(TMDB_ID_URL + ' . $column["SeriesID"] . ' + "?" + TMDB_API_KEY)</script>';
    }
    ?>

</body>

</html>