<?php
include 'connection.php';

$result=mysqli_query($con, "SELECT * FROM `movies` ORDER BY `id` ASC");

$i = 1;

while($data = mysqli_fetch_assoc($result))
{
    $con->query("UPDATE movies SET `id` = '" . $i . "' WHERE `id` = " . $data['id']);
    $i++;
}

 ?>
