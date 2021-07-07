<?php 
$items = $_POST['items'];
file_put_contents('data.json', json_encode($items));
 ?>