<?php
require_once 'header.php';

$returnStatement = array();

if (isset($_SESSION['email'])) {
    destroySession();
    destroyTokenCookie();
    $returnStatement['hasError'] = false;
    $returnStatement['message'] = 'Logged out';
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = 'Not logged in';
}

echo json_encode($returnStatement);

?>
