<?php

include "connection.php";

$email         = $_POST['email'];
$password      = md5($_POST['password']);
$query         = mysqli_query($connect, "SELECT * FROM users WHERE email='$email' AND password='$password'");
$ada           = mysqli_num_rows($query);
var_dump($ada);
$data          = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];
$id_users      = $data['id'];
$accses_level  = $data['accses_level'];
$nama          = $data['name'];
$photo_session = $data['photo'];

if ($ada == 1) {
    session_start();
    $_SESSION['id_users'] = $id_users;
    $_SESSION['email'] = $email;
    $_SESSION['nama_lengkap'] = $name;
    $_SESSION['accses_level'] = $accses_level;
    $_SESSION['photo'] = $photo_session;
    header("location: dashboard.php");
} else {
    echo 'failed';
    // echo "<script> alert('Maaf Email atau Password anda salah'); window.location ='login.php'; </script>";
}
