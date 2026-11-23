<?php
$host = "127.0.0.1";
$user = "root";
$pass = "root";
$db = "db_laundry";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>