<?php

include('connection.php');
$rute_start = $_POST['rute_start'];
$rute_finish = $_POST['rute_finish'];
$distance_price = $_POST['price'];

$street = mysqli_query($connect, "SELECT * FROM street WHERE id ='$rute_finish'");
$data   = mysqli_fetch_all($street, MYSQLI_ASSOC)[0];
$district = $data['district_name'];
$district_address = $data['address'];

$insert = mysqli_query($connect, "INSERT INTO route SET street_id='$rute_start' ,district='$district' ,district_address='$district_address' , price='$distance_price'");
if ($insert) {
    header('location:routes.php');
} else {
    echo "GAGAL";
}
