<?php
$hostname = "localhost:3306";
$database = "persensi";
$username = "root";
$password = "";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
} else {
    echo "Koneksi Berhasil";
}