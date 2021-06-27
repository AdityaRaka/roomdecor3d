<?php
  include '../controller/connect.php';
  error_reporting(0);

  session_start();

  if (isset($_SESSION['nama_admin'])) {
      header("Location: index.php");
  }

  if(isset ($_POST['send'])){
    $fullname = $_POST['fullname'];
    $birth = $_POST['birth'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = mysqli_query($connect, $sql);
    if(!$result->num_rows > 0){
      $sql = "INSERT INTO admin (nama_admin, tempat_lahir, tanggal_lahir, jenis_kelamin, email, password, no_telepon, alamat)
            VALUES ('$fullname', '$birth', '$date', '$gender', '$email', '$password', '$phone', '$address')";
      $result = mysqli_query($connect, $sql);
      if($result){
        echo "<script>alert('Admin Registration Completed!.')</script>";
        $fullname = "";
        $birth = "";
        $date = "";
        $gender = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['password2'] = "";
        $phone = "";
        $address = "";
      }else {
        echo "<script>alert('Something Went Wrong.')</script>";
      }
    }else {
			echo "<script>alert('Email Already Exists!.')</script>";
		}
    
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Room Decor 3D Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
      <h1 class="fs-4 card-title fw-bold mb-4">Admin Register</h1>
    </div>

    <form action="" method="POST" id="form" class="form">
      <div class="mb-3">
        <label class="mb-2 text-muted" for="name">Fullname</label>
        <input type="text" placeholder="Jack Sparrow" id="fullname" name="fullname" value="<?php echo $fullname; ?>"/>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="Birth">Place of Birth</label>
        <input type="text" placeholder="Pematang Siantar" id="birth" name="birth" value="<?php echo $birth; ?>" />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="datepicker">Date of Birth</label>
          <input type="date" id="datepicker" name="date" value="<?php echo $date; ?>"/>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>
      </div>

      <!-- Sex -->
      <label class="mb-2 text-muted" for="sex">Sex</label>
      <div class="sex">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male">Male
        </div>
        <div class="form-check" style="padding-left: 80px;">
          <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female">Female
        </div>
      </div>
        
      <div class="mb-3">
        <label class="mb-2 text-muted" for="email">E-Mail Address</label>
        <input type="email" placeholder="a@florin-pop.com" id="email" name="email" value="<?php echo $email; ?>" />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $_POST['password']; ?>" required />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="password">Retype Password</label>
        <input type="password" placeholder="Retype Password" id="password2" name="password2" value="<?php echo $_POST['password2']; ?>" required />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="address">Address</label>
        <input type="text" placeholder="Jl.Listrik No.24 Medan,Sumatera Utara" id="address" name="address" value="<?php echo $address; ?>" />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>

      <div class="mb-3">
        <label class="mb-2 text-muted" for="tel">Phone Numbers</label>
        <input id="phone" type="tel" name="phone" value="<?php echo $phone; ?>" />
      </div>

      <div class="d-flex align-items-center">
        <div class="form-check">
          <input type="checkbox" name="remember" id="remember" class="form-check-input">
          <label for="remember" class="form-check-label">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary ms-auto" name="send">Register</button>
      </div>
    </form>
    <div class="card-footer py-3 border-0">
      <div class="text-center">
        Already have an account? <a href="index.php" class="text-dark">Login</a>
      </div>
    </div>
  </div>
  <div class="text-center mt-5 text-muted" >
    Copyright &copy; 2020-2021 &mdash; Room Decor 3d Admin 
  </div>
  <!-- Akhir Main -->
<script src="../js/registerscript.js"></script>

<script>
  const phoneInputField = document.querySelector("#phone");
  const phoneInput = window.intlTelInput(phoneInputField, {
    utilsScript:
      "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
  });
</script>

</body>
</html>
