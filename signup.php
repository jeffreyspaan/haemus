<?php
session_start();
require_once 'functions.php';

$user = $email = $pass = "";
$returnStatement = array();

if (isset($_SESSION['email'])) {
    destroyTokenCookie();
    destroySession();
}

if (!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['pass']) ) {
    $user = sanitizeString($_POST['user']);
    $email = sanitizeString($_POST['email']);
    $pass = sanitizeString($_POST['pass']);
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $result = queryMysql("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows) {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = 'This e-mail address is already in use.';
    } else {
        $uuid = uniqid();
        $token = uniqid();
        queryMysql("INSERT INTO users (`uuid`, `email`, `user`, `pass`, `token`) VALUES ('" . $uuid . "', '" . $email . "', '" . $user . "', '" . $pass . "', '" . $token . "')");

        login($token, $uuid, $email, $user);

        $returnStatement['hasError'] = false;
        $returnStatement['message'] = '';
    }

} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = 'One or more fields are empty';
}

mysqli_close($con);

echo json_encode($returnStatement);
