<?php
    include '../controller/connect.php';

    if(isset ($_POST['update'])){
        $id = $_POST['update_id'];
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $store = $_POST['store'];
        $link = $_POST['link'];
        $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $image_design = addslashes(file_get_contents($_FILES["image_design"]["tmp_name"]));
    
        $sql = "UPDATE data_perabot SET nama_perabot = '$name', brand_perabot = '$brand', harga_perabot = $price, toko_perabot = '$store', foto_perabot = '$image', foto_desain = '$image_design', link_perabot = '$link' WHERE id_perabot= '$id'";
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