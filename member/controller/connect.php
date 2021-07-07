<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "roomdecor3d"; //Nama database 

$connect = mysqli_connect($server, $user, $pass, $database); // variabel yang digunakan untuk menghubungkan halaman web dengan database
if(!$connect){
    die("<script>alert('Connection Failed! Check database!')</script>");
}
?>