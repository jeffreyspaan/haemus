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

        $watchlistQuery = queryMysql("SELECT movie_id from user_watchlist where user_id = '" . $userId . "' and movie_id = '" . $movieId . "'");

        if ($watchlistQuery->num_rows == 1) {
            $returnStatement['hasError'] = false;
            $returnStatement['movieIsInWatchlist'] = true;

        } else {
            $returnStatement['hasError'] = false;
            $returnStatement['movieIsInWatchlist'] = false;
        }

    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['movieIsInWatchlist'] = false;
    }
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['movieIsInWatchlist'] = false;
}

echo json_encode($returnStatement);
