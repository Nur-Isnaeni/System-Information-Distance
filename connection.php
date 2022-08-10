<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'distance';
$connect = mysqli_connect($server, $username, $password, $database);

if (!$connect) {
    exit('failed');
}
