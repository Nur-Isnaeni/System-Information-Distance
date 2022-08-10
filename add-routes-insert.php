<?php

include('connection.php');
$id = $_POST['id'];
$district_name = $_POST['district_name'];
$address = $_POST['address'];

$insert = mysqli_query($connect, "INSERT INTO route SET district_name='$district_name', address='$address'");
if ($insert) {
    header('location:route.php');
} else {
    echo "GAGAL";
}
