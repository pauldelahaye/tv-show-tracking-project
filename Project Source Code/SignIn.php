<?php 
session_start();

if (isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] == 1) {
    header("Location: Browse.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Project - Sign In</title>
    <link rel="stylesheet" href="styleSignIn.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
    <script src="userAuth.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div id="signInContent" class="col p-4">
                <div class="text-center signInHeader"><i class="bi bi-tv bannerLogo"></i></div>
                <div class="text-center fw-bold fs-5 signInHeader">
                    Sign In
                </div>
                <div class="mb-4 text-center fw-bold signInHeader">
                    Year in Computing Project
                </div>
                <a class="btn btn-danger shadow m-4" id="backBtn" href="index.php"><i class="bi bi-arrow-left"></i></a>
                <form id="signInForm" class="needs-validation">
                    <div class="mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success shadow mb-4" id="authBtn" name="authenticate">Sign In</button>
                </form>

                <div id="signInError"></div>
            </div>
        </div>
    </div>


</body>

</html>