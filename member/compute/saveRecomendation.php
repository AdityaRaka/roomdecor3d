<?php
	$textValues ="";
	$ids = $semua['RankCosine'];
	foreach ($ids as $key => $id) {
		$textValues = $textValues."($id_member,$id)";
		if ($key !== count($ids)-1) {
			$textValues = $textValues.",";
		}
	}
	$sqlRecomDel = "DELETE FROM recomendation WHERE id_member=$id_member";
	$resultRecomDel = mysqli_query($connect, $sqlRecomDel);
	 if ($resultRecomDel) {
	 	echo 'success delete recom<br>';
		$sqlRecom = "INSERT INTO recomendation (id_member,id_perabot) VALUES $textValues";
		$resultRecom = mysqli_query($connect, $sqlRecom);
		 if ($resultRecom) {
		 	echo 'success save recom';
		 }
	 }
?>