<?php
include "connection.php";
$id = $_GET['id'];

$query = mysqli_query($connect, "SELECT * FROM users WHERE id= '$id'");
$data = mysqli_fetch_array($query);
if(file_exists('../image/'.$data['photo'])){
    unlink('../image/'.$data['photo']);
}

$delete = mysqli_query($connect, "DELETE FROM users WHERE id= '$id'");
if ($delete) {
    header('location:users.php');
}else {
    echo 'Input Gagal';
}