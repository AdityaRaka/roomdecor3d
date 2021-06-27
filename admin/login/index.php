<?php
  include '../controller/connect.php';
  error_reporting(0);
  
  session_start();
  if (isset($_SESSION['nama_admin'])) {
    header("Location: ../main/furnitures.php");
  }
  if(isset($_POST['send'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connect, $sql);
    if($result->num_rows > 0){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['nama_admin'] = $row['nama_admin'];
      header("Location: ../main/furnitures.php");
    }else {
      echo "<script>alert('Email or Password Unkown.')</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Room Decor 3D Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
</head>

<body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand">Admin Room Decor 3D</a>
    </div>
  </nav>
  <!-- Akhir Header -->

  <!-- Main -->
  <div class="container">
    <div class="header">
      <h1 class="fs-4 card-title fw-bold mb-4">Admin Login</h1>
    </div>
    <form action="" method="POST" id="form" class="form">
      <div class="mb-3">
        <label class="mb-2 text-muted" for="email"">E-Mail Address</label>
        <input type="email" placeholder="a@florin-pop.com" id="email" name="email" value="<?php echo $email; ?>" />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $_POST['password']; ?>" />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="d-flex align-items-center">
        <div class="form-check">
          <input type="checkbox" name="remember" id="remember" class="form-check-input">
          <label for="remember" class="form-check-label">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary ms-auto" name="send">Login</button>
      </div>
    </form>

    <div class="card-footer py-3 border-0">
      <div class="text-center">
        Don't have an account? <a href="register.php" class="text-dark">Create One</a>
      </div>
    </div>
  </div>
  
  <div class="text-center mt-5 text-muted" >
    Copyright &copy; 2020-2021 &mdash; Room Decor 3d Admin 
  </div>
  <!-- Akhir Main -->

<script src="../js/script.js"></script>

</body>
</html>
