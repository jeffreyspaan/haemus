function getFilterOptions() {
    return {'id': collectionId};
}

let page = 1;
let collectionId; //1241

$(document).ready(function () {

    if (getUrlVars()['c']) {
        collectionId = getUrlVars()['c'].replace(/(\d+)(.*)/i, '$1');
        displayHero(collectionId);
        displayMoviesByCollection();
    } else {
        console.log('No movies');
    }

    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function displayHero(id) {
        // genres.forEach(function(e) {
        //   if (e.id == id) {
        //     $('#display-backdrop').css('background-image', 'url(' + e.backdropURL + ')');
        //     $('#display-genre-name').html(e.name);
        //     $(`.genre-${e.name}`).addClass('active'); // set menu item for genre to active
        //     console.log(e.name);
        //     if (e.id == 10752) {
        //       $('#display-backdrop').css('background-position', 'center');
        //     }
        //   }
        // });

    }


});
