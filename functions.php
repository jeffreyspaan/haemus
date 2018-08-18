<?php
require_once 'connection.php';

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table $name created or already exists.<br>";
}

function queryMysql($query)
{
    global $con;

    $result = $con->query($query);
    if (!$result) die($con->error);

    return $result;
}

function login($token, $uuid, $email, $user)
{
    createTokenCookie($token);
    $_SESSION['uuid'] = $uuid;
    $_SESSION['email'] = $email;
    $_SESSION['user'] = $user;
}

function checkForLogin() {
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        return true;
    } else if ($uuid = checkForCookie()) {
        $result = queryMysql("SELECT * FROM users WHERE uuid='$uuid'");
        $row = $result->fetch_array(MYSQLI_ASSOC);

        login($row['token'], $row['uuid'], $row['email'], $row['user']);

        return true;

    } else {
        return false;
    }
}


function createTokenCookie($token)
{
    setcookie("mmdb-user-token", $token, time() + (86400 * 90), "/"); // 90 days
}

function destroyTokenCookie()
{
    setcookie("mmdb-user-token", "", time() - 3600);
}

function checkForCookie()
{
    if (isset($_COOKIE["mmdb-user-token"])) {
        $token = $_COOKIE["mmdb-user-token"];
        $token = sanitizeString($token);
        $result = queryMysql("SELECT * FROM users WHERE token='$token'");

        if ($result->num_rows === 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            return $row['uuid'];
        } else {
            return;
        }
    }
}

function destroySession()
{
    session_unset();
    session_destroy();
}

function sanitizeString($var)
{
    global $con;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $con->real_escape_string($var);
}

function showProfile($user)
{
    echo "<div class='container-fluid well'>";
    if (file_exists("$user.jpg"))
        echo "<div class='well container-fluid'><img src='$user.jpg'>";
    else
        echo "<div class='well container-fluid'><img src='Gast.jpg'>";
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<div class='well'>";
        echo stripslashes($row['text']);
        echo "</div></div></div>";
    } else {
        echo "<div class='well'>";
        echo "Deze gebruiker heeft nog geen profieltekst ingesteld.";
        echo "</div></div></div>";
    }
}

?>
