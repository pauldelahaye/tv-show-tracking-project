<?php
session_start();

require "database.php";

$checkSeriesQuery = $db -> prepare("SELECT `Username`, `SeriesID` FROM ProjectMyShows WHERE Username = ? AND SeriesID = ?");
$checkSeriesQuery -> execute(array($_SESSION["userId"], $_POST["SeriesID"]));


if ($checkSeriesQuery -> rowCount() > 0) {
    $removeSeriesQuery = $db -> prepare("DELETE FROM ProjectMyShows WHERE Username = ? AND SeriesID = ?");
    $removeSeriesQuery -> execute(array($_SESSION["userId"], $_POST["SeriesID"]));
    
    echo $_POST["SeriesID"] . " was successfully removed from My Shows for " . $_SESSION["userId"];
}

if ($checkSeriesQuery -> rowCount() == 0) {
    echo "This show no longer exists in My Shows!";
}





?>