<?php

include('connection.php');
$id = $_POST['id'];
$district_name = $_GET['district_name'];
$address = $_GET['address'];

$delete = mysqli_query($connect, "DELETE FROM route SET district_name='$district_name', address='$address' WHERE id='$id'");
if ($insert) {
    header('location:route.php');
} else {
    echo "GAGAL";
}
