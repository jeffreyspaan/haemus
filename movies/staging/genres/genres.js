$(document).ready(function() {

  let page = 1;

  let backdrops = {28: ['action', ''], 23: 'test'};

  if (getUrlVars()['g']) {
    let id = getUrlVars()['g'].replace( /(\d+)(\D*)/i,'$1');
    displayHero(id);
    displayMoviesByGenre(id);
  }

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

  function displayHero(id) {
    // if () {
    //
    // }
  }

  function displayMoviesByGenre(id) {
    $('.watch-grid').empty();
    theMovieDb.genres.getMovies({"id": id}, (jsondata) => {
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



});
