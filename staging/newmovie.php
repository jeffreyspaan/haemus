<?php
include("connection.php");

$title = array_key_exists('title', $_POST) ? $_POST['title'] : '';
$title = htmlspecialchars($title);
$title = mysqli_real_escape_string($con, $title);

$tagline = array_key_exists('tagline', $_POST) ? $_POST['tagline'] : '';
$tagline = htmlspecialchars($tagline);
$tagline = mysqli_real_escape_string($con, $tagline);

$excerpt = array_key_exists('excerpt', $_POST) ? $_POST['excerpt'] : '';
$excerpt = htmlspecialchars($excerpt);
$excerpt = mysqli_real_escape_string($con, $excerpt);

$year = array_key_exists('year', $_POST) ? $_POST['year'] : '';
$year = (int)$year;

$poster_url = array_key_exists('poster_url', $_POST) ? $_POST['poster_url'] : '';
$poster_url = htmlspecialchars($poster_url);
$poster_url = mysqli_real_escape_string($con, $poster_url);

$backdrop_url = array_key_exists('backdrop_url', $_POST) ? $_POST['backdrop_url'] : '';
$backdrop_url = htmlspecialchars($backdrop_url);
$backdrop_url = mysqli_real_escape_string($con, $backdrop_url);

$rating = array_key_exists('rating', $_POST) ? $_POST['rating'] : '';
$rating = (int)$rating;

$seen = array_key_exists('seen', $_POST) ? $_POST['seen'] : '';
$seen = (int)$seen;

$sql = "INSERT INTO movies (uuid, title, tagline, excerpt, year, poster_url, backdrop_url ,rating, seen) VALUES ('" . uniqid() . "', '" . $title . "', '" . $tagline . "', '" . $excerpt . "', '". $year . "', '" . $poster_url . "', '" . $backdrop_url . "', '". $rating. "', '". $seen. "')";

if ($con->query($sql)) {
    echo "New record created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

?>
