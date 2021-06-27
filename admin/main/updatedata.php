<?php
    include '../controller/connect.php';

    if(isset ($_POST['update'])){
        $id = $_POST['update_id'];
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        $store = $_POST['store'];
        $condition = $_POST['condition'];
        $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    
        $sql = "UPDATE data_perabot SET nama_perabot = '$name', brand_perabot = '$brand', jenis_perabot = '$type', harga_perabot = $price, ukuran_perabot = '$size', warna_perabot = '$color', toko_perabot = '$store', kondisi_perabot = '$condition', foto_perabot = '$image' WHERE id_perabot= '$id'";
        $result = mysqli_query($connect, $sql);
    
        if($result){
          echo "<script>alert('Data Updated.')</script>";
          header("Location:furnitures.php");
          exit;
        }else {
          echo "<script>alert('Data Not Updated.')</script>";
        }
    }
?>