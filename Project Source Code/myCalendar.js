const TMDB_API_KEY = "api_key=95d2fe6948aedf7af7f1c978bc2b22ce";
const TMDB_URL = "https://api.themoviedb.org/3/"

const TMDB_ID_URL = TMDB_URL + "tv/"

var myCalendar = new FullCalendar.Calendar(document.querySelector('#content'), {
    headerToolbar: {
        left: 'dayGridMonth,dayGridWeek,dayGridDay',
        center: 'title',
        right: 'prev,today,next'
    },
    buttonText: {
        today: 'Today',
        day: 'Day',
        week: 'Week',
        month: 'Month',
    },
    initialView: 'dayGridMonth',
    height: 800,
});

function getNextEpisodeDates(queryType) {
    $.get({
        url: queryType,
        success: function(data) {
            const nextEpisodeDate = data.next_episode_to_air?.air_date ?? 'undefined';
            if (nextEpisodeDate != 'undefined') {
                myCalendar.addEvent({
                    title: data.name + " - " + "New Episode",
                    start: data.next_episode_to_air.air_date,
                    description: 'test',
                    backgroundColor: '#151542',
                    borderColor: '#151542',
                });
            } else {
                myCalendar.addEvent({
                    title: data.name + " - " + "Last Aired",
                    start: data.last_episode_to_air.air_date,
                    description: 'test',
                    backgroundColor: '#151542a6',
                    borderColor: '#151542a6',
                });
            }
    }, dataType:'json' });
}

myCalendar.render();