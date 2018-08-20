<?php

session_start();
require_once dirname(__FILE__) . '/../functions.php';

$returnStatement = array();

if ($_SESSION) {
    if ($_POST) {
        $movieId = (int) $_POST['movieId'];
        $uuid = $_SESSION['uuid'];

        $idQuery = queryMysql("SELECT id FROM users WHERE uuid='$uuid'");
        $idResult = $idQuery->fetch_array(MYSQLI_ASSOC);
        $userId = $idResult['id'];

        $favoritesQuery = queryMysql("SELECT movie_id from user_favorites where user_id = '" . $userId . "' and movie_id = '" . $movieId . "'");

        if ($favoritesQuery->num_rows) {
            $returnStatement['hasError'] = true;
            $returnStatement['message'] = "This movie is already in your favorites.";

        } else {
            queryMysql("INSERT INTO user_favorites (`user_id`, `movie_id`) VALUES ('" . $userId . "' , '" . $movieId . "')");

            $returnStatement['hasError'] = false;
            $returnStatement['message'] = 'Movie added to favorites';
        }
    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = "There has been an error.";
    }
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = "Log in to add movies to your favorites.";
}

echo json_encode($returnStatement);