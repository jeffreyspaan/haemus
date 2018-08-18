function getFilterOptions() {
    return {'page': page, 'id': genreId};
}

let page = 1;
let genreId;

$(document).ready(function () {

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
        {
            id: '9648',
            name: 'Mystery',
            backdropURL: 'https://image.tmdb.org/t/p/original/s2bT29y0ngXxxu2IA8AOzzXTRhd.jpg'
        },
        {id: '10749', name: 'Romance', backdropURL: 'https://image.tmdb.org/t/p/w1280/f6jSPjlPD5HJ92VVxIBNfIxL6IP.jpg'},
        {
            id: '878',
            name: 'Science-Fiction',
            backdropURL: 'https://image.tmdb.org/t/p/w1280/bHarw8xrmQeqf3t8HpuMY7zoK4x.jpg'
        },
        {id: '53', name: 'Thriller', backdropURL: 'https://image.tmdb.org/t/p/w1280/aWP4FL9dNzPzGhFP5T9pKJCMCHc.jpg'},
        {id: '10752', name: 'War', backdropURL: 'https://image.tmdb.org/t/p/original/zBK4QZONMQXhcgaJv1YYTdCW7q9.jpg'}, //center
        {id: '37', name: 'Western', backdropURL: 'https://image.tmdb.org/t/p/w1280/sgcgfrlOOB6lVXbfl75YTszF4jI.jpg'}
    ];

    if (getUrlVars()['g']) {
        genreId = getUrlVars()['g'].replace(/(\d+)(.*)/i, '$1');
        displayHero(genreId);
        displayMoviesByGenre();
    } else {
        displayGenres();
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
        genres.forEach(function (e) {
            if (e.id == id) {
                $('#display-backdrop').css('background-image', 'url(' + e.backdropURL + ')');
                $('#display-genre-name').html(e.name);
                $(`.genre-${e.name}`).addClass('active'); // set menu item for genre to active
                console.log(e.name);
                if (e.id == 10752) {
                    $('#display-backdrop').css('background-position', 'center');
                }
            }
        });

    }


    function displayGenres() {
        $('#display-genre-name').html('Genres');
        $('#display-backdrop').css('background-image', 'url(' + genres[14].backdropURL + ')');
        $('.pagination').css('display', 'none');
        genres.forEach(function (e) {
            let element = `<div class="genre-item"><a href="/genres/?g=${e.id}-${e.name}" class="genre-link z-depth-2" style="background-image:url(${e.backdropURL})"><h3>${e.name}</h3></a></div>`;
            $('.watch-grid').append(element);
        });
        $('.watch-grid').animate({opacity: "1"}, 500);
    }


});
