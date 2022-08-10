<?php

include('connection.php');
$district_id = $_GET['id'];


$delete = mysqli_query($connect, "DELETE FROM street WHERE id='$district_id'");
if ($delete) {
    header('location:street.php');
} else {
    echo "GAGAL";
}
