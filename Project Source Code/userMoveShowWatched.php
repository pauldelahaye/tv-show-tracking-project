<?php
session_start();

require "database.php";

$checkSeriesQuery = $db -> prepare("SELECT `Username`, `SeriesID` FROM ProjectMyShows WHERE Username = ? AND SeriesID = ? AND ViewingStatus = 0");
$checkSeriesQuery -> execute(array($_SESSION["userId"], $_POST["SeriesID"]));


if ($checkSeriesQuery -> rowCount() > 0) {
    $updateSeriesQuery = $db -> prepare("UPDATE ProjectMyShows SET ViewingStatus = 1 WHERE Username = ? AND SeriesID = ?");
    $updateSeriesQuery -> execute(array($_SESSION["userId"], $_POST["SeriesID"]));
    
    echo $_POST["SeriesID"] . " was successfully moved to Watched / Watching";
}

if ($checkSeriesQuery -> rowCount() == 0) {
    echo "This show no longer exists in My Shows!";
}
