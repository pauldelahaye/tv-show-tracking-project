<?php
session_start();

require "database.php";

$checkSeriesQuery = $db -> prepare("SELECT `Username`, `SeriesID` FROM ProjectMyShows WHERE Username = ? AND SeriesID = ?");
$checkSeriesQuery -> execute(array($_SESSION["userId"], $_POST["SeriesID"]));


if ($checkSeriesQuery -> rowCount() > 0) {
    echo $_POST["SeriesName"] . " already exists in My Shows";
}

if ($checkSeriesQuery -> rowCount() == 0) {

    $addSeriesQuery = $db -> prepare("INSERT INTO ProjectMyShows (StorageID, Username, SeriesID, SeriesName, DateTimeAdded, ViewingStatus) VALUES (?, ?, ?, ?, NOW(), true)");
    $storageId = $_SESSION["userId"] . $_POST["SeriesID"]; //creating unique primary key
    $addSeriesQuery -> execute(array($storageId, $_SESSION["userId"], $_POST["SeriesID"], $_POST["SeriesName"]));

    echo $_POST["SeriesName"] . " was added to My Shows";
}

?>