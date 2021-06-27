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
    <link rel="stylesheet" href="mainstyle.css">

    <!-- API input nomor Telepon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- Remixicon -->
    <link href="../libs/remixicon/fonts/remixicon.css" rel="stylesheet">

    <title>My Project</title>

    <style>
      *{
        margin:0;
        padding:0;
        box-sizing: border-box;
      }
      .exit{
        display:flex;
        margin-left:400px
      }
      .exit p{
        color: white;
        margin: 0px;
        margin-left:200px;
        margin-top:15px
      }

      .utama{
        display:flex;
      }

      .left{
        width: 400px;
        margin-top:25px;
        padding-left:50px;
      }

      .profile-images{
        width: 150px;
        height: 150px;
        background: #fff;
        border-radius: 50%;
        overflow: hidden;
      }

      .profile-images img{
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .custom-file input[type='file']{
        display: none
      }

      .custom-file label{
        cursor: pointer;
        color: #000;
        text-align: center;
        display: table;
        margin-top: 15px;
        margin-left: 25px;
      }

      .custom-file label:hover{
        color:#0779E4;
      }

      .right{
        width: 1000px;
        margin-top:25px;
        margin-left: 50px;
        font-size: 20px;
      }

      .date{
        display:flex;

      }

      footer{
        text-align:right;
        margin-right:60px;
      }

      footer .cancel{
        margin-left: 20px;
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" id="home">Room Decor 3D</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="icon" style="font-size: 32px;">
          <a href="#"><i class="ri-notification-3-fill"></i></a>
        </div>

        <div class="user">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Userxxx
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Favorites</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Exit Bar -->
    <nav class="nav" style="background-color: #0779E4; height:60px;">
      <div class="container-fluid exit">
        <p>Klik here, if you want to cancel</p>
        <a href="idea.php"><button type="button" class="btn btn-dark" style="height:40px; width:80px; margin-top:10px; margin-left:20px">Exit</button></a> 
      </div>
      
    </nav>
    <!-- Akhir Exit Bar -->

    <!-- Section -->
    <section class="utama">
    <!-- Bagian Section Kiri  -->
      <div class="left">
        <div class="profile-images">
          <img src="https://img.icons8.com/color/100/000000/test-account.png" id="upload-img">
        </div>
        <div class="custom-file">
          <label for="fileupload">Change Photo</label>
          <input type="file" id="fileupload" name="fileupload">
        </div>
      </div>
    <!-- Akhir Bagian Section Kiri  -->

    <!-- Bagian Section Kanan -->
      <div class="right">
        <div class="mb-3 row">
        <label for="inputFullname" class="col-sm-2 col-form-label">Fullname</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="fullname" name="fullname">
          </div>
        </div>

        <div class="mb-3 row">
        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="username" name="username">
          </div>
        </div>

        <div class="mb-3 row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Date Of Birth</label>
          <div class="col-sm-6 date">
            <input type="text" class="form-control" id="birth" name="birth">
            <input type="date" id="datepicker" name="date" style="margin-left:20px; width:400px; border-radius:5px; outline: none; box-sizing: border-box; border: 1px solid #707070;">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
          </div>
        </div>

        <div class="mb-3 row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" id="email" name="email">
          </div>
        </div>

        <div class="mb-3 row">
        <label for="inputPhone" class="col-sm-2 col-form-label">Phone Number</label>
          <div class="col-sm-6">
            <input type="tel" class="form-control" id="phone" name="phone">
          </div>
        </div>

        <div class="mb-3 row">
        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
          <div class="col-sm-6">
            <input type="address" class="form-control" id="address" name="address">
          </div>
        </div>

        <div class="mb-3 row" >
          <label for="inputGender" class="col-sm-2 col-form-label">Sex</label>
          <div class="col-sm-6">
            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male"> Male
            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female" style="margin-left:20px;"> Female
          </div> 
        </div>

        <div class="mb-3 row">
          <label for="inputBio" class="col-sm-2 col-form-label">Bio</label>
          <div class="col-sm-6">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bio"></textarea>
          </div>
        </div>
      </div>
    <!-- Akhir Bagian Section Kanan -->
    </section>
    <!-- Akhir Section -->

    <!-- Footer -->
    <footer>
      <button class="btn btn-primary save" type="submit">Save</button>
      <button class="btn btn-danger cancel" type="submit">Cancel</button>
    </footer>
    <!-- Akhir Footer -->
    
    <script src="../js/jquery-latest.min.js"></script>

    <!-- Script js yang digunakan untuk logika upload foto profile -->
    <script>
      $(function(){
        $("#fileupload").change(function(event) {
          var x = URL.createObjectURL(event.target.files[0]);
          $("#upload-img").attr("src",x);
          console.log(event);
        });
      })
    </script>

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