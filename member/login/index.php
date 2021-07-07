<?php
  include '../controller/connect.php';
  error_reporting(0);

  //Membuat pengecekan untuk membaca data login di database yakni username dan password
  session_start();
  if(isset($_POST['send'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM member WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $sql);
    if($result->num_rows > 0){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['nama_member'] = $row['nama_member'];
      $_SESSION['id_member'] = $row['id_member'];
      header("Location: ../main/idea.php");
    }else {
      echo "<script>alert('Username or Password Unkown.')</script>";
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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="loginstyle.css">

    <!-- Remixicon -->
    <link href="../libs/remixicon/fonts/remixicon.css" rel="stylesheet">

    <title>Room Decor 3D</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" id="home">Room Decor 3D</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
          <a class="nav-link" href="#home">Home</a>
            <a class="nav-link" href="#baris">About</a>
            <a class="nav-link" href="#contact">Contact Us</a>
            <button type="button" id="add" class="btn btn-primary tombol2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
          </div>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Modal -->
    <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" bgcolor="#1B262C">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Your Username" value="<?php echo $username; ?>"/>
              </div>

              <div class="form-group" style="padding-top: 25px">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="<?php echo $_POST['password']; ?>" required/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="send" class="btn btn-primary" style="margin-right:157px; width:150px; height:50px">Login</button>
            </div>
            <div class="icons" style="margin-left: 177px">
              <a href="#"><img src="https://img.icons8.com/color/48/000000/google-logo.png"/></a>
              <a href="#"><img src="https://img.icons8.com/color/48/000000/facebook-circled--v1.png"/></a>
              <a href="#"><img src="https://img.icons8.com/color/48/000000/twitter-circled.png"/></a>
            </div>

            <div class="regis" style="margin-top:20px; text-align:center">
              <p style="font-weight:bold">Forget Password?</p>
              <p>Don't have any account yet? <a href="regis.php">Register</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir Modal -->
    
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Room Decor 3D</h1>
        <h1 class="display-5">Make Your Own Best Design Room</h1>
        <a href="http://furnishup.github.io/blueprint3d/example/#" class="btn btn-primary tombol">Create Your Room</a>
      </div>
    </div>
    <!-- Akhir Jumbotron -->

    <!-- Konten -->
    <div class="baris" id="baris">
      <div class="definisi" id="text1" style="text-align:justify;">
        <p>Hi we’re RD 3D. We provide platform 3D Design Room to you.</p>
      </div>

      <div class="definisi" id="text2" style="text-align:justify;">
        <p><span>Room Decor 3D help think a concept, so you can grow creativity for design.</span></p>
        <p>Today, the application of technology is increasingly advanced, especially in the field of design, especially coupled with the brand of room furniture that has a wide variety of products.</p> 
        <p>So we provide a platform that helps you independently in building an aesthetic space concept and has the correct function point of view in order to improve the quality of your creativity and of course equipped with the best product brands that you can choose as you wish.</p>
      </div>
    </div>

    <div class="makna">
      <p id="text1">Think a concept.</p>
      <p id="text2">Grow Creativity.</p>
    </div>


    <div class="about">
      <div class="roomtext">
        <p><span>Be creative, commitment, solving problem.</span></p>
        <p style="text-align:justify;">So we provide a platform that helps you independently in building an aesthetic space concept and has the correct function point of view in order to improve the quality of your creativity and of course equipped with the best product brands that you can choose as you wish.</p>
        <p style="text-align:justify;">So we provide a platform that helps you independently in building an aesthetic space concept and has the correct function.</p>
      </div>
      
        <img class="roomimage" src="../libs/img/register2.png" alt="room">
    </div>

    <div class="contact" id="contact">
      <div class="raka">
        <img class="foto1" src="../libs/img/raka.jpg" alt="raka">
        <div class="ket">
            <p><i>Aditya Raka</i></p>
            <p><i>Fullstack Web Developer</i></p>
            <p><i>aditrakaharis23@gmail.com</i></p>
            <p><i>+6287865245959</i></p>
        </div>
      </div>

      <div class="fikri">
        <img class="foto2" src="../libs/img/fikri.jpg" alt="fikri">
        <div class="ket">
            <p><i>M.Fikri Akbar Pratama</i></p>
            <p><i>Network Engineer</i></p>
            <p><i>fikriakbarpratama16@gmail.com</i></p>
            <p><i>+6287865245959</i></p>
        </div>
      </div>
    </div>
    
    <!-- Akhir Konten -->

    <!-- Footer -->
      <footer>
        <div class="link">
          <a href="#"><i class="ri-instagram-line"></a></i>
          <a href="#"><i class="ri-facebook-fill"></i></a> 
          <a href="#"><i class="ri-linkedin-box-fill"></i></a> 
          <a href="#"><i class="ri-twitter-fill"></i></a> 
        </div>
        
        <div class="lisensi">
          <p>@2021 Room Decor 3D</p>
        </div>
      </footer>
    <!-- Akhir Footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>