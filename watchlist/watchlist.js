$(document).ready(function () {

    displayMoviesInWatchlist();

    $('.watch-grid').on('click', '.delete',  function(e){
        let id = $(this).data('movie');
        removeFromWatchlist(id);
        $(this).parent().parent().slideToggle(100);
    });

});

function displayMoviesInWatchlist() {
    $('.watch-grid').empty();

    let request = $.ajax({
        url: '/watchlist/getWatchlist.php'
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        if (response.hasError) {
            $('.watch-grid').html(response.message);
        } else {
            response.movies.forEach(function (id) {
                theMovieDb.movies.getById({"id": id}, (jsondata) => {
                    let movieData = JSON.parse(jsondata);
                    let title = movieData.title;
                    let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + movieData.poster_path;
                    let id = movieData.id;
                    let element = `<div class="movie-item"><div class="wrapper"><a class="movie-image z-depth-3" href="/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><div class="overlay"></div><a href="#" class="button only-icon delete" data-movie="${id}"><i class="material-icons">delete</i></a></div><a href="/movie/?m=${id}" class="movie-title">${title}</a></div>`;
                    $('.watch-grid').append(element);
                }, errorCB);
            });
        }
        $('.watch-grid').animate({opacity: "1"}, 500);
    });
}

function removeFromWatchlist(id) {
    let request = $.ajax({
        url: '/watchlist/removeFromWatchlist.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        M.toast({html: response.message, displayLength: 5000, classes: 'z-depth-3'});
    });
}