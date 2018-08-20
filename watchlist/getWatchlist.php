<?php

session_start();
require_once dirname(__FILE__) . '/../functions.php';


$returnStatement = array();

if ($_SESSION) {
    $uuid = $_SESSION['uuid'];

    $idQuery = queryMysql("SELECT id FROM users WHERE uuid='$uuid'");
    $idResult = $idQuery->fetch_array(MYSQLI_ASSOC);
    $userId = $idResult['id'];

    $watchlistQuery = queryMysql("SELECT movie_id from user_watchlist where user_id = $userId ORDER BY added DESC ");

    if ($watchlistQuery->num_rows) {
        $returnStatement['hasError'] = false;
        $returnStatement['message'] = '';
        $returnStatement['movies'] = array();

        while ($row = $watchlistQuery->fetch_array(MYSQLI_ASSOC)) {
            $returnStatement['movies'][] = $row['movie_id'];
        }

    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = "There are no movies in your watchlist.";
        $returnStatement['movies'] = false;
    }


} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = "Log in to view your watchlist!";
    $returnStatement['movies'] = false;
}

echo json_encode($returnStatement);