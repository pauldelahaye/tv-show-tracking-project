<?php
session_start();

require "countriesList.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Project - Sign In</title>
    <link rel="stylesheet" href="styleSignUp.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
    <script src="userAuth.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div id="signUpContent" class="col p-4">
                <div class="text-center signUpHeader"><i class="bi bi-tv bannerLogo"></i></div>
                <div class="text-center fw-bold fs-5 signUpHeader">
                    Sign Up
                </div>
                <div class="mb-4 text-center fw-bold signUpHeader">
                    Year in Computing Project
                </div>
                <a class="btn btn-danger shadow m-4" id="backBtn" href="index.php"><i class="bi bi-arrow-left"></i></a>
                <form id="signUpForm" class="needs-validation">
                    <div class="mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Your Username" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-4">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" min="1900-01-01" <?php echo 'max="' . date("Y-m-d") . '"' ?> required>
                    </div>
                    <div class="mb-4">
                        <label for="country" class="form-label">Country</label>
                        <select id="country" name="country" class="form-control" required>
                            <?php 
                            foreach ($countries as $value) {
                                echo "<option value='" . $value . "'>" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}" title="Your password must have a minimum of 6 characters, incuding at least one number, one uppercase letter and one lowercase letter" required>
                    </div>
                    <button type="submit" class="btn btn-success shadow mb-4" id="authBtn" name="authenticate">Sign Up</button>
                </form>

                <div id="signUpError"></div>
            </div>
        </div>
    </div>


</body>

</html>