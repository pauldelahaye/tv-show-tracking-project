<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Project - Homepage</title>
    <link rel="stylesheet" href="styleHomepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>

<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div id="mainContent" class="col text-center">
                <i class="bi bi-tv bannerLogo"></i>
                <p class="fw-bold fs-5">Year in Computing Project</p>
                <div class="mainButtons">
                    <a class="btn btn-success shadow" id="signUpBtn" href="SignUp.php">Sign Up</a>
                    <a class="btn btn-success shadow" id="signInBtn" href="SignIn.php">Sign In</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SCRIPT TAGS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="#"></script>
</body>

</html>