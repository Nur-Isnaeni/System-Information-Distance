<?php

include('connection.php');
$district_name = $_POST['district_name'];
$address = $_POST['address'];

$insert = mysqli_query($connect, "INSERT INTO street SET district_name='$district_name', address='$address'");
if ($insert) {
    header('location:street.php');
} else {
    echo "GAGAL";
}
