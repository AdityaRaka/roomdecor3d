<?php
  include '../controller/connect.php';
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <title>Members</title>
    <link rel="stylesheet" href="mainstyle.css">
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="top">
          <a href="#" class="menu_icon"><i class="material-icons">dehaze</i></a>
        </div>

        <a class="btn btn-danger ms-auto" href="logout.php" role="button" style="margin-right: 20px">Logout</a>
    </nav>
    <!-- akhir navbar -->

    <!-- menu -->
    <nav class="menu">
      <a href="#" class="item_menu"><?php echo "Welcome, " . $_SESSION['nama_admin'];?></a>
      <a href="furnitures.php" class="item_menu">Furnitures</a>
      <a href="members.php" class="item_menu">Members</a>
	  </nav>
    <!-- akhir menu -->

    <!-- Main -->
    <h1>Member List</h1>
    <hr>
    <!-- Table -->
    <table class="table">
      <thead bgcolor="#0779E4">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Member Fullname</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Place Of Birth</th>
          <th scope="col">Date Of Birth</th>
          <th scope="col">Address</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Sex</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql = "SELECT * FROM member";
          $result = mysqli_query($connect, $sql);

          if(mysqli_num_rows($result)>0){
            $no = 1;
            while($row=mysqli_fetch_array($result)){
              echo '
              <tr>
                  <td>'.$no.'</td>
                  <td>'.$row['nama_member'].'</td>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.$row['tempat_lahir'].'</td>
                  <td>'.$row['tanggal_lahir'].'</td>
                  <td>'.$row['alamat'].'</td>
                  <td>'.$row['no_telepon'].'</td>
                  <td>'.$row['jenis_kelamin'].'</td>
                  <td>
                    <a class="btn btn-primary editbtn">Edit</a>
                    <a class="btn btn-danger deletebtn">Delete</a>
                  </td>
              </tr>
              ';
              $no++;
            }
          }else{
            echo "<script>alert('No Record Found!')</script>";
          }
        ?>
      </tbody>
    </table>
    <!-- Akhir Table -->
    <!-- Akhir Main -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $("body").on('click', '.top', function() {
                $("nav.menu").toggleClass("menu_show");
            });
        });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>