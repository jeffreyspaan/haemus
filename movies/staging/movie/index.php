<?php
function breadcrumbs() {
  if($location = substr(dirname($_SERVER['PHP_SELF']), 1))
  	$dirlist = explode('/', $location);
  else
  	$dirlist = array();

  $count = array_push($dirlist, basename($_SERVER['PHP_SELF']));

  $address = 'http://'.$_SERVER['HTTP_HOST'];

  echo '<a href="'.$address.'">Home</a>';

  for($i = 0; $i < $count -1; $i++)
  	echo '&nbsp;&raquo;&nbsp;<a href="'.($address .= '/'.$dirlist[$i]).'">'.$dirlist[$i].'</a>';
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">

    </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../base.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="movie">
    <div class="grid-wrap">
      <div class="item item-a">
        <a href="#" class="title-wrapper">
          <i class="material-icons">play_circle_filled</i>
          <span class="title">Haemus</span>
        </a>
      </div>
      <div class="item item-b">
        <div class="menu">
          <h3>Browse</h3>
          <ul>
            <li><a href="/movies/staging/discover" class="active"><i class="large material-icons">explore</i><span>Discover</span></a></li>
            <li><a href="/movies/staging/trending"><i class="large material-icons">trending_up</i><span>Trending</span></a></li>
            <li><a href="/movies/staging/genres"><i class="large material-icons">face</i><span>Genres</span></a></li>
            <li><a href="#"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
          </ul>
          <h3>My movies</h3>
          <ul>
            <li><a href="#"><i class="large material-icons">movie</i><span>All movies</span></a></li>
            <li><a href="#"><i class="large material-icons">format_list_bulleted</i><span>Watchlist</span></a></li>
            <li><a href="#"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
          </ul>
          <h3>Genres</h3>
          <ul class="genres-list">
            <li><a href="/movies/staging/genres/?g=28-Action" class="genre-Action"><span>Action</span></a></li>
            <li><a href="/movies/staging/genres/?g=12-Adventure" class="genre-Adventure"><span>Adventure</span></a></li>
            <li><a href="/movies/staging/genres/?g=16-Animation" class="genre-Animation"><span>Animation</span></a></li>
            <li><a href="/movies/staging/genres/?g=35-Comedy" class="genre-Comedy"><span>Comedy</span></a></li>
            <li><a href="/movies/staging/genres/?g=80-Crime" class="genre-Crime"><span>Crime</span></a></li>
            <li><a href="/movies/staging/genres/?g=99-Documentary" class="genre-Documentary"><span>Documentary</span></a></li>
            <li><a href="/movies/staging/genres/?g=18-Drama" class="genre-Drama"><span>Drama</span></a></li>
            <li><a href="/movies/staging/genres/?g=10751-Family" class="genre-Family"><span>Family</span></a></li>
            <li><a href="/movies/staging/genres/?g=14-Fantasy" class="genre-Fantasy"><span>Fantasy</span></a></li>
            <li><a href="/movies/staging/genres/?g=36-History" class="genre-History"><span>History</span></a></li>
            <li><a href="/movies/staging/genres/?g=27-Horror" class="genre-Horror"><span>Horror</span></a></li>
            <li><a href="/movies/staging/genres/?g=10402-Music" class="genre-Music"><span>Music</span></a></li>
            <li><a href="/movies/staging/genres/?g=9648-Mystery" class="genre-Mystery"><span>Mystery</span></a></li>
            <li><a href="/movies/staging/genres/?g=10749-Romance" class="genre-Romance"><span>Romance</span></a></li>
            <li><a href="/movies/staging/genres/?g=878-Science Fiction" class="genre-Science Fiction"><span>Science Fiction</span></a></li>
            <li><a href="/movies/staging/genres/?g=53-Thriller" class="genre-Thriller"><span>Thriller</span></a></li>
            <li><a href="/movies/staging/genres/?g=10752-War" class="genre-War"><span>War</span></a></li>
            <li><a href="/movies/staging/genres/?g=37-Western" class="genre-Western"><span>Western</span></a></li>
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
          <a href="#new-movie" class="modal-trigger">
            <i class="material-icons z-depth-4">add</i>
          </a>
        </div>
      </div>
      <div id="display-backdrop" class="item item-d">
        <div class="page-title">
          <h2>Movie</h2>
        </div>
        <div class="overlay"></div>
        <div class="details">
          <h1 id="display-title"></h1>
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
            <?= breadcrumbs() ?>
          </div>
        </div>
        <div class="trailer-button">
          <a href="#" data-target="watch-trailer" class="modal-trigger" id="display-trailer">
            <i class="material-icons large">play_circle_filled</i>
            <span>Watch Trailer</span>
          </a>
        </div>
      </div>
      <div class="item item-e">
        <div class="item item-ea">
          <img id="display-poster" class="materialboxed" src="">
        </div>
        <div class="item item-eb">
          <h2>Overview</h2>
          <p id="display-overview"></p>
        </div>
        <div class="item item-ec">
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
        <div class="pictures-grid">
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
        <!-- <iframe width="1000" height="550" src="https://www.youtube.com/embed?listType=search&list=death+wish+trailer" frameborder="0" allow="encrypted-media" allowfullscreen></iframe> -->
      </div>
      <div class="item item-h">
        <h2>Watch</h2>
        <div class="watch-grid">
          <div class="item item-fa">
            <a id="display-torrent-link" href="#">
              <img src="/assets/images/movies/watch-torrent.jpg" alt="">
            </a>
            <div>
              <h2>1337X</h2>
              <a href="#">1337x.to</a>
            </div>
          </div>
          <div class="item item-fb">
            <a id="display-movieonline-link" href="#">
              <img src="/assets/images/movies/watch-movieonline.jpg" alt="">
            </a>
            <div>
              <h2>Movie Online</h2>
              <a href="https://www3.movieonline.tv/">www3.movieonline.tv</a>
            </div>
          </div>
          <div class="item item-fc">
            <a id="display-gomovies2-link" href="#">
              <img src="/assets/images/movies/watch-gomovieshub-se.jpg" alt="">
            </a>
            <div>
              <h2>Gomovies 2.0</h2>
              <a href="https://www.gomovieshub.se/">www.gomovieshub.se</a>
            </div>
          </div>
          <div class="item item-fd">
            <a id="display-gomovies-link" href="#">
              <img src="/assets/images/movies/watch-gomovies-vc.jpg" alt="">
            </a>
            <div>
              <h2>Gomovies</h2>
              <a href="http://www1.gomovies.vc/">www1.gomovies.vc</a>
            </div>
          </div>
          <div class="item item-fe">
            <a id="display-fmovies-link" href="#">
              <img src="/assets/images/movies/watch-fmovies.jpg" alt="">
            </a>
            <div>
              <h2>Fmovies</h2>
              <a href="https://www7.fmovies.se/">www7.fmovies.se</a>
            </div>
          </div>
        </div>
      </div>
      <div class="item item-i">

      </div>
      <div class="item item-j">
        <a href="#"><h6 style="margin:0;">About</h6></a>
      </div>
    </div>
    <div id="watch-trailer" class="modal">
      <div class="modal-content">
        <iframe id="watch-trailer-iframe" width="560" height="315" src frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <!-- The Movie Database js-->
    <script src="/assets/js/themoviedb.js"></script>
    <script src="/movies/staging/base.js"></script>
    <script src="single-movie.js"></script>
  </body>
</html>
