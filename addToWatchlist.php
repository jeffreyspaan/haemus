<?php

session_start();
require_once 'functions.php';

$returnStatement = array();

if ($_SESSION) {
    if ($_POST) {
        $movieId = sanitizeString($_POST['movieId']);
        $uuid = $_SESSION['uuid'];

        $idQuery = queryMysql("SELECT id FROM users WHERE uuid='$uuid'");
        $idResult = $idQuery->fetch_array(MYSQLI_ASSOC);
        $userId = $idResult['id'];

        $watchlistQuery = queryMysql("SELECT movie_id from user_watchlist where user_id = '" . $userId . "' and '" . $movieId . "'");

        if ($watchlistQuery->num_rows) {
            $returnStatement['hasError'] = true;
            $returnStatement['message'] = "This movie is already in your watchlist.";

        } else {
            queryMysql("INSERT INTO user_watchlist (`user_id`, `movie_id`) VALUES ('" . $userId . "' , '" . $movieId . "')");

            $returnStatement['hasError'] = false;
            $returnStatement['message'] = '';
        }
    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = "There has been an error.";
    }
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = "Log in to add movies to your watchlist.";
}

echo json_encode($returnStatement);