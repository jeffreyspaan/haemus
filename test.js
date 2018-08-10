$(document).ready(function() {

  // set up search event listeners

  $("#search-movie").keyup(searchMovies);

  $('.search-form').on('submit', function(e) {
    e.preventDefault();
    goToSearchedMovie();
  });

  // set up mobile menu event listener

  $('.mobile-menu-trigger').on('click', function() {
    $('body').toggleClass('mobile-menu-active');
  });

  // set up genres list event listener

  $('.genres-list-trigger').on('click', function(event) {
    $(this).toggleClass('active');
    $('.genres-list').toggleClass('active');
  });

});

function searchMovies() {
  let query = encodeURI($('#search-movie').val());
  theMovieDb.search.getMovie({"query":query}, (jsondata) => {
    let searchData = JSON.parse(jsondata);
    console.log(searchData);

    let titles = {};

    for (var i = 0; i < 6; i++) {
      let date = searchData.results[i].release_date;
      let year = date.substr(0,date.indexOf('-'));

      let title = searchData.results[i].title + ' (' + year + ')';
      titles[title] = null;
    }

    $('input.autocomplete').autocomplete({
      data: titles, goToSearchedMovie
    });

    var instance = M.Autocomplete.getInstance($('input.autocomplete'));
    instance.open();

  }, errorCB);

}

function goToSearchedMovie() {
  console.log('test');
  let query = $('#search-movie').val()
  let queryTitle = query.substr(0,query.indexOf('('));
  queryTitle = encodeURI(queryTitle);
  theMovieDb.search.getMovie({"query": queryTitle }, (jsondata) => {
    let searchData = JSON.parse(jsondata).results[0];
    console.log(searchData);
    let tmdbId = searchData.id;
    window.location.href = "/movie/?m=" + tmdbId;
  }, errorCB);
}


function displayMovies() {
  let filterOptions = getFilterOptions();
  $('.watch-grid').empty();
  theMovieDb.discover.getMovies(filterOptions, (jsondata) => {
    let listData = JSON.parse(jsondata);
    listData.results.forEach(function(e) {
      let title = e.title;
      let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
      let id = e.id;
      let element = `<div class="movie-item"><a class="movie-image z-depth-3" href="/movies/staging/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movies/staging/movie/?m=${id}" class="movie-title">${title}</a></div>`;
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
    listData.results.forEach(function(e) {
      let title = e.title;
      let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
      let id = e.id;
      let element = `<div class="movie-item"><a class="movie-image z-depth-3" href="/movies/staging/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movies/staging/movie/?m=${id}" class="movie-title">${title}</a></div>`;
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
    listData.results.forEach(function(e) {
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

function displaySimilarMovies(id) {
  $('.watch-grid').empty();
  theMovieDb.movies.getSimilarMovies({"id": id}, (jsondata) => {
    let listData = JSON.parse(jsondata);
    console.log(listData);
    for (var i = 0; i < 5; i++) {
      let title = listData.results[i].title;
      let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + listData.results[i].poster_path;
      let id = listData.results[i].id;
      let element = `<div class="movie-item"><a class="movie-image" href="/movies/staging/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movies/staging/movie/?m=${id}" class="movie-title">${title}</a></div>`;
      $('.watch-grid').append(element);
    }
    $('.watch-grid').animate({opacity: "1"}, 500);
  }, errorCB)
}

function pagination(currentPage, totalPages) {
  $('.pagination').empty();
  if (totalPages > 25 ) {
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
  $('.change-page:not(.active)').on('click', function(e) {
    page = $(this).attr('data-page');
    $('.watch-grid').animate({opacity: "0"}, 1);
    if ( $('body').hasClass('genres') ) {
      displayMoviesByGenre();
    } else if ( $('body').hasClass('trending') ) {
      displayUpcomingMovies();
    } else {
      displayMovies();
    }
  });
}


function errorCB(data) {
  console.log(data);
  return;
};
