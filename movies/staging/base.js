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


function errorCB(data) {
  console.log(data);
  return;
};
