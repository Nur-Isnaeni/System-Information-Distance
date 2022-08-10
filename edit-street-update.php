<?php

include('connection.php');
$id = $_POST['id'];
$district_name = $_POST['district_name'];
$address = $_POST['address'];

$insert = mysqli_query($connect, "UPDATE street SET district_name='$district_name', address='$address' WHERE id='$id'");
if ($insert) {
    header('location:street.php');
} else {
    echo "GAGAL";
}
