<!DOCTYPE html>
<html>
<head>

	<!-- TITLE OF SITE-->
	<title>Movies // Jeffrey Spaan</title>

	<!-- META TAG -->
	<meta charset="utf-8">
  <meta name="robots" content="noindex, follow">

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

	<!-- FONTS -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,400italic,700italic' rel='stylesheet' type='text/css'>

	<!-- CUSTOM STYLE -->
	<style type="text/css">

  .container {
    width: 600px;
    height: 600px;
    position: relative;
    top: 150px;
  }

  .container div {
    height: 300px;
    width: 300px;
  }

  .container .col {
    background: transparent;

  }


  </style>

</head>
<body>

<div class="row">
  <div class="container">
    <div class="col s12 m6">
      tset
    </div>
    <div class="col s12 m6">
      tset
    </div>
    <div class="col s12 m6">
      tset
    </div>
    <div class="col s12 m6">
      tset
    </div>
  </div>
</div>

<?php

require_once 'classes/Movieonline.php';
$movie_online = new Movieonline($_GET['title']);

require_once 'classes/Gomovies.php';
$gomovies = new Gomovies($_GET['title']);

require_once 'classes/Fmovies.php';
$fmovies = new Fmovies($_GET['title']);

// echo $fmovies->getSearchUrl();
echo $fmovies->getFullMovieUrl();
echo $movie_online->getFullMovieUrl();
echo $gomovies->getFullMovieUrl();



?>


</body>
