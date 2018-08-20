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
            queryMysql("delete from user_favorites where user_id = '" . $userId . "' and movie_id = '" . $movieId . "'");

            $returnStatement['hasError'] = false;
            $returnStatement['message'] = 'Movie removed from favorites';

        } else {
            $returnStatement['hasError'] = true;
            $returnStatement['message'] = 'This movie is not in your favorites';
        }
    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = "No movie selected";
    }
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = "You are not logged in";
}

echo json_encode($returnStatement);