<?php
session_start();
require_once 'functions.php';

$returnStatement = array();

if (!empty($_POST['email']) && !empty($_POST['pass'])) {
    $email = sanitizeString($_POST['email']);
    $pass = sanitizeString($_POST['pass']);

    $result = queryMysql("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (password_verify($pass, $row['pass'])) {

            login($row['token'], $row['uuid'], $row['email'], $row['user']);

            $returnStatement['hasError'] = false;
            $returnStatement['message'] = 'Logged in';

        } else {
            $returnStatement['hasError'] = true;
            $returnStatement['message'] = 'The password is incorrect';
        }
    } else {
        $returnStatement['hasError'] = true;
        $returnStatement['message'] = 'The username or password is invalid';
    }
} else {
    $returnStatement['hasError'] = true;
    $returnStatement['message'] = 'One or more fields are empty';
}

mysqli_close($con);

echo json_encode($returnStatement);


?>
