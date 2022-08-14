<?php

include('connection.php');
$id = $_GET['id'];

$delete = mysqli_query($connect, "DELETE FROM route WHERE id='$id'");
if ($delete) {
    header('location:routes.php');
} else {
    echo "GAGAL";
}
