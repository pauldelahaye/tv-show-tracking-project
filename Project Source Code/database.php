<?php
    $servername = "dragon.kent.ac.uk";
    $username = "pd294";
    $password = "";
    $dbname = "pd294";

    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(PDOException $e) {
        echo "<p>Connection Failed " . $e->getMessage() . "</p>";
        die();
    }
?>