$(document).ready(function() {

  function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
  }


  if (getUrlVars()['m']) {
    let id = getUrlVars()['m'].replace( /(\d+)(\D*)/i,'$1');
    displayMovieData(id);
  }

  function updateTabs() {
    $('.watch-options').removeClass('active').css('display', 'none');
    $('#stream.watch-options').addClass('active').css('display', 'grid');
    $('.indicator').css('left', '25%').css('right', '50%');
    $('tabs').select('tab_id');
  }

  $('.materialboxed').materialbox();
  $('.modal').modal({onCloseStart: stopVideo, onOpenStart: updateTabs});
  $('.tabs').tabs();


  function displayMovieData(id) {
    theMovieDb.movies.getById({"id":id}, (jsondata) => {
      let movieData = JSON.parse(jsondata);
      console.log(movieData);

      let genresArray = [];
      movieData.genres.forEach(function(e) {
        let link = `<a href="/movies/staging/genres/?g=${e.id}-${e.name}">${e.name}</a>`;
        genresArray.push(link);
      });

      let genres = genresArray.join(', ');

      let releaseFull = new Date(movieData.release_date);
      let releaseYear = releaseFull.getFullYear();
      let torrentLink = 'https://1337x.to/movie/' + id + '/' + encodeURI(movieData.title).replace(/\%20/g, '-') + '-' + releaseYear + '/';

      $('#display-backdrop').css('background-image', 'url(' + theMovieDb.common.images_uri + 'w1280' + movieData.backdrop_path + ')');
      $('.display-title').html(movieData.title);
      $('#display-poster').attr('src', theMovieDb.common.images_uri + 'w370_and_h556_bestv2' + movieData.poster_path);
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

      displayServicesLinks(movieData.imdb_id, movieData.title);

    }, errorCB);

    theMovieDb.movies.getVideos({"id":id}, (jsondata) => {
      let trailerData = JSON.parse(jsondata);
      let trailerURL = trailerData.results[0].key;
      $('#watch-trailer-iframe').attr('src', 'https://www.youtube-nocookie.com/embed/'  + trailerURL + '?rel=0&amp;showinfo=0');
    }, errorCB);

    theMovieDb.movies.getImages({"id":id}, (jsondata) => {
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

    displaySimilarMovies(id);



  }

  function stopVideo() {
    let videoPlayerSource=$('#watch-trailer-iframe').attr("src");
    $('#watch-trailer-iframe').attr("src", videoPlayerSource);
  }

  function displayServicesLinks(id, title) {
    let request = $.ajax({
      url:'services.php',
      type:'POST',
      data: 'id=' + id + '&title=' + title
    });
    request.done(function (jsonResponse){
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
        $('.services-preloader').css('display', 'none');
      } else {
        $('.sevices-preloader').css('display', 'none');
      }
    });
  }

  // function displayZiggoGoLink(title) {
  //   let request = $.ajax({
  //     url:'ziggogo.php',
  //     type:'POST',
  //     data: 'id=' + id
  //   });
  //   request.done(function (response, textStatus, jqXHR){
  //     if (response) {
  //       $('#display-ziggogo-link').attr('href', response);
  //       $('#display-ziggogo-link').css('display', 'grid');
  //     } else {
  //       $('#display-ziggogo-link').css('display', 'none');
  //     }
  //   });
  // }
  //
  // function displayNetflixLink(title, year) {
  //   let request = $.ajax({
  //     url:'netflix.php',
  //     type:'POST',
  //     data: 'title=' + title + '&year=' + year
  //   });
  //   request.done(function (jsonResponse){
  //     let response = JSON.parse(jsonResponse);
  //     if (response) {
  //       $('#display-netflix-link').attr('href', response.url);
  //       $('.netflix-preloader').css('display', 'none');
  //       $('#display-netflix-link').css('display', 'grid');
  //     } else {
  //       $('.netflix-preloader').css('display', 'none');
  //       $('#display-netflix-link').css('display', 'none');
  //     }
  //   });
  // }



});
