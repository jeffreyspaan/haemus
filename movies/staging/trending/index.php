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
            <li><a href="/movies/staging/trending"  class="active"><i class="large material-icons">trending_up</i><span>Trending</span></a></li>
            <li><a href="/movies/staging/genres"><i class="large material-icons">face</i><span>Genres</span></a></li>
            <li><a href="#"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
          </ul>
          <h3>My movies</h3>
          <ul>
            <li><a href="#"><i class="large material-icons">movie</i><span>All movies</span></a></li>
            <li><a href="#"><i class="large material-icons">format_list_bulleted</i><span>Watchlist</span></a></li>
            <li><a href="#"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
          </ul>
          <h3>My genres</h3>
          <ul>
            <li><a href="#"><span>Action</span></a></li>
            <li><a href="#"><span>Thriller</span></a></li>
            <li><a href="#"><span>Adventure</span></a></li>
            <li><a href="#"><span>Mystery</span></a></li>
            <li><a href="#"><span>Humor</span></a></li>
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
        <h2>Trending movies</h2>
        <div class="watch-grid">
        </div>
      </div>
      <div class="item item-e">
        <ul class="pagination">
          <li class="change-page active"><a href="#!">1</a></li>
          <li class="change-page"><a href="#!">2</a></li>
          <li class="change-page"><a href="#!">3</a></li>
          <li class="change-page"><a href="#!">4</a></li>
          <li class="change-page"><a href="#!">5</a></li>
        </ul>
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
    <script src="/movies/staging/base.js"></script>
    <script src="trending.js"></script>
  </body>
</html>
