<?php 

if ($_SESSION["userStatus"] != 1) {
    header("Location: index.php");
}

?>