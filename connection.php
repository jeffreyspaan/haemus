<?php
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
} else {
    mysqli_select_db($con, "jeffreyspaan_nl_movies");
}
?>
