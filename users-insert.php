<?php
include "connection.php";
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);
$accses_level = $_POST['accses_level'];

$name_photo = $_FILES['photo']['name'];
$source = $_FILES['photo']['tmp_name'];
$folder = 'assets/img/';

if ($name_photo != '') {
    move_uploaded_file($source, $folder . $name_photo);
    $insert = mysqli_query($connect, "INSERT INTO users SET
                name='$name',
                email='$email',
                phone='$phone',
                password='$password',
                accses_level='$accses_level',
                photo='$name_photo'
                ");
    if ($insert) {
        header("location: users.php");
    } else {
        echo "gagal input";
    }
} else {
    $insert = mysqli_query($connect, "INSERT INTO users SET
                name='$name',
                email='$email',
                phone='$phone',
                password='$password',
                accses_level='$accses_level'
                ");
    if ($insert) {
        header("location: users.php");
    } else {
        echo "gagal input";
    }
}
