<?php
require_once dirname(__FILE__) . '/../header.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">

    </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/base.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="discover">
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
                <li><a href="/discover" class="active"><i class="material-icons">explore</i><span>Discover</span></a>
                </li>
                <li><a href="/trending"><i class="material-icons">trending_up</i><span>Trending</span></a></li>
                <li><a href="/genres"><i class="material-icons">face</i><span>Genres</span></a></li>
                <li><a href="#"><i class="material-icons">favorite</i><span>Favorites</span></a></li>
            </ul>
            <h3>My movies</h3>
            <ul>
                <li><a href="#"><i class="large material-icons">movie</i><span>All movies</span></a></li>
                <li><a href="/watchlist"><i class="large material-icons">format_list_bulleted</i><span>Watchlist</span></a></li>
                <li><a href="/favorites"><i class="large material-icons">favorite</i><span>Favorites</span></a></li>
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
                <li><a href="/genres/?g=878-Science Fiction" class="genre-Science Fiction"><span>Science Fiction</span></a>
                </li>
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
                    <input id="search-movie" type="text" placeholder="Insterstellar, Man Of Steel, ..."
                           class="autocomplete" name="title">
                    <i class="material-icons prefix">search</i>
                </div>
            </form>
        </div>
        <div class="item item-cb">
        </div>
        <div class="item item-cc">
            <?php showUserInHeader($loggedin); ?>
            <a href="#!" class="mobile-menu-trigger">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </div>
    <div class="item item-d">
        <div class="carousel">
            <a class="carousel-item" href><img src></a>
            <a class="carousel-item" href><img src></a>
            <a class="carousel-item" href><img src></a>
            <a class="carousel-item" href><img src></a>
            <a class="carousel-item" href><img src></a>
        </div>
        <div class="carousel-details">
            <h2></h2>
            <p></p>
        </div>
    </div>
    <div class="item item-e">
        <div class="sort-grid">
            <h2>Discover movies</h2>
            <div class="sort-type">
                <a href="#!" class="change-sort active" data-sort-type="popularity">Popularity</a> /
                <a href="#!" class="change-sort" data-sort-type="release_date">Release date</a> /
                <a href="#!" class="change-sort" data-sort-type="vote_average">Rating</a>
            </div>
            <div class="sort-year">
                <a href="#!" class="change-sort" data-sort-year="1960">All time</a> /
                <a href="#!" class="change-sort active" data-sort-year="2018">2018</a> /
                <a href="#!" class="change-sort" data-sort-year="2017">2017</a>
            </div>
        </div>
        <div class="watch-grid">

        </div>
    </div>
    <div class="item item-f">
        <ul class="pagination">
            <li class="change-page active"><a href="#!">1</a></li>
            <li class="change-page"><a href="#!">2</a></li>
            <li class="change-page"><a href="#!">3</a></li>
            <li class="change-page"><a href="#!">4</a></li>
            <li class="change-page"><a href="#!">5</a></li>
        </ul>
    </div>
    <div class="item item-g">
    </div>
</div>
<?php showAccountModal($loggedin); ?>
<div class="mobile-menu-cover mobile-menu-trigger"></div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<!-- The Movie Database js-->
<script src="/assets/js/themoviedb.js"></script>
<script src="/base.js"></script>
<script src="discover.js"></script>

</body>
</html>
