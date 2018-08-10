<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">

    </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/base.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="movie">
    <div class="grid-wrap">
      <div class="item item-a">
        <a href="#" class="logo-wrapper">
          <!-- <i class="material-icons">play_circle_filled</i> -->
          <img src="/assets/images/movies/logo-transparent.png" alt="">
          <span class="title">MMDB</span>
        </a>
      </div>
      <div class="item item-b">
        <div class="menu">
          <h3>Browse</h3>
          <ul>
            <li><a href="/discover" class="active"><i class="large material-icons">explore</i><span>Discover</span></a></li>
            <li><a href="/trending"><i class="large material-icons">trending_up</i><span>Trending</span></a></li>
            <li><a href="/genres"><i class="large material-icons">face</i><span>Genres</span></a></li>
            <li><a href="#"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
          </ul>
          <h3>My movies</h3>
          <ul>
            <li><a href="#"><i class="large material-icons">movie</i><span>All movies</span></a></li>
            <li><a href="#"><i class="large material-icons">format_list_bulleted</i><span>Watchlist</span></a></li>
            <li><a href="#"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
          </ul>
          <a class="genres-list-trigger">
            <h3>Genres</h3>
              <i class="small material-icons">arrow_drop_down</i>
          </a>
          <ul class="genres-list">
            <li><a href="/genres/?g=28-Action" class="genre-Action"><span>Action</span></a></li>
            <li><a href="/genres/?g=12-Adventure" class="genre-Adventure"><span>Adventure</span></a></li>
            <li><a href="/genres/?g=16-Animation" class="genre-Animation"><span>Animation</span></a></li>
            <li><a href="/genres/?g=35-Comedy" class="genre-Comedy"><span>Comedy</span></a></li>
            <li><a href="/genres/?g=80-Crime" class="genre-Crime"><span>Crime</span></a></li>
            <li><a href="/genres/?g=99-Documentary" class="genre-Documentary"><span>Documentary</span></a></li>
            <li><a href="/genres/?g=18-Drama" class="genre-Drama"><span>Drama</span></a></li>
            <li><a href="/genres/?g=10751-Family" class="genre-Family"><span>Family</span></a></li>
            <li><a href="/genres/?g=14-Fantasy" class="genre-Fantasy"><span>Fantasy</span></a></li>
            <li><a href="/genres/?g=36-History" class="genre-History"><span>History</span></a></li>
            <li><a href="/genres/?g=27-Horror" class="genre-Horror"><span>Horror</span></a></li>
            <li><a href="/genres/?g=10402-Music" class="genre-Music"><span>Music</span></a></li>
            <li><a href="/genres/?g=9648-Mystery" class="genre-Mystery"><span>Mystery</span></a></li>
            <li><a href="/genres/?g=10749-Romance" class="genre-Romance"><span>Romance</span></a></li>
            <li><a href="/genres/?g=878-Science Fiction" class="genre-Science Fiction"><span>Science Fiction</span></a></li>
            <li><a href="/genres/?g=53-Thriller" class="genre-Thriller"><span>Thriller</span></a></li>
            <li><a href="/genres/?g=10752-War" class="genre-War"><span>War</span></a></li>
            <li><a href="/genres/?g=37-Western" class="genre-Western"><span>Western</span></a></li>
          </ul>
        </div>
      </div>
      <div class="item item-c">
        <div class="item item-ca">
          <form class="search-form" autocomplete="off">
            <div class="input-field">
              <input id="search-movie" type="text" placeholder="Insterstellar, Man Of Steel, ..." class="autocomplete" name="title">
              <i class="material-icons prefix">search</i>
            </div>
          </form>
        </div>
        <div class="item item-cb">
        </div>
        <div class="item item-cc">
          <a href="#!" class="mobile-menu-trigger">
            <i class="material-icons z-depth-4">menu</i>
          </a>
        </div>
      </div>
      <div id="display-backdrop" class="item item-d">
        <div class="page-title">
          <h2>Movie</h2>
        </div>
        <div class="overlay"></div>
        <div class="details">
          <h1 class="display-title"></h1>
          <div>
            <a href="#" class="button single favorite">
              <i class="material-icons">favorite</i>
            </a>
            <a href="#" class="button my-movie">
              <i class="material-icons">movie</i>
              <span>Add my movies</span>
            </a>
            <a href="#" class="button watchlist">
              <i class="material-icons">playlist_add</i>
              <span>Add watchlist</span>
            </a>
            <a href="#" class="button modal-trigger watch-trailer" data-target="watch-trailer">
              <i class="material-icons">play_arrow</i>
              <span>Watch trailer</span>
            </a>
          </div>
        </div>
        <div class="watch-button">
          <a href="#" data-target="watch-movie" class="modal-trigger" id="watch-button">
            <i class="material-icons large pulse">play_circle_filled</i>
          </a>
        </div>
      </div>
      <div class="item item-e">
        <div class="item item-ea z-depth-3">
          <img id="display-poster" class="materialboxed" src="">
        </div>
        <div class="item item-eb">
          <h2>Overview</h2>
          <p id="display-overview"></p>
        </div>
        <div class="item item-ec z-depth-3">
          <h2>Information</h2>
          <div class="information-grid">
            <div class="item">Runtime</div>
            <div class="item" id="display-runtime"></div>
            <div class="item">Release date</div>
            <div class="item" id="display-release"></div>
            <div class="item">Genre</div>
            <div class="item" id="display-genres">Actie, Avontuur</div>
            <div class="item">Tagline</div>
            <div class="item" id="display-tagline"></div>
            <div class="item">TMDB Rating</div>
            <div class="item" id="display-tmdb-rating"></div>
          </div>
        </div>
      </div>
      <div class="item item-f">
        <h2>Pictures</h2>
        <div class="pictures-grid z-depth-3">
          <div class="item item-ha">
            <img id="display-picture-1" class="materialboxed" src="" alt="">
          </div>
          <div class="item item-hb">
            <img id="display-picture-2" class="materialboxed" src="" alt="">
          </div>
          <div class="item item-hc">
            <img id="display-picture-3" class="materialboxed" src="" alt="">
          </div>
        </div>
      </div>
      <div class="item item-g">
      </div>
      <div class="item item-h">
        <h2>Similar Movies</h2>
        <div class="watch-grid">
        </div>
      </div>
      <div class="item item-i">

      </div>
      <div class="item item-j">
        <a href="#"><h6 style="margin:0;">About</h6></a>
      </div>
    </div>
    <div id="watch-movie" class="modal">
      <div class="modal-content">
        <h2>Watch movie</h2>
        <p>Download, rent or stream <span class="display-title">your movie</span> from multiple video services.</p>
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s12 m3"><a href="#torrent">Torrent</a></li>
              <li class="tab col s12 m3"><a class="active" href="#stream">Stream</a></li>
              <li class="tab col s12 m3"><a href="#rent">Buy / rent</a></li>
              <li class="tab col s12 m3"><a href="#cinema">Cinema</a></li>
            </ul>
          </div>
          <div id="torrent" class="col s12 watch-options">
            <a class="service" href="#" target="_blank" id="display-torrent-link">
              <img src="/assets/images/movies/watch-1337x.png" alt="">
              <h6>1337X</h6>
            </a>
          </div>
          <div id="stream" class="col s12 watch-options">
            <div class="preloader-wrapper small active services-preloader">
              <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
            <a class="service" href="#" target="_blank" id="display-movieonline-link">
              <img src="/assets/images/movies/watch-movieonline.png" alt="">
              <h6>Movieonline</h6>
              <span>(search)</span>
            </a>
            <a class="service" href="#" target="_blank" id="display-fmovies-link">
              <img src="/assets/images/movies/watch-fmovies.png" alt="">
              <h6>Fmovies</h6>
              <span>(search)</span>
            </a>
            <a class="service" href="#" target="_blank" id="display-gomovies2-link">
              <img src="/assets/images/movies/watch-gomovies2.png" alt="">
              <h6>Gomovies 2.0</h6>
              <span>(search)</span>
            </a>
            <a class="service" href="#" target="_blank" id="display-gomovies-link">
              <img src="/assets/images/movies/watch-gomovies.png" alt="">
              <h6>Gomovies</h6>
              <span>(search)</span>
            </a>
          </div>
          <div class="col s12 watch-options" id="rent">
            <div class="preloader-wrapper small active services-preloader">
              <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 watch-options" id="cinema">
            <div class="preloader-wrapper small active services-preloader">
              <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="watch-trailer" class="modal">
      <div class="modal-content">
        <iframe id="watch-trailer-iframe" width="560" height="315" src frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    </div>
    <div class="mobile-menu-cover mobile-menu-trigger"></div>
    <script src="/assets/js/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <!-- The Movie Database js-->
    <script src="/assets/js/themoviedb.js"></script>
    <script src="/base.js"></script>
    <script src="single-movie.js"></script>
  </body>
</html>
