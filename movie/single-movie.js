$(document).ready(function () {

    // get movie id and call displayMovieData function

    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    if (getUrlVars()['m']) {
        let id = getUrlVars()['m'].replace(/(\d+)(\D*)/i, '$1');
        displayMovieData(id);
    }

    // set up material elements, e.g. modals, tabs & imagemodals

    $('.materialboxed').materialbox();
    $('#watch-movie.modal').modal({onOpenStart: updateWatchTabs, opacity: 0.7});
    $('#watch-trailer.modal').modal({onCloseStart: stopVideo});
    $('#watch-movie .tabs').tabs();

    // set up buttons event listeners

    $('.details').on('click', '.favorites.add', addToFavorites);
    $('.details').on('click', '.favorites.remove', removeFromFavorites);

    $('.details').on('click', '.watchlist.add', addToWatchlist);
    $('.details').on('click', '.watchlist.remove', removeFromWatchlist);

});

let favoritesButton = $('.button.favorites');
let watchlistButton = $('.button.watchlist');


// Favorites functions

function addToFavorites() {
    let id = favoritesButton.data('movie');
    let request = $.ajax({
        url: '/favorites/addToFavorites.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        M.toast({html: response.message, displayLength: 5000, classes: 'z-depth-3'});
        if (!response.hasError) {
            setFavoritesToRemove();
        }
    });
}

function removeFromFavorites() {
    let id = favoritesButton.data('movie');
    let request = $.ajax({
        url: '/favorites/removeFromFavorites.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        M.toast({html: response.message, displayLength: 5000, classes: 'z-depth-3'});
        if (!response.hasError) {
            setFavoritesToAdd();
        }
    });
}

function checkForFavorites(id) {
    let request = $.ajax({
        url: '/favorites/checkForFavorites.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        if (response.hasError) {
            setFavoritesToAdd();
        } else if (response.movieIsInFavorites) {
            setFavoritesToRemove();
        } else {
            setFavoritesToAdd();
        }
    });
}

function setFavoritesToAdd() {
    favoritesButton.removeClass('remove active');
    favoritesButton.addClass('add');
}

function setFavoritesToRemove() {
    favoritesButton.removeClass('add');
    favoritesButton.addClass('remove active');
}


// Watchlist functions

function addToWatchlist() {
    let id = watchlistButton.data('movie');
    let request = $.ajax({
        url: '/watchlist/addToWatchlist.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        M.toast({html: response.message, displayLength: 5000, classes: 'z-depth-3'});
        if (!response.hasError) {
            setWatchlistToRemove();
        }
    });
}

function removeFromWatchlist() {
    let id = watchlistButton.data('movie');
    let request = $.ajax({
        url: '/watchlist/removeFromWatchlist.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        M.toast({html: response.message, displayLength: 5000, classes: 'z-depth-3'});
        if (!response.hasError) {
            setWatchlistToAdd();
        }
    });
}

function checkForWatchlist(id) {
    let request = $.ajax({
        url: '/watchlist/checkForWatchlist.php',
        type: 'POST',
        data: 'movieId=' + id
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        if (response.hasError) {
            setWatchlistToAdd();
        } else if (response.movieIsInWatchlist) {
            setWatchlistToRemove();
        } else {
            setWatchlistToAdd();
        }
    });
}

function setWatchlistToAdd() {
    watchlistButton.removeClass('remove active');
    watchlistButton.addClass('add');
}

function setWatchlistToRemove() {
    watchlistButton.removeClass('add');
    watchlistButton.addClass('remove active');
}

// modal functions

function updateWatchTabs() {
    $('#watch-movie .tabs .indicator').css('left', '25%');
}

function stopVideo() {
    let videoPlayerSource = $('#watch-trailer-iframe').attr("src");
    $('#watch-trailer-iframe').attr("src", videoPlayerSource);
}

// moviedata functions

function displayMovieData(id) {
    theMovieDb.movies.getById({"id": id}, (jsondata) => {
        let movieData = JSON.parse(jsondata);
        console.log(movieData);

        // create links to genres

        let genresArray = [];
        movieData.genres.forEach(function (e) {
            let link = `<a href="/genres/?g=${e.id}-${e.name}">${e.name}</a>`;
            genresArray.push(link);
        });

        let genres = genresArray.join(', ');

        // create 1337x torrent link

        let releaseFull = new Date(movieData.release_date);
        let releaseYear = releaseFull.getFullYear();
        let torrentLink = 'https://1337x.to/movie/' + id + '/' + encodeURI(movieData.title).replace(/\%20/g, '-') + '-' + releaseYear + '/';

        // display basic movie data

        $('#display-backdrop').css('background-image', 'url(' + theMovieDb.common.images_uri + 'w1280' + movieData.backdrop_path + ')');
        $('.display-title').html(movieData.title);
        $('#display-overview').html(movieData.overview);
        $('#display-runtime').html(movieData.runtime + ' min');
        $('#display-release').html(movieData.release_date);
        $('#display-genres').html(genres);
        $('#display-tagline').html(movieData.tagline);
        $('#display-tmdb-rating').html(movieData.vote_average);
        $('#display-torrent-link').attr('href', torrentLink);
        $('#display-movieonline-link').attr('href', 'https://www3.movieonline.tv/movie/search.html?keyword=' + encodeURI(movieData.title));
        $('#display-gomovies2-link').attr('href', 'https://www.gomovieshub.se/search?kw=' + encodeURI(movieData.title));
        $('#display-gomovies-link').attr('href', 'http://www1.gomovies.vc/movie/search/' + encodeURI(movieData.title).replace(/\%20/g, '+'));
        $('#display-fmovies-link').attr('href', 'https://www7.fmovies.se/search?keyword=' + encodeURI(movieData.title));

        // buttons

        $('.button.favorites').data('movie', movieData.id);
        $('.button.watchlist').data('movie', movieData.id);

        checkForFavorites(movieData.id);
        checkForWatchlist(movieData.id);

        // poster

        if (movieData.poster_path) {
            $('#display-poster').attr('src', theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + movieData.poster_path);
        } else {
            $('.item-ea').empty();
            $('.item-ea').append(`<div class="no-image" style="width: 170px;height: 250px;"><i class="material-icons large">image</i></div>`);
        }

        // collection

        if (movieData.belongs_to_collection) {
            $('#display-collection-poster').attr('src', theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + movieData.belongs_to_collection.poster_path);

            let collectionLink = '/collection/?c=' + movieData.belongs_to_collection.id;
            let element = `<div class="item">Part of</div><div class="item"><a href="${collectionLink}">${movieData.belongs_to_collection.name}</a></div>`;
            $('.information-grid').append(element);
            $('#display-collection-link').attr('href', collectionLink);
        }

        // watch-services e.g. netflix

        displayServicesLinks(movieData.imdb_id, movieData.title);

    }, errorCB);

    // display trailer

    theMovieDb.movies.getVideos({"id": id}, (jsondata) => {
        let trailerData = JSON.parse(jsondata);
        console.log(trailerData);
        let trailerURL = trailerData.results[0].key;
        $('#watch-trailer-iframe').attr('src', 'https://www.youtube-nocookie.com/embed/' + trailerURL + '?rel=0&amp;showinfo=0');
    }, errorCB);

    // display images

    theMovieDb.movies.getImages({"id": id}, (jsondata) => {
        let imagesData = JSON.parse(jsondata);
        if (imagesData.backdrops[1]) {
            let pictureOneSource = theMovieDb.common.images_uri + 'w1280' + imagesData.backdrops[1].file_path;
            $('#display-picture-1').attr('src', pictureOneSource);
        }
        if (imagesData.backdrops[2]) {
            let pictureTwoSource = theMovieDb.common.images_uri + 'w1280' + imagesData.backdrops[2].file_path;
            $('#display-picture-2').attr('src', pictureTwoSource);
        }
        if (imagesData.backdrops[3]) {
            let pictureThreeSource = theMovieDb.common.images_uri + 'w1280' + imagesData.backdrops[3].file_path;
            $('#display-picture-3').attr('src', pictureThreeSource);
        }
    }, errorCB);

    // display similar movies (call to base.js)

    displaySimilarMovies(id);

}

// get and display available watch services

function displayServicesLinks(id, title) {
    let request = $.ajax({
        url: 'services.php',
        type: 'POST',
        data: 'id=' + id + '&title=' + title
    });
    request.done(function (jsonResponse) {
        let response = JSON.parse(jsonResponse);
        console.log(response);
        // console.log(jsonResponse);
        if (response) {
            if (response.netflix) {
                $('#stream.watch-options').prepend(`<a class="service" href="${response.netflix}" target="_blank"><img src="/assets/images/movies/watch-netflix.png" alt=""><h6>Netflix</h6></a>`);
            }
            if (response.ziggo) {
                $('#rent.watch-options').prepend(`<a class="service" href="${response.ziggo}" target="_blank"><img src="/assets/images/movies/watch-ziggo.png" alt=""><h6>Ziggo Movies & Series</h6></a>`);
            }
            if (response.videoland) {
                $('#stream.watch-options').prepend(`<a class="service" href="${response.videoland}" target="_blank"><img src="/assets/images/movies/watch-videoland.png" alt=""><h6>Videoland</h6></a>`);
            }
            if (response.amazonPrime) {
                $('#stream.watch-options').prepend(`<a class="service" href="${response.amazonPrime}" target="_blank"><img src="/assets/images/movies/watch-amazon-prime.png" alt=""><h6>Amazon Prime</h6></a>`);
            }
            if (response.patheThuis) {
                $('#rent.watch-options').prepend(`<a class="service" href="${response.patheThuis}" target="_blank"><img src="/assets/images/movies/watch-pathe-thuis.png" alt=""><h6>Pathé Thuis</h6></a>`);
            }
            if (response.film1) {
                $('#stream.watch-options').prepend(`<a class="service" href="${response.film1}" target="_blank"><img src="/assets/images/movies/watch-film1.png" alt=""><h6>Film1</h6></a>`);
            }
            if (response.ziggoGo) {
                $('#stream.watch-options').prepend(`<a class="service" href="${response.ziggoGo}" target="_blank"><img src="/assets/images/movies/watch-ziggogo.png" alt=""><h6>Ziggo Movies & Series XL</h6></a>`);
            }
            if (response.googlePlay) {
                $('#rent.watch-options').prepend(`<a class="service" href="${response.googlePlay}" target="_blank"><img src="/assets/images/movies/watch-google-play.png" alt=""><h6>Google Play Movies</h6></a>`);
            }
            if (response.patheCinema) {
                $('#cinema.watch-options').prepend(`<a class="service" href="${response.patheCinema}" target="_blank"><img src="/assets/images/movies/watch-pathe-cinema.png" alt=""><h6>Pathé</h6></a>`);
            }
            $('.services-preloader').remove();
        } else {
            $('.sevices-preloader').remove();
        }
    });
}
