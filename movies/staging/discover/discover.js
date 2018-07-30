$(document).ready(function() {

  let page = 1;
  let minimumVote = 100;

  let sortYear = '2018-01-01';
  let sortType = 'popularity';
  let sortOrder = 'desc';

  createCarousel();
  displayMovies();

  $('.change-sort').on('click', function(e) {
    if ($(this).attr('data-sort-year')) {
      sortYear = $(this).attr('data-sort-year') + '-01-01' ;
      console.log(sortYear);
      $('.sort-year').children().removeClass('active');
      $(this).addClass('active');

      page = 1;
    } else if ($(this).attr('data-sort-type')) {
      sortType = $(this).attr('data-sort-type');
      $('.sort-type').children().removeClass('active');
      $(this).addClass('active');

      page = 1;
    }

    if (sortType == 'vote_average') {
      minimumVote = 3000;
    } else {
      minimumVote = 100;
    }

    $('.watch-grid').animate({opacity: "0"}, 1);
    displayMovies();
  });

  function getFilterOptions() {
    return {'primary_release_date.gte': sortYear, 'page': page, 'vote_count.gte': minimumVote, 'sort_by': sortType + '.' + sortOrder};
  }

  function createCarousel() {
    theMovieDb.discover.getMovies({'primary_release_date.gte': '2018-07-20', 'vote_count.gte': 10, 'sort_by': 'popularity.desc'}, (jsondata) => {
      let listData = JSON.parse(jsondata);
      for (var i = 0; i < 5; i++) {
        let currentCarouselItem = $(`.carousel-item:nth-child(${i + 1})`);
        currentCarouselItem.attr('href', '/movies/staging/movie/?m=' + listData.results[i].id);
        currentCarouselItem.attr('data-backdrop', theMovieDb.common.images_uri + 'w1280' + listData.results[i].backdrop_path);
        currentCarouselItem.attr('data-title', listData.results[i].title);
        currentCarouselItem.attr('data-overview', listData.results[i].overview);
        $(`.carousel-item:nth-child(${i + 1}) > img`).attr('src', theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + listData.results[i].poster_path);
      }
      $('.carousel').carousel({onCycleTo: () => {
          let currentBackdrop = $('.carousel-item.active').attr('data-backdrop');
          $('.item-d').css('background-image', 'url(' + currentBackdrop + ')');
          $('.carousel-details h2').html($('.carousel-item.active').attr('data-title'));
          $('.carousel-details p').html($('.carousel-item.active').attr('data-overview'));
        }
      });
    }, errorCB);
  }

  function displayMovies() {
    let filterOptions = getFilterOptions();
    $('.watch-grid').empty();
    theMovieDb.discover.getMovies(filterOptions, (jsondata) => {
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

  theMovieDb.genres.getMovieList({}, (jsondata) => {
    let data  = JSON.parse(jsondata);
    console.log(data);

  }, errorCB);








});
