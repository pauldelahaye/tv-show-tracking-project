<?php
session_start();

require "database.php";

$newUserUsername = $_POST["username"];
$newUserEmail = $_POST["email"];
$newUserDOB = $_POST["dob"];
$newUserCountry = $_POST["country"];
$newUserPassword = $_POST["password"];

$newUsernameQuery = $db -> prepare("SELECT `Username` FROM ProjectUsers WHERE Username = ?");
$params = array($newUserUsername);
$newUsernameQuery -> execute($params);


if ($newUsernameQuery -> rowCount() > 0) {
    echo "The username '" . $newUserUsername . "' is already in use, please try again with a different username.";
}

$newEmailQuery = $db -> prepare("SELECT `Email` FROM ProjectUsers WHERE Email = ?");
$params = array($newUserEmail);
$newEmailQuery -> execute($params);

if ($newEmailQuery -> rowCount() > 0) {
    echo "The email address '" . $newUserEmail . "' is already associated with a registered account.";
}

if ($newUsernameQuery -> rowCount() == 0 && $newEmailQuery -> rowCount() == 0) {

    $createNewUserQuery = $db -> prepare("INSERT INTO ProjectUsers (`Username`, `Password`, `Email`, `Country`, `DOB`) VALUES (?, ?, ?, ?, ?)");
    $newUserPasswordHash = password_hash($newUserPassword, PASSWORD_DEFAULT); //hashing users password before inserting it to db
    $params = array($newUserUsername, $newUserPasswordHash, $newUserEmail, $newUserCountry, $newUserDOB);
    $createNewUserQuery -> execute($params);
    echo "<script>location.replace('SignIn.php')</script>";

}

?>