$(document).ready(function () {

    // set up search event listeners

    $("#search-movie").keyup(searchMovies);

    $('.search-form').on('submit', function (e) {
        e.preventDefault();
        onAutocomplete();
    });

    // set up mobile menu event listener

    $('.mobile-menu-trigger').on('click', function () {
        $('body').toggleClass('mobile-menu-active');
    });

    // set up genres list event listener

    $('.genres-list-trigger').on('click', function (event) {
        $(this).toggleClass('active');
        $('.genres-list').toggleClass('active');
    });

    let loginModalElement;
    let loginModal;

    if (loginModalElement = document.querySelectorAll('#account-connect')) {
        loginModal = M.Modal.init(loginModalElement, {opacity: 0.7});
    }

    let accountSettingsModalElement;
    let accountSettingsModal;

    if (accountSettingsModalElement = document.querySelectorAll('#account-settings')) {
        accountSettingsModal = M.Modal.init(accountSettingsModalElement, {opacity: 0.7});
    }

    $('#account-connect .tabs').tabs();

    $('#login-form').on('submit', function (event) {
        event.preventDefault();

        let loginMessage = $('#login-message');

        loginMessage.removeClass('error');
        loginMessage.empty();

        let request = $.ajax({
            url: '/login.php',
            type: 'POST',
            data: $(this).serialize()
        });
        request.done(function (jsonResponse) {
            console.log(jsonResponse);
            let response = JSON.parse(jsonResponse);
            loginMessage.html(response.message);
            if (response.hasError) {
                loginMessage.addClass('error');
            } else {
                let loginModalInstance = M.Modal.getInstance($('#account-connect'));
                loginModalInstance.close();
                location.reload();
            }
        });
    });

    $('#signup-form').on('submit', function (event) {
        event.preventDefault();

        let signupMessage = $('#signup-message');

        signupMessage.removeClass('error');
        signupMessage.empty();

        let request = $.ajax({
            url: '/signup.php',
            type: 'POST',
            data: $(this).serialize()
        });
        request.done(function (jsonResponse) {
            console.log(jsonResponse);
            let response = JSON.parse(jsonResponse);
            signupMessage.html(response.message);
            if (!response.hasError) {
                let loginModalInstance = M.Modal.getInstance($('#account-connect'));
                loginModalInstance.close();
                location.reload();
            } else {
                signupMessage.addClass('error');
            }
        });
    });

    $("#logout").on("click", function () {

        let accountSettingsMessage = $('#account-settings .message');

        accountSettingsMessage.removeClass('error');
        accountSettingsMessage.empty();

        let request = $.ajax({
            url: '/logout.php'
        });
        request.done(function (jsonResponse) {
            let response = JSON.parse(jsonResponse);
            accountSettingsMessage.html(response.message);
            if (!response.hasError) {
                let loginModalInstance = M.Modal.getInstance($('#account-settings'));
                loginModalInstance.close();
                location.reload();
            } else {
                accountSettingsMessage.addClass('error');
            }
        });
    });

    $('.movie-item').draggable();

    $(document).on('click','.movie-item', function(){
        $('.movie-item ').draggable({
            revert: "invalid", // when not dropped, the item will revert back to its initial position
            containment: "document",
            helper: "clone",
            cursor: "move"
        });
    });



});

function searchMovies() {
    let query = encodeURI($('#search-movie').val());
    theMovieDb.search.getMovie({"query": query}, (jsondata) => {
        let searchData = JSON.parse(jsondata);


        let titles = {};

        for (let i = 0; i < 6; i++) {
            let date = searchData.results[i].release_date;
            let year = date.substr(0, date.indexOf('-'));

            let title = searchData.results[i].title + ' (' + year + ')';
            titles[title] = null;
        }

        console.log(titles);

        $('input.autocomplete').autocomplete({
            data: titles, onAutocomplete
        });

        let instance = M.Autocomplete.getInstance($('#search-movie.autocomplete'));
        instance.open();

    }, errorCB);

}

// go to searched movie

function onAutocomplete() {
    let query = $('#search-movie').val()
    let queryTitle = query.substr(0, query.indexOf('('));
    queryTitle = encodeURI(queryTitle);
    theMovieDb.search.getMovie({"query": queryTitle}, (jsondata) => {
        let searchData = JSON.parse(jsondata).results[0];
        let tmdbId = searchData.id;
        window.location.href = "/movie/?m=" + tmdbId;
    }, errorCB);
}

// dislay movies functions

function displayMovies() {
    let filterOptions = getFilterOptions();
    $('.watch-grid').empty();
    theMovieDb.discover.getMovies(filterOptions, (jsondata) => {
        let listData = JSON.parse(jsondata);
        listData.results.forEach(function (e) {
            let title = e.title;
            let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
            let id = e.id;
            let element = `<div class="movie-item"><a class="movie-image z-depth-3" href="/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movie/?m=${id}" class="movie-title">${title}</a></div>`;
            $('.watch-grid').append(element);
        });
        pagination(listData.page, listData.total_pages);
        $('.watch-grid').animate({opacity: "1"}, 500);

    }, errorCB);
}

function displayUpcomingMovies() {
    let filterOptions = getFilterOptions();
    $('.watch-grid').empty();
    theMovieDb.movies.getUpcoming(filterOptions, (jsondata) => {
        let listData = JSON.parse(jsondata);
        listData.results.forEach(function (e) {
            let title = e.title;
            let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
            let id = e.id;
            let element = `<div class="movie-item"><a class="movie-image z-depth-3" href="/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movie/?m=${id}" class="movie-title">${title}</a></div>`;
            $('.watch-grid').append(element);
        });
        pagination(listData.page, listData.total_pages);
        $('.watch-grid').animate({opacity: "1"}, 500);
    }, errorCB);
}

function displayMoviesByGenre() {
    let filterOptions = getFilterOptions();
    $('.watch-grid').empty();
    theMovieDb.genres.getMovies(filterOptions, (jsondata) => {
        let listData = JSON.parse(jsondata);
        console.log(listData);
        listData.results.forEach(function (e) {
            let title = e.title;
            let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
            let id = e.id;
            let element = `<div class="movie-item"><a class="movie-image z-depth-3" href="/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movie/?m=${id}" class="movie-title">${title}</a></div>`;
            $('.watch-grid').append(element);
        });
        pagination(listData.page, listData.total_pages);
        $('.watch-grid').animate({opacity: "1"}, 500);
    }, errorCB);
}

function displayMoviesByCollection() {
    let filterOptions = getFilterOptions();
    $('.watch-grid').empty();
    theMovieDb.collections.getDetails(filterOptions, (jsondata) => {
        let listData = JSON.parse(jsondata);

        // hero setup
        $('#display-backdrop').css('background-image', 'url(' + theMovieDb.common.images_uri + 'w1280' + listData.backdrop_path + ')');
        $('#display-collection-name').html(listData.name);
        $('#display-collection-overview').html(listData.overview);
        if (listData.poster_path) {
            $('#display-collection-poster').attr('src', theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + listData.poster_path);
        }

        console.log(listData);

        listData.parts.forEach(function (e) {
            let image;
            let title = e.title;
            if (e.poster_path) {
                posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
                image = `<img src="${posterURL}">`
            } else {
                image = `<div class="no-image"><i class="material-icons large">image</i></div>`
            }

            let id = e.id;
            let element = `<div class="movie-item"><a class="movie-image z-depth-3" href="/movie/?m=${id}">${image}</a><a href="/movie/?m=${id}" class="movie-title">${title}</a></div>`;
            $('.watch-grid').append(element);
        });

        $('.watch-grid').animate({opacity: "1"}, 500);
    }, errorCB);
}

function displaySimilarMovies(id) {
    $('.watch-grid').empty();
    theMovieDb.movies.getSimilarMovies({"id": id}, (jsondata) => {
        let listData = JSON.parse(jsondata);
        console.log(listData);
        for (var i = 0; i < 5; i++) {
            let title = listData.results[i].title;
            let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + listData.results[i].poster_path;
            let id = listData.results[i].id;
            let element = `<div class="movie-item"><a class="movie-image" href="/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movie/?m=${id}" class="movie-title">${title}</a></div>`;
            $('.watch-grid').append(element);
        }
        $('.watch-grid').animate({opacity: "1"}, 500);
    }, errorCB)
}

// pagination display, update and event listeners

function pagination(currentPage, totalPages) {
    $('.pagination').empty();
    if (totalPages > 25) {
        totalPages = 25;
    }
    for (var i = 1; i <= totalPages; i++) {
        if (i != currentPage) {
            $('.pagination').append(`<li class="change-page" data-page="${i}"><a href="#!">${i}</a></li>`);
        } else {
            $('.pagination').append(`<li class="change-page active"><a href="#!">${i}</a></li>`);
        }
    }
    updatePaginationListeners();
}

function updatePaginationListeners() {
    $('.change-page').off();
    $('.change-page:not(.active)').on('click', function (e) {
        page = $(this).attr('data-page');
        $('.watch-grid').animate({opacity: "0"}, 1);
        if ($('body').hasClass('genres')) {
            displayMoviesByGenre();
        } else if ($('body').hasClass('trending')) {
            displayUpcomingMovies();
        } else {
            displayMovies();
        }
    });
}

// deafult error function for themoviedb lookups

function errorCB(data) {
    console.log(data);
    return;
};
