<?php
//konfigurasi database
$server = "localhost";
$user = "root";
$pass = "";
$database = "roomdecor3d";

//Membuat koneksi database
$connect = mysqli_connect($server, $user, $pass, $database);

//Cek Koneksi
if(!$connect){
    die("<script>alert('Connection Failed! Check database!')</script>");
}
?>