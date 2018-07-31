$( "#search-movie" ).keyup(searchMovies);

function searchMovies() {
  let query = encodeURI($('#search-movie').val());
  theMovieDb.search.getMovie({"query":query}, (jsondata) => {
    let searchData = JSON.parse(jsondata);

    let titles = {};

    for (var i = 0; i < 6; i++) {
      let title = searchData.results[i].title;
      titles[title] = null;
    }

    $('input.autocomplete').autocomplete({
      data: titles, onAutocomplete
    });

    var instance = M.Autocomplete.getInstance($('input.autocomplete'));
    instance.open();

  }, errorCB);

}

function onAutocomplete() {
  let query = encodeURI($('#search-movie').val());
  theMovieDb.search.getMovie({"query": query }, (jsondata) => {
    let searchData = JSON.parse(jsondata).results[0];
    console.log(searchData);
    let tmdbId = searchData.id;
    window.location.href = "/movies/staging/movie/?m=" + tmdbId;
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
      let element = `<div class="movie-item"><a class="movie-image" href="/movies/staging/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movies/staging/movie/?m=${id}" class="movie-title">${title}</a></div>`;
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
    console.log(listData);
    listData.results.forEach(function(e) {
      let title = e.title;
      let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + e.poster_path;
      let id = e.id;
      let element = `<div class="movie-item"><a class="movie-image" href="/movies/staging/movie/?m=${id}"><img src="${posterURL}" alt="${title}"></a><a href="/movies/staging/movie/?m=${id}" class="movie-title">${title}</a></div>`;
      $('.watch-grid').append(element);
    });
    pagination(listData.page, listData.total_pages);
    $('.watch-grid').animate({opacity: "1"}, 500);
  }, errorCB);
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
    displayMovies();
  });
}


function errorCB(data) {
  console.log(data);
  return;
};
