<?php
include "connection.php";
$id = $_POST['id'];
$query = mysqli_query($connect, "SELECT * FROM users WHERE id= '$id'");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);
$accses_level = $_POST['accses_level'];

$name_photo = $_FILES['photo']['name'];
$source = $_FILES['photo']['tmp_name'];
$folder = 'image/';

if ($name_photo != '') {

    if (file_exists('images/' . $_POST['old_photo'])) {
        unlink('images/' . $_POST['old_photo']);
    }
    move_uploaded_file($source, $folder . $name_photo);
    if ($password != '') {
        $newPassword = md5($password);
        $update = mysqli_query($connect, "UPDATE users SET
                name='$name',
                email='$email',
                phone='$phone',
                password='$newPassword',
                accses_level='$accses_level',
                photo='$name_photo'
                WHERE id='$id'");
    } else {
        $update = mysqli_query($connect, "UPDATE users SET
                name='$name',
                email='$email',
                phone='$phone',
                password='$newPassword',
                accses_level='$accses_level',
                photo='$name_photo'
                WHERE id='$id'");
    }
    if ($update) {
        header("location: ../users.php");
    } else {
        echo "gagal input";
    }
} else {
    if ($password != '') {
        $newPassword = md5($password);
        $update = mysqli_query($connect, "UPDATE users SET name='$name', email='$email', phone='$phone', password='$newPassword', accses_level='$accses_level', WHERE id='$id'");
    } else {
        $update = mysqli_query($connect, "UPDATE users SET name='$name', email='$email', phone='$phone', password='$newPassword', accses_level='$accses_level', WHERE id='$id'");
    }
    if ($update) {
        header("location: ../users.php");
    } else {
        echo "gagal input";
    }
}
