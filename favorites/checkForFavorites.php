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

        if ($favoritesQuery->num_rows == 1) {
            $returnStatement['hasError'] = false;
            $returnStatement['movieIsInFavorites'] = true;

        } else {
            $returnStatement['hasError'] = false;
            $returnStatement['movieIsInFavorites'] = false;
        }

    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['movieIsInFavorites'] = false;
    }
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['movieIsInFavorites'] = false;
}

echo json_encode($returnStatement);
