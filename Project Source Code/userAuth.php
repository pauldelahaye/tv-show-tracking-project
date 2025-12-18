<?php
session_start();

require "database.php";

$attemptedUsername = $_POST["username"];
$attemptedPassword = $_POST["password"];


$loginQuery = $db -> prepare("SELECT `Username`, `Password` FROM ProjectUsers WHERE Username = ?");
$params = array($attemptedUsername);
$loginQuery -> execute($params);

if ($loginQuery -> rowCount() == 0) {
    echo "The username entered was not recognised, please try again or create a new account.";
} 

if ($loginQuery -> rowCount() > 0) {
    $result = $loginQuery -> fetch(PDO::FETCH_ASSOC);
    $dbPassword = $result["Password"];
    $dbUsername = $result["Username"];
    
    if (password_verify($attemptedPassword, $dbPassword)) {
        $_SESSION["userStatus"] = 1;
        $_SESSION["userId"] = $dbUsername;
        echo "<script>location.replace('Browse.php')</script>";
    } else {
        echo "The password entered is incorrect. Please try again.";
    }

}



?>