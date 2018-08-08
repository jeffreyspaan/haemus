
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
    <link rel="stylesheet" href="../base.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="discover">
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
            <li><a href="/movies/staging/discover"><i class="large material-icons">explore</i><span>Discover</span></a></li>
            <li><a href="/movies/staging/trending"><i class="large material-icons">trending_up</i><span>Trending</span></a></li>
            <li><a href="/movies/staging/genres"  class="active"><i class="large material-icons">face</i><span>Genres</span></a></li>
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
      <div class="item item-d">

      </div>
      <div class="item item-e">
      </div>
      <div class="item item-f">
      </div>
      <div class="item item-g">
      </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <!-- The Movie Database js-->
    <script src="/assets/js/themoviedb.js"></script>
    <script src="https://cdn.jsdelivr.net/webtorrent/latest/webtorrent.min.js"></script>
    <script src="/movies/staging/base.js"></script>
    <script src="torrent.js"></script>
  </body>
</html>
