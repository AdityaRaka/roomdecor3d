<?php
  include '../controller/connect.php';
  session_start();

  if (!isset($_SESSION['nama_admin'])) {
    header("Location: ../login/index.php");
  }
  
  if(isset ($_POST['send'])){
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $store = $_POST['store'];
    $condition = $_POST['condition'];
    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    $sql = "INSERT INTO data_perabot (nama_perabot, brand_perabot, jenis_perabot, harga_perabot, ukuran_perabot, warna_perabot, toko_perabot, kondisi_perabot, foto_perabot)
            VALUES ('$name', '$brand', '$type', '$price', '$size', '$color', '$store', '$condition', '$image')";
    $result = mysqli_query($connect, $sql);

    if($result){
      header("Location:furnitures.php");
      exit;
    }else {
      echo "<script>alert('Something Went Wrong.')</script>";
    }
  }
    
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
    <title>Furnitures</title>
    <link rel="stylesheet" href="stylemain.css">
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
    <h1>Furniture List</h1>
    <hr>
    <!-- Button trigger modal -->
    <button type="button" id="add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#furnitureaddmodal">
      Add
    </button>

    <!-- Modal -->
    <div class="modal fade" id="furnitureaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" bgcolor="#1B262C">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Insert Furniture</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label>Furniture Name</label>
                <input type="text" name="name" class="form-control">
              </div>

              <div class="form-group">
                <label>Brand</label>
                <input type="text" name="brand" class="form-control">
              </div>

              <div class="form-group">
                <label>Type</label>
                <input type="text" name="type" class="form-control">
              </div>

              <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control">
              </div>

              <div class="form-group">
                <label>Size</label>
                <input type="text" name="size" class="form-control">
              </div>

              <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" class="form-control">
              </div>

              <div class="form-group">
                <label>Store</label>
                <input type="text" name="store" class="form-control">
              </div>

              <div class="form-group">
                <label>Condition</label>
                <input type="text" name="condition" class="form-control">
              </div>

              <div class="form-group">
                <label>Upload Furniture Image</label>
                <input type="file" name="image" id="image" class="form-control">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="send" class="btn btn-primary" onclick="return mess();">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- ##########################################################################################################################-->
    <!-- Edit POP UP form -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Furniture</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="updatedata.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                <label>Furniture Name</label>
                <input type="text" name="name" id="name" class="form-control">
              </div>

              <div class="form-group">
                <label>Brand</label>
                <input type="text" name="brand" id="brand" class="form-control">
              </div>

              <div class="form-group">
                <label>Type</label>
                <input type="text" name="type" id="type" class="form-control">
              </div>

              <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" id="price" class="form-control">
              </div>

              <div class="form-group">
                <label>Size</label>
                <input type="text" name="size" id="size" class="form-control">
              </div>

              <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" id="color" class="form-control">
              </div>

              <div class="form-group">
                <label>Store</label>
                <input type="text" name="store" id="store" class="form-control">
              </div>

              <div class="form-group">
                <label>Condition</label>
                <input type="text" name="condition" id="condition" class="form-control">
              </div>

              <div class="form-group">
                <label>Upload Furniture Image</label>
                <input type="file" name="image" id="image" class="form-control">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir Edit POP UP form -->
    <!-- ################################################################################################################# -->

    <!-- ##################################################################################################################-->
    <!-- Delete data form -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Furniture</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="deletedata.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
              <h5>Do you want to delete this data?</h5>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" name="delete" class="btn btn-primary">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir delete data form -->
    <!-- ################################################################################################################# -->


    <!-- Table -->
    <table class="table">
      <thead bgcolor="#0779E4">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Furniture Name</th>
          <th scope="col">Brand</th>
          <th scope="col">Type</th>
          <th scope="col">Price</th>
          <th scope="col">Size</th>
          <th scope="col">Color</th>
          <th scope="col">Store</th>
          <th scope="col">Condition</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql = "SELECT * FROM data_perabot";
          $result = mysqli_query($connect, $sql);

          if(mysqli_num_rows($result)>0){
            $no = 1;
            while($row=mysqli_fetch_array($result)){
              echo '
              <tr>
                  <td>'.$no.'</td>
                  <td>'.$row['nama_perabot'].'</td>
                  <td>'.$row['brand_perabot'].'</td>
                  <td>'.$row['jenis_perabot'].'</td>
                  <td>'.$row['harga_perabot'].'</td>
                  <td>'.$row['ukuran_perabot'].'</td>
                  <td>'.$row['warna_perabot'].'</td>
                  <td>'.$row['toko_perabot'].'</td>
                  <td>'.$row['kondisi_perabot'].'</td>
                  <td><img src="data:image;base64,'.base64_encode($row['foto_perabot']).'" alt="Image" style="width:100px; height:100px;"></td>
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

    <script>
      function mess(){
        alert('Adding Success!.');
        return true;
      }
    </script>

    <script>
      $(document).ready(function(){
        $('.editbtn').on('click', function(){
          $('#editmodal').modal('show');
            $tr = $(this).closest('tr');
            var data= $tr.children("td").map(function(){
              return $(this).text();
            }).get();

            console.log(data);
            $('#update_id').val(data[0]);
            $('#name').val(data[1]);
            $('#brand').val(data[2]);
            $('#type').val(data[3]);
            $('#price').val(data[4]);
            $('#size').val(data[5]);
            $('#color').val(data[6]);
            $('#store').val(data[7]);
            $('#condition').val(data[8]);
            $('#image').val(data[9]);
        });
      });
    </script>

<script>
      $(document).ready(function(){
        $('.deletebtn').on('click', function(){
          $('#deletemodal').modal('show');
            $tr = $(this).closest('tr');
            var data= $tr.children("td").map(function(){
              return $(this).text();
            }).get();

            console.log(data);
            $('#delete_id').val(data[0]);
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