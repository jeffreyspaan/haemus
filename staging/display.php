<?php

include("connection.php");

setlocale(LC_TIME, 'nl_NL', 'Dutch_Netherlands', 'Dutch');


// GET variables and setup query's

$order = $_GET['sort_order'] == 'descending' ? 'DESC' : 'ASC';
$column = $_GET['sort_colum'];
$sort_query = "ORDER BY " . $column . " " . $order;

if (empty($order) || empty($column)) {
    $sort_query = "";
}

$ids = isset($_GET['ids']) ? $_GET['ids'] : [];
$ids_query = "WHERE `id` IN (" . implode(",", $ids) . ")";

if (empty($ids)) {
    $ids_query = "";
}

$final_query = "SELECT * FROM `movies` " . $ids_query . " " . $sort_query . " ";

$result = mysqli_query($con, $final_query);

while ($data = mysqli_fetch_assoc($result)) {
    $added = (new DateTime($data['added']));
    $added = strftime('%#d %B', $added->getTimeStamp());

    $encoded_title = urlencode($data['title']);

    echo '<div class="movie-card">';
    echo '<div class="movie-container">';
    echo '<a class="cover" href="#">';
    echo '<div class="poster flex-center">';
    echo '<img src="' . $data['poster_url'] . '" alt="poster">';
    echo '<div><i class="material-icons">play_arrow</i></div>';
    echo '</div>';
    echo '</a>';
    echo '<div class="hero">';
    echo '<div class="background">';
    echo '<img src="' . $data['backdrop_url'] . '"/>';
    echo '</div>';
    echo '<div class="details">';
    echo '<div class="title1">' . $data['title'] . '</div>';
    echo '<div class="title2">' . $data['tagline'] . '</div>    ';
    echo '<div>';
    echo '<span class="card-rating">10</span>';
    echo '<span class="year">' . $data['year'] . '</span>';
    echo '</div>';
    echo '</div> <!-- end details -->';
    echo '</div> <!-- end hero -->';
    echo '<div class="description">';
    echo '<div class="column1">';
    echo '<span class="tag">action</span>';
    echo '<span class="tag">fantasy</span>';
    echo '<span class="tag">adventure</span>';
    echo '</div> <!-- end column1 -->';
    echo '<div class="column2">';
    echo '<p>' . $data['excerpt'] . '</p>';
    echo '</div> <!-- end column2 -->';
    echo '</div> <!-- end description -->';
    echo '</div> <!-- end container -->';
    echo '</div> <!-- end movie-card -->';

}

// echo "<div class='item' data-movie='" . $data['uuid'] . "'>";
// echo "<div class='image-box'>";
// echo "<img src='" . $data['image_url'] . "'>";
// echo "</div>";
// echo "<div class='info-box'>";
// echo "<div class='wrapper'>";
// echo "<div class='rating-wrapper'><div class='movie-rating'>" . $data['rating'] . "</div></div>";
// echo "<div class='details-wrapper'>";
// echo "<div class='movie-title'>" . $data['title'] . "</div>";
// echo "<div class='movie-year'>" . $data['year'] . "</div>";
// echo "</div>";
// echo "</div>";
// echo "<div class='overview'>";
// echo "<div class='movie-seen'><strong>Gezien:</strong> ";
// echo $data['seen'] ? 'ja' : 'nee';
// echo "</div>";
// echo "<div class='movie-added'><strong>Toegevoegd: </strong> " . $added . "</div>";
// echo "<div class='watch'>";
// echo "<a href='watch_movieonline.php?title=" . $encoded_title . "' target='_blank'><img src='/assets/images/movies/movieonline.png' /></a>";
// echo "</div>";
// echo "</div>";
// echo "</div>";
// echo "<div class='excerpt-box " . $data['uuid'] . "'>";
// echo "<p>" . $data['excerpt'] . "</p>";
// echo "</div>";
// echo "</div>";


// echo "<script type='text/javascript'>var s = document.createElement('script');s.type = 'text/javascript';s.src = 'loadin.js';$('body').append(s);</script>"

?>
