<?php
  include '../controller/connect.php';
  error_reporting(0);

  session_start();

  if (isset($_SESSION['nama_member'])) {
      header("Location: index.php");
  }

  //Membuat pengecekan jika nama input sudah sesuai dengan nama field di database.
  //Jika benar maka masukkan data ke database sesuai fieldnya.
  if(isset ($_POST['send'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $repassword = md5($_POST['repassword']);
    $place = $_POST['place'];
    $date = $_POST['date'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    //menyeleksi seluruh isi dari table member berdasarkan field username
    $sql = "SELECT * FROM member WHERE username='$username'";
    $result = mysqli_query($connect, $sql);
    if(!$result->num_rows > 0){
      $sql = "INSERT INTO member (nama_member, username, email, password, tempat_lahir, tanggal_lahir, alamat, no_telepon, jenis_kelamin)
            VALUES ('$fullname', '$username', '$email', '$password', '$place', '$date', '$address', '$phone', '$gender')";
      $result = mysqli_query($connect, $sql);
      if($result){
        echo "<script>alert('Member Registration Completed!.')</script>";
        $fullname = "";
        $username = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['repassword'] = "";
        $place = "";
        $date = "";
        $address = "";
        $phone = "";
        $gender = "";
      }else {
        echo "<script>alert('Something Went Wrong.')</script>";
      }
    }else {
			echo "<script>alert('Username Already Exists!.')</script>";
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
    <link rel="stylesheet" href="registerstyle.css">

    <!-- Remixicon -->
    <link href="../libs/remixicon/fonts/remixicon.css" rel="stylesheet">

    <!-- API input nomor Telepon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

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
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Konten -->
    <div class="main">
      <div class="container">
        <div class="header">
          <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
        </div>
        <form action="" method="POST" id="form" class="form">
        <div class="mb-3">
          <div class="form-group">
            <label class="mb-2" for="fullname"">Fullname</label>
            <input type="text" placeholder="Your Fullname" id="fullname" name="fullname" value="<?php echo $fullname; ?> "/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="username"">Username</label>
            <input type="text" placeholder="Your Username" id="username" name="username" value="<?php echo $username; ?>"/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="email">E-Mail Address</label>
            <input type="email" placeholder="a@florin-pop.com" id="email" name="email" value="<?php echo $email; ?>"/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="email">Password</label>
            <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $_POST['password']; ?>" required/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="email">Retype Password</label>
            <input type="password" placeholder="Retype Password" id="repassword" name="repassword" value="<?php echo $_POST['repassword']; ?>" required/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="email">Place Of Birth</label>
            <input type="text" placeholder="Birth Place" id="place" name="place" value="<?php echo $place; ?>"/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="datepicker"">Date Of Birth</label>
            <input type="date" id="datepicker" name="date" value="<?php echo $date; ?>"/>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>

          <div class="form-group">
            <label class="mb-2" for="email">Address</label>
            <input type="text" placeholder="Your Address" id="address" name="address" value="<?php echo $address; ?>"/>
          </div>

          <div class="form-group">
            <label class="mb-2" for="tel">Phone Numbers</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?> "/>
          </div>
        </div>

        <div class="gender">
          <label class="mb-2" for="sex" style="padding-left:20px;">Sex</label>
          <div class="sex" style="display: flex; padding-left:20px">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male">Male
            </div>
            <div class="form-check" style="padding-left: 50px;">
              <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female">Female
            </div>
          </div>
        </div>

        <div class="d-flex align-items-center">
          <button type="submit" class="tombol3 btn btn-primary" name="send">Register</button>
        </div>
        </form>

        <div class="card-footer py-3 border-0" style="background-color: #fff">
          <div class="text-center">
            Already have an account? <a href="index.php">Login</a>
          </div>
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