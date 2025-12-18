$(document).ready(function() {
    const TMDB_API_KEY = "";
    const TMDB_URL = "https://api.themoviedb.org/3/"

    const TMDB_IMAGE_URL = "https://image.tmdb.org/t/p/w500";
    const TMDB_SEARCH_URL = TMDB_URL + "search/tv?" + TMDB_API_KEY;

    const trendingQuery = TMDB_URL +  "discover/tv?with_original_language=en&" + TMDB_API_KEY;
    const searchQuery = TMDB_SEARCH_URL + "&query=";
    const topRatedQuery = TMDB_URL + "tv/top_rated?" + TMDB_API_KEY;
    const latestReleasesQuery = TMDB_URL + "tv/on_the_air?" + TMDB_API_KEY;
    const airingTodayQuery = TMDB_URL + "tv/airing_today?" + TMDB_API_KEY;

    //Pagination
    var previousQuery;
    var totalPages;
    var currentPage = 1;

    function pagePrevious() {
        if (currentPage > 1) {
            currentPage--;
        }

        return "&page=" + currentPage;
    }

    function pageNext() {
        if (currentPage < totalPages) {
            currentPage++;
        }

        return "&page=" + currentPage;
    }

    //Displaying api request

    function populateResults(queryType) {
        $.get({
            url: queryType,
            success: function(data) {
                $('#content').empty();
                $.each(data.results, function (index, value) {
                    $(`<div class="tvSeriesBlock">
                        <div class="imgContainer">
                            <img src="${TMDB_IMAGE_URL+value.poster_path}" alt="${value.name}" onerror="this.src='defaultImage.png'" draggable="false" data-bs-toggle="modal" data-bs-target="#openModal">
                            <div class="addToCollectionContainer">
                                <div class="addToCollectionBtn"><i class="bi bi-plus-circle-fill fs-1 addToCollectionIcon"></i></div>
                            </div>
                        </div>
                        <div class="tvSeriesDetails">
                            <h5>${value.name}</h5>
                        </div>
                    </div>`).data('id', value.id).appendTo('#content');
                });

                //Pagination
                //storing the api request 
                var currentQuery = queryType.replace(/&page=.*$/, "");

                //checking whether the previous query made is == to this one (or undefined due to no previous query) -> if previous query different from current
                //then return currentPage back to 1 since it is a new query and will be at page 1
                //if previous query is the same as the current -> do nothing
                if (previousQuery != undefined && previousQuery != currentQuery) {
                    currentPage = 1;
                }
                
                //make previous query == current query ready for the next time its checked
                previousQuery = currentQuery;

                //storing total pages & displaying buttons if > 0 && < totalpages
                totalPages = data.total_pages;

                if (totalPages >= 1) {
                    $('#backPage, #nextPage').css('display', 'inline');
                }
                if (currentPage == 1) {
                    $('.back').addClass('disabled');
                }
                if (currentPage > 1 && $('.back').hasClass('disabled')) {
                    $('.back').removeClass('disabled');
                }
                if (currentPage == totalPages || totalPages == 0) {
                    $('.next').addClass('disabled');
                }
                if (currentPage < totalPages && $('.next').hasClass('disabled')) {
                    $('.next').removeClass('disabled');
                }

        }, dataType:'json' });
    }


    //Genres

    function populateGenres() {
        $.get({
            url: TMDB_URL + "genre/tv/list?" + TMDB_API_KEY,
            success: function(data) {
                $.each(data.genres, function (index, value) {
                    $(`<button type="button" class="btn btn-outline-secondary justify-content-center genreBtn">${value.name}</button>`).data('genreId', value.id).appendTo('#genreBar');
                });
            }, dataType:'json' });
    }
    
    populateGenres();

    $('#genreBar').on('click', '.genreBtn', function() {
        currentPage = 1;
        populateResults(trendingQuery + "&with_genres=" + $(this).data('genreId'));
    });

    $('#viewGenresBtn').on('click', function() {
        if($('#viewGenresBtn').hasClass('collapsed')) {
            $('#viewGenresBtn').html('View Genres <i class="bi bi-arrow-down"></i>')
        } else {
            $('#viewGenresBtn').html('Hide Genres <i class="bi bi-arrow-up"></i>')
        }

    });

//Pagination buttons

    $('#backPage').on('click', function() {
        if (previousQuery != undefined) {
            populateResults(previousQuery + pagePrevious());
        }
    })

    $('#nextPage').on('click', function() {
        if (previousQuery != undefined) {
            populateResults(previousQuery + pageNext());
            window.scrollTo(0, 0);
        }
    })

//Trending

    $('#trendingBtn').on('click', function() {
        currentPage = 1;
        populateResults(trendingQuery);
    });


//Top Rated

$('#topRatedBtn').on('click', function() {
    currentPage = 1;
    populateResults(topRatedQuery);
});

//Latest Releases

$('#latestReleasesBtn').on('click', function() {
    currentPage = 1;
    populateResults(latestReleasesQuery);
});

//Airing Today

$('#airingTodayBtn').on('click', function() {
    currentPage = 1;
    populateResults(airingTodayQuery);
});


//Searching

    $('form').on('submit', function(form) {
        form.preventDefault();
        const userSearch = $('.searchBar').val();

        if (userSearch && userSearch.trim().length) {
            currentPage = 1;
            populateResults(searchQuery + userSearch);
            $('#formInput').val('');
        }
    });


//On-click of a show

    var clickedSeriesId;
    var clickedSeriesName;

    $('#content').on('click', '.tvSeriesBlock img', function() {
        clickedSeriesId = $(this).closest('.tvSeriesBlock').data('id');
        clickedSeriesName = $(this).attr('alt');
    });

    //Saving a show as watched or watching
    $('body').on('click', '.saveWatched', function() {
        $.post({
            url: 'userAddShowWatched.php',
            data: ({SeriesID: clickedSeriesId, SeriesName: clickedSeriesName}),
            success: function(response) {
                    $('#notifications').empty();
                    $(`<div class="toast text-white fs-6 bg-success border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${response}
                            </div>
                        <button type="button" class="btn-close me-2 m-auto btn-close-white" data-bs-dismiss="toast"></button>
                        </div>`).appendTo('#notifications');
                    var newNotif = new bootstrap.Toast($('.toast'));
                    newNotif.show();
            },
            dataType: 'text' });
    });

    //Saving a show as unwatched
    $('body').on('click', '.saveUnwatched', function() {
        $.post({
            url: 'userAddShowUnwatched.php',
            data: ({SeriesID: clickedSeriesId, SeriesName: clickedSeriesName}),
            success: function(response) {
                    $('#notifications').empty();
                    $(`<div class="toast text-white fs-6 bg-success border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${response}
                            </div>
                        <button type="button" class="btn-close me-2 m-auto btn-close-white" data-bs-dismiss="toast"></button>
                        </div>`).appendTo('#notifications');
                    var newNotif = new bootstrap.Toast($('.toast'));
                    newNotif.show();
            },
            dataType: 'text' });
    }); 


});