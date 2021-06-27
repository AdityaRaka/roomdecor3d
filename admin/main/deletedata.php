<?php
    include '../controller/connect.php';

    if(isset ($_POST['delete'])){
        $id = $_POST['delete_id'];
    
        $sql = "DELETE FROM data_perabot WHERE id_perabot= '$id'";
        $result = mysqli_query($connect, $sql);
    
        if($result){
          echo "<script>alert('Data Has Been Deleted.')</script>";
          header("Location:furnitures.php");
          exit;
        }else {
          echo "<script>alert('Data Not Deleted.')</script>";
        }
    }
?>