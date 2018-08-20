<?php

session_start();
require_once dirname(__FILE__) . '/../functions.php';


$returnStatement = array();

if ($_SESSION) {
    $uuid = $_SESSION['uuid'];

    $idQuery = queryMysql("SELECT id FROM users WHERE uuid='$uuid'");
    $idResult = $idQuery->fetch_array(MYSQLI_ASSOC);
    $userId = $idResult['id'];

    $favoritesQuery = queryMysql("SELECT movie_id from user_favorites where user_id = $userId ORDER BY added DESC ");

    if ($favoritesQuery->num_rows) {
        $returnStatement['hasError'] = false;
        $returnStatement['message'] = '';
        $returnStatement['movies'] = array();

        while ($row = $favoritesQuery->fetch_array(MYSQLI_ASSOC)) {
            $returnStatement['movies'][] = $row['movie_id'];
        }

    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = "You don't have any favorite movies yet.";
        $returnStatement['movies'] = false;
    }


} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = "Log in to view your favorite movies!";
    $returnStatement['movies'] = false;
}

echo json_encode($returnStatement);