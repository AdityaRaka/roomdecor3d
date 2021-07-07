<?php
include '../controller/connect.php';
$sqlDelete = "DELETE FROM favorite WHERE id_member=$id_member AND id_perabot=$id_perabot";
	 $resultDelete = mysqli_query($connect, $sqlDelete);
	 if ($resultDelete) {
	 	echo 'unlike';
	 }
?>