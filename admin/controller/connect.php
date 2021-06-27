<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "roomdecor3d";

$connect = mysqli_connect($server, $user, $pass, $database);
if(!$connect){
    die("<script>alert('Connection Failed! Check database!')</script>");
}
?>