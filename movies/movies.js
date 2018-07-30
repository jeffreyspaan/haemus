$(document).ready(function() {

  $('.side-nav').sidenav();

  function errorCB(data) {
    console.log(data);
    return;
  };

  $('.new-movie-button').on('click', function(e) {
    $('section.new-movie').addClass('show');
  });

  $('.close-new-movie-button').on('click', function(e) {
    $('section.new-movie').removeClass('show');
  });

  $("#display").click(displayMovies);

  $( ".search-form" ).on( "submit", searchMoviesLocal);
  $( ".search-form" ).keyup(searchMoviesLocal);

  let sortType = 'added';
  let sortOrder = 'descending';

  displayMovies();

  function displayMovies(ids = '') {
    $.ajax({
      type: "GET",
      url: `/movies/display.php?sort_colum=${sortType}&sort_order=${sortOrder}${ids}`,
      dataType: "html",
      success: function(response){
        $(".response-container").html(response);
        $('section.new-movie').removeClass('show');
      }
    });
  }

  function searchMoviesLocal (event) {
    event.preventDefault();

    $.ajax({
      url:'/movies/search.php',
      type:'get',
      data:$( this ).serialize(),
      success:function(response){

        var responseObject = JSON.parse(response);

        if (responseObject.error == 1) {
          $(".response-container").html(responseObject.errortext);
        } else if (responseObject.error == 2) {
          displayMovies();
        } else {
          displayMovies(responseObject.ids);
        }

      }
    });
  }

  $( "#new-movie-form" ).on( "submit", function( event ) {
    event.preventDefault();

    $.ajax({
      url:'/movies/newmovie.php',
      type:'post',
      data:$( this ).serialize(),
      success:function(response){
          console.log(response);
          displayMovies();
      }
    });

  });

  $('#new-movie-title').keyup(searchMoviesTMDB);
  $('#new-movie-title').keyup(searchMoviesTMDB);

  function onAutocomplete() {
    let query = encodeURI($('#new-movie-title').val());
    getMovieInfoAndFillForm(query)
  }

  function searchMoviesTMDB() {
    let query = encodeURI($('#new-movie-title').val());
    theMovieDb.search.getMovie({"query":query}, (jsondata) => {
      let movieData = JSON.parse(jsondata);

      let titles = {};

      for (var i = 0; i < 6; i++) {
        let title = movieData.results[i].title;
        titles[title] = null;
      }

      $('input.autocomplete').autocomplete({
        data: titles, onAutocomplete
      });

      var instance = M.Autocomplete.getInstance($('input.autocomplete'));
      instance.open();

    }, errorCB);
  }

  // getMovieInfoAndFillForm(49521);

  function getMovieInfoAndFillForm(name) {
    theMovieDb.search.getMovie({"query":name }, (jsondata) => {
      let searchData = JSON.parse(jsondata).results[0];
      let tmdbId = searchData.id;
      theMovieDb.movies.getById({"id":tmdbId }, (jsondata) => {

        let movieData = JSON.parse(jsondata);
        console.log(movieData);

        // title
        let title = movieData.title;
        if (title == undefined) {
          title = movieData.name;
        }

        //date - only year
        let date = movieData.release_date;
        if (date == undefined) {
          date = movieData.last_air_date;
        }
        year = date.substr(0,date.indexOf('-'));

        // poster url
        let posterURL = theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + movieData.poster_path;

        // backdrop url
        let backdropURL = theMovieDb.common.images_uri + 'w1280' + movieData.backdrop_path;

        // tagline
        let tagline = movieData.tagline;

        //excerpt
        let excerpt = movieData.overview;

        let titleElement = $('#new-movie-title');
        let titleLabelElement = $('.new-movie-title-label');
        let yearElement = $('.new-movie-year');
        let posterURLElement = $('.new-movie-poster-url');
        // let posterURLLabelElement = $('.new-movie-poster-url-label');
        let backdropURLElement = $('.new-movie-backdrop-url');
        // let backdropURLLabelElement = $('.new-movie-backdrop-url-label');
        let taglineElement = $('.new-movie-tagline');
        let taglineLabelElement = $('.new-movie-tagline-label');
        let excerptElement = $('.new-movie-excerpt');
        let excerptLabelElement = $('.new-movie-excerpt-label');

        titleElement.val(title);
        titleLabelElement.addClass('active');
        yearElement.val(year);
        posterURLElement.val(posterURL);
        // posterURLLabelElement.addClass('active');
        backdropURLElement.val(backdropURL);
        // backdropURLLabelElement.addClass('active');
        taglineElement.val(tagline);
        taglineLabelElement.addClass('active');
        excerptElement.val(excerpt);
        excerptLabelElement.addClass('active');
        M.textareaAutoResize(excerptElement);

      }, errorCB);
    }, errorCB);
  };



  // theMovieDb.movies.getById({"id":76203 }, (jsondata) => {console.log(JSON.parse(jsondata))}, errorCB)


});
