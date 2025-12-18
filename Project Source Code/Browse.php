<?php
session_start();

require "userStatusCheck.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Project - Browse</title>
    <link rel="stylesheet" href="styleBrowse.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #0b0b23; box-shadow: 0 4px 3px -3px gray;">
        <a href="Browse.php" class="navbar-brand mb-0 h1 ms-3">
            <i class="bi bi-tv"></i>
            Year in Computing Project
        </a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation"
            class="navbar-toggler border-0">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3 justify-content-end" id="mainNavigation">
            <ul class="navbar-nav">
                <li class="nav-item me-4">
                    <a href="Browse.php" class="nav-link active">
                        Browse
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a href="MyShows.php" class="nav-link">
                        My Shows
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a href="MyCalendar.php" class="nav-link">
                        My Calendar
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a href="userSignOut.php" class="nav-link">
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex" id="notifications"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <form class="formInput">
                    <div class="input-group">
                        <input type="text" class="form-control shadow searchBar" id="formInput"
                            placeholder="Search for a TV Series">
                        <button type="submit" class="btn btn-danger shadow">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col mt-4 text-center">
                <button type="button" class="btn btn-outline-primary justify-content-center queryBtns" id="trendingBtn">Trending</button>
                <button type="button" class="btn btn-outline-success justify-content-center queryBtns" id="topRatedBtn">Top Rated</button>
                <button type="button" class="btn btn-outline-info justify-content-center queryBtns" id="latestReleasesBtn">Latest Releases</button>
                <button type="button" class="btn btn-outline-dark justify-content-center queryBtns" id="airingTodayBtn">Airing Today</button>
                <button type="button" class="btn btn-outline-danger justify-content-center queryBtns" id="viewGenresBtn"data-bs-toggle="collapse" data-bs-target="#genreBar">Hide Genres <i class="bi bi-arrow-up"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col mt-4 text-center collapse show" id="genreBar">
            </div>
        </div>
    </div>

    <div class="container-md mt-5" id="content">
        <h1 class="fs-4 text-center contentEmpty fw-bold"><?php echo "Hello " . $_SESSION["userId"] . "! " ?> Browse for TV Shows to add to your library...</h2>
        <h1 class="fs-5 text-center">Use the search bar to find your favourite TV Shows,
            or discover new ones through the different categories and genres which are provided above!</h2>
    </div>

    <ul class="pagination justify-content-center">
        <li class="page-item back"><a class="page-link" id="backPage"><i class="bi bi-arrow-left backImg"></i>Back</a></li>
        <li class="page-item next"><a class="page-link" id="nextPage">Next<i class="bi bi-arrow-right nextImg"></i></a></li>
    </ul>

    <div class="d-flex justify-content-center align-items-center" id="notifications">
    </div>

    <div class="modal fade" id="openModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p class="fw-bold">Please select which category you wish to add this TV Show to</p>
                    <button type="button" class="btn btn-success saveWatched" data-bs-dismiss="modal">Watched / Watching</button>
                    <button type="button" class="btn btn-primary saveUnwatched" data-bs-dismiss="modal">Unwatched</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SCRIPT TAGS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>