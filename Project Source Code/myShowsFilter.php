<?php
session_start();
require "database.php";

$myShowsWatchedQuery = $db -> prepare("SELECT `SeriesID` FROM ProjectMyShows WHERE Username = ? AND ViewingStatus = 1 ORDER BY DateTimeAdded DESC");
$myShowsWatchedQuery -> execute(array($_SESSION["userId"]));

$myShowsUnwatchedQuery = $db -> prepare("SELECT `SeriesID` FROM ProjectMyShows WHERE Username = ? AND ViewingStatus = 0 ORDER BY DateTimeAdded DESC");
$myShowsUnwatchedQuery -> execute(array($_SESSION["userId"]));



if (isset($_POST["FilterOption"])) {

    if ($_POST["FilterOption"] == "Watched / Watching") {

        $watchedSeriesIdArray = $myShowsWatchedQuery -> fetchAll(PDO::FETCH_COLUMN, 0);

        echo json_encode($watchedSeriesIdArray);

    }

    if ($_POST["FilterOption"] == "Unwatched Shows") {

        $unwatchedSeriesIdArray = $myShowsUnwatchedQuery -> fetchAll(PDO::FETCH_COLUMN, 0);

        echo json_encode($unwatchedSeriesIdArray);
    }

}


?>