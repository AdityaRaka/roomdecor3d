<?php
include '../controller/connect.php';

session_start();

$id_perabot = $_GET['id_perabot'];
$id_member = $_SESSION['id_member'];
// include '../compute/algorithm.php';
// pp($term);


$sqlLike = "SELECT * from favorite where id_member=$id_member AND id_perabot=$id_perabot limit 1";
$resultFavorite = mysqli_query($connect, $sqlLike);
if ($resultFavorite->num_rows > 0) {
	include './deleteLike.php';
} else {

	if (isset($id_perabot) && isset($id_member)) {
		$sql = "INSERT INTO favorite (id_member,id_perabot) VALUES ($id_member,$id_perabot)";
		$result = mysqli_query($connect, $sql);
		if ($result) {
			echo 'like';
		}
	} else {
		if (!isset($id_member)) {
			header("HTTP/1.1 403 harap login");
			echo 'gagal';
		}else{
			header("HTTP/1.1 404 Not Found");
		}
	}
}
?>