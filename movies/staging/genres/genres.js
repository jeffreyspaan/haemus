$(document).ready(function() {

  let page = 1;

  let genres = [
    {id: '28', name: 'Action', backdropURL: 'https://image.tmdb.org/t/p/w1280/qbA5CtRVBWdJ1XMsbC21pyx0ZvT.jpg'},
    {id: '12', name: 'Adventure', backdropURL: 'https://image.tmdb.org/t/p/w1280/dG4BmM32XJmKiwopLDQmvXEhuHB.jpg'},
    {id: '16', name: 'Animation', backdropURL: 'https://image.tmdb.org/t/p/w1280/2nFyTvssbtJMLC6eyYwwZ88gALD.jpg'},
    {id: '35', name: 'Comedy', backdropURL: 'https://image.tmdb.org/t/p/w1280/8dNVYmtDwUc3ku3Oxd1x418KVZL.jpg'},
    {id: '80', name: 'Crime', backdropURL: 'https://image.tmdb.org/t/p/w1280/hqkIcbrOHL86UncnHIsHVcVmzue.jpg'},
    {id: '99', name: 'Documentary', backdropURL: 'https://image.tmdb.org/t/p/w1280/SyOsjZeELaeaQTtmDXtoqDdJSp.jpg'},
    {id: '18', name: 'Drama', backdropURL: 'https://image.tmdb.org/t/p/w1280/2Zvd5gKOSvUGJpWtmpsFQvfPd2z.jpg'},
    {id: '10751', name: 'Family', backdropURL: 'https://image.tmdb.org/t/p/w1280/3EZbjPoeQ55lNGVTAuwteSNbgZZ.jpg'},
    {id: '14', name: 'Fantasy', backdropURL: 'https://image.tmdb.org/t/p/w1280/gGt4ePOhD8ilxd3FYhKB06L2CyG.jpg'},
    {id: '36', name: 'History', backdropURL: 'https://image.tmdb.org/t/p/w1280/6prkTmEEsB3f9hhKBzUePLe27b2.jpg'},
    {id: '27', name: 'Horror', backdropURL: 'https://image.tmdb.org/t/p/w1280/lPhsKTtycmbp6bzJAG662Pd5U3N.jpg'},
    {id: '10402', name: 'Music', backdropURL: 'https://image.tmdb.org/t/p/w1280/6aUWe0GSl69wMTSWWexsorMIvwU.jpg'},
    {id: '9648', name: 'Mystery', backdropURL: 'https://image.tmdb.org/t/p/original/s2bT29y0ngXxxu2IA8AOzzXTRhd.jpg'},
    {id: '10749', name: 'Romance', backdropURL: 'https://image.tmdb.org/t/p/w1280/f6jSPjlPD5HJ92VVxIBNfIxL6IP.jpg'},
    {id: '878', name: 'Science Fiction', backdropURL: 'https://image.tmdb.org/t/p/w1280/bHarw8xrmQeqf3t8HpuMY7zoK4x.jpg'},
    {id: '53', name: 'Thriller', backdropURL: 'https://image.tmdb.org/t/p/w1280/aWP4FL9dNzPzGhFP5T9pKJCMCHc.jpg'},
    {id: '10752', name: 'War', backdropURL: 'https://image.tmdb.org/t/p/original/zBK4QZONMQXhcgaJv1YYTdCW7q9.jpg'}, //center
    {id: '37', name: 'Western', backdropURL: 'https://image.tmdb.org/t/p/w1280/sgcgfrlOOB6lVXbfl75YTszF4jI.jpg'}
  ];

  console.log(genres);

  if (getUrlVars()['g']) {
    let id = getUrlVars()['g'].replace( /(\d+)(.*)/i,'$1');
    displayHero(id);
    displayMoviesByGenre(id);
  } else {
    displayGenres();
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
    genres.forEach(function(e) {
      console.log(`<li><a href="/movies/staging/genres/?g=${e.id}-${e.name}" class="genre-${e.name}"><span>${e.name}</span></a></li>`);
      if (e.id == id) {
        $('#display-backdrop').css('background-image', 'url(' + e.backdropURL + ')');
        $('#display-genre-name').html(e.name);
        console.log(`.genre-${e.name}`);
        $(`.genre-${e.name}`).addClass('active');
        if (e.id == 10752) {
          $('#display-backdrop').css('background-position', 'center');
        }
      }
    });

  }

  function displayMoviesByGenre(id) {
    $('.watch-grid').empty();
    theMovieDb.genres.getMovies({"id": id}, (jsondata) => {
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

  function displayGenres() {
    $('#display-genre-name').html('Genres');
    $('#display-backdrop').css('background-image', 'url(' + genres[14].backdropURL + ')');
    $('.pagination').css('display', 'none');
    genres.forEach(function(e) {
      let element = `<div class="genre-item"><a href="/movies/staging/genres/?g=${e.id}-${e.name}" class="genre-link z-depth-2" style="background-image:url(${e.backdropURL})"><h3>${e.name}</h3></a></div>`;
      $('.watch-grid').append(element);
    });
    $('.watch-grid').animate({opacity: "1"}, 500);
  }






});
