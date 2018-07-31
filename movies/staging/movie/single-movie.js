$(document).ready(function() {

  function errorCB(data) {
    console.log(data);
    return;
  };

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
    console.log(id);
    displayMovieData(id);
  }

  $('.materialboxed').materialbox();
  $('.modal').modal({onCloseStart: stopVideo});

  function displayMovieData(id) {
    theMovieDb.movies.getById({"id":id}, (jsondata) => {
      let movieData = JSON.parse(jsondata);

      let genresArray = [];
      movieData.genres.forEach(function(e) {
        let link = `<a href="/movies/staging/genres/?g=${e.id}-${e.name}">${e.name}</a>`;
        genresArray.push(link);
      });

      let genres = genresArray.join(', ');

      let releaseFull = new Date(movieData.release_date);
      let releaseYear = releaseFull.getFullYear();
      let torrentLink = 'https://1337x.to/movie/' + id + '/' + encodeURI(movieData.title).replace(/\%20/g, '-') + '-' + releaseYear + '/';
      console.log(torrentLink);

      $('#display-backdrop').css('background-image', 'url(' + theMovieDb.common.images_uri + 'w1280' + movieData.backdrop_path + ')');
      $('#display-title').html(movieData.title);
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

    }, errorCB);

    theMovieDb.movies.getVideos({"id":id}, (jsondata) => {
      let trailerData = JSON.parse(jsondata);
      let trailerURL = trailerData.results[0].key;
      console.log('https://www.youtube.com/watch?v='  + trailerURL);
      $('#watch-trailer-iframe').attr('src', 'https://www.youtube-nocookie.com/embed/'  + trailerURL + '?rel=0&amp;showinfo=0');
    }, errorCB);

    theMovieDb.movies.getImages({"id":id}, (jsondata) => {
      let imagesData = JSON.parse(jsondata);
      let pictureOneSource = theMovieDb.common.images_uri + 'w1280' + imagesData.backdrops[1].file_path;
      let pictureTwoSource = theMovieDb.common.images_uri + 'w1280' + imagesData.backdrops[2].file_path;
      let pictureThreeSource = theMovieDb.common.images_uri + 'w1280' + imagesData.backdrops[3].file_path;
      $('#display-picture-1').attr('src', pictureOneSource);
      $('#display-picture-2').attr('src', pictureTwoSource);
      $('#display-picture-3').attr('src', pictureThreeSource);
    }, errorCB);

    theMovieDb.movies.getLists({"id":id }, (jsondata) => {
      let data = JSON.parse(jsondata);
      console.log(data);
    }, errorCB)

  }

  function stopVideo() {
    console.log('clicked');
    let videoPlayerSource=$('#watch-trailer-iframe').attr("src");
    $('#watch-trailer-iframe').attr("src", videoPlayerSource);
  }



});
