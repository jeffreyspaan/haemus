<!DOCTYPE html>
<html>
<head>

    <!-- TITLE OF SITE-->
    <title>Movies // Jeffrey Spaan</title>

    <!-- META TAG -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Steen papier schaar // Hoi. Ik ben Jeffrey en ik ben altijd al gefascineerd geweest door de werking van computers en sinds twee jaar ontwikkel, design en onderhoud ik websites & webshops voor verschillende klanten.">
    <meta name="author" content="Jeffrey Spaan">

    <!-- FAVICON -->
    <link rel="icon" href="/assets/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/apple-icon-114x114.png">

    <!-- ========================================
                    Stylesheets
    ==========================================-->

    <!-- MATERIALIZE CORE CSS -->
    <!-- <link href="/assets/css/materialize.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,400italic,700italic' rel='stylesheet'
          type='text/css'>

    <!-- CUSTOM STYLE -->
    <link href="style.css" rel="stylesheet" type="text/css">

</head>
<body>

<section class="title-container">
    <div class="header-row">
        <div class="wow fadeIn a2 animated title logo" data-wow-delay="0.2s">
            <img src="/assets/images/movies/mmd-logo-2.png" alt="">
        </div>
        <input type="button" id="display" value="Display All Data"/>
        <form class="search-form" action="search.php" method="GET">
            <input type="text" id="search-text" name="query" placeholder="Search..."/>
            <button type="submit" id="search-submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</section>

<section class="response-container"></section>

<section class="new-movie">
    <div class="side-text-left new-movie-button">
        <h4>New Movie</h4>
    </div>
    <form method="post" id="new-movie-form" autocomplete="off">
        <!-- <input id="new-movie-title autocomplete-input" class="autocomplete" type="text" name="title"><br> -->
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="new-movie-title" class="autocomplete" name="title">
                <label class="new-movie-title-label" for="new-movie-title">Filmtitel</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <label style="float:left;width:100%">Rating</label>
                <fieldset class="rating">
                    <input type="radio" id="star10" name="rating" value="10"/>
                    <label class="full" for="star10"></label>
                    <input type="radio" id="star9" name="rating" value="9"/>
                    <label class="half" for="star9"></label>
                    <input type="radio" id="star8" name="rating" value="8"/>
                    <label class="full" for="star8"></label>
                    <input type="radio" id="star7" name="rating" value="7"/>
                    <label class="half" for="star7"></label>
                    <input type="radio" id="star6" name="rating" value="6"/>
                    <label class="full" for="star3"></label>
                    <input type="radio" id="star5" name="rating" value="5"/>
                    <label class="half" for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4"/>
                    <label class="full" for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3"/>
                    <label class="half" for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2"/>
                    <label class="full" for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1"/>
                    <label class="half" for="star1"></label>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <label class="active">Gezien?</label>
                <select class="new-movie-seen browser-default" name="seen">
                    <option value="1">Ja</option>
                    <option value="0">Nee</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <label class="active">Jaartal</label>
                <select class="new-movie-year browser-default" name="year">
                    <?php
                    for ($i = date("Y"); $i >= 1950; $i--) {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <input id="new-movie-poster-url" type="hidden" class="new-movie-poster-url" name="poster_url">
        <input id="new-movie-backdrop-url" type="hidden" class="new-movie-backdrop-url" name="backdrop_url">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" class="new-movie-tagline" id="new-movie-tagline" name="tagline"></textarea>
                <label class="new-movie-tagline-label" for="new-movie-tagline">Tagline</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea class="new-movie-excerpt materialize-textarea" id="new-movie-excerpt"
                          name="excerpt"></textarea>
                <label class="new-movie-excerpt-label" for="new-movie-excerpt">Samenvatting</label>
            </div>
        </div>
        <input id="sumbit-button" type="submit">
    </form>
    <div class="side-text-right close-new-movie-button">
        <h4>Close</h4>
    </div>
</section>

<div class="sidebar">
    <div class="heading">
        <div class=" nav-icon">
            <nav>
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="side-nav sidenav">
                        <li><a href="/">CV</a></li>
                        <li><a href="/portfolio">Portfolio</a></li>
                        <li><a href="/referenties">Referenties</a></li>
                        <li><a href="/waar-is-jeffrey">Waar is <span style="text-decoration:line-through;">Wally</span>
                                Jeffrey?</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                    <a href="#" data-target="nav-mobile" class="button-collapse sidenav-trigger"
                       style="position:fixed; top:0px;"><i class="mdi-navigation-menu material-icons">dehaze</i></a>
                </div>
            </nav>
        </div>
    </div>
</div>

<!--=====================
                JavaScript
===================== -->
<!-- Jquery core js-->
<script src="/assets/js/jquery.min.js"></script>

<!-- materialize js-->
<!-- <script src="/assets/js/materialize.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

<!-- wow js-->
<script src="/assets/js/wow.min.js"></script>

<!-- The Movie Database js-->
<script src="/assets/js/themoviedb.js"></script>

<!-- Custom js -->
<script type="text/javascript" src="movies.js"></script>


</body>
</html>
