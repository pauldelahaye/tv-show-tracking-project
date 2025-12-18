const TMDB_API_KEY = "api_key=95d2fe6948aedf7af7f1c978bc2b22ce";
const TMDB_URL = "https://api.themoviedb.org/3/"

const TMDB_IMAGE_URL = "https://image.tmdb.org/t/p/w500";

const TMDB_ID_URL = TMDB_URL + "tv/"


function populateMyShows(queryType) {
    $.get({
        url: queryType,
        success: function(data) {
            $(`<div class="tvSeriesBlockContainer">
                <div class="tvSeriesBlock">
                    <img src="${TMDB_IMAGE_URL+data.poster_path}" alt="${data.name}" onerror="this.src='defaultImage.png'" draggable="false">
                </div>
                <div class="tvSeriesDetails">
                    <div class="myShowsTitle"><p>${data.name}</p></div>
                    <div class="myShowsDate"><p>${data.first_air_date.split('-').reverse().join('-')}</p></div>
                    <div class="myShowsRating"><p>${data.vote_average}</p></div>
                    <div class="myShowsDesc"><p>${data.overview}</p></div>
                </div>
                <div class="optionsContainer">
                </div>
            </div>`).data('id', data.id).appendTo('#content');

            if ($('#watched').hasClass('selected')) {
                $('.optionsContainer').empty();
                $('.optionsContainer').append('<button type="button" class="btn btn-dark moveUnwatched" id="btn1">Move to Unwatched</button>')
                $('.optionsContainer').append('<button type="button" class="btn btn-danger removeShow" id="btn1">Remove from My Shows</button>')
            } 
            
            if ($('#unwatched').hasClass('selected')){
                $('.optionsContainer').empty();
                $('.optionsContainer').append('<button type="button" class="btn btn-success moveWatched" id="btn1">Move to Watched</button>')
                $('.optionsContainer').append('<button type="button" class="btn btn-danger removeShow" id="btn1">Remove from My Shows</button>')
            }
    }, dataType:'json' });
}


$(document).ready(function() {

//On-hover option -> move tv show to unwatched
    $('#content').on('click', '.moveUnwatched', function() {
        const clickedSeriesId = $(this).closest('.tvSeriesBlockContainer').data('id');

        $.post({
            url: 'userMoveShowUnwatched.php',
            data: {SeriesID: clickedSeriesId},
            success: function(response) {
                location.reload();
            },
            dataType: 'text' });
    })

//On-hover option -> move tv show to watched
    $('#content').on('click', '.moveWatched', function() {
        const clickedSeriesId = $(this).closest('.tvSeriesBlockContainer').data('id');

        $.post({
            url: 'userMoveShowWatched.php',
            data: {SeriesID: clickedSeriesId},
            success: function(response) {
                location.reload();
            },
            dataType: 'text' });
    })

//On-hover option -> remove tv show from my shows
    $('#content').on('click', '.removeShow', function() {
        const clickedSeriesId = $(this).closest('.tvSeriesBlockContainer').data('id');

        $.post({
            url: 'userRemoveShow.php',
            data: {SeriesID: clickedSeriesId},
            success: function(response) {
                location.reload();
            },
            dataType: 'text' });
    })


//Filter buttons
    $('#watched, #unwatched').on('click', function() {
        $('#watched, #unwatched').removeClass();
        $(this).addClass('selected');
        const clickedFilterOption = $(this).text();

        $.post({
            url: 'myShowsFilter.php',
            data: {FilterOption: clickedFilterOption},
            success: function(data) {
                if (data.length > 0) {
                    $(document).find('.emptyWarning').remove();
                    $('#content').empty();
                    for(var i = 0; i < data.length; i++) {
                        populateMyShows(TMDB_ID_URL + data[i] + "?" + TMDB_API_KEY)
                    }
                } else {
                    $('#content').empty();
                }
            },
            dataType: 'json' });

    });

});