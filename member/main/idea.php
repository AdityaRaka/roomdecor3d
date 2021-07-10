<?php
  include '../controller/connect.php';
  error_reporting(0);
  $sqlPerabot = "SELECT * FROM `data_perabot` ORDER BY `id_perabot` ASC";
  $result = mysqli_query($connect, $sqlPerabot);
  $items = array();
    if($result->num_rows > 0){
      while($row = mysqli_fetch_object($result)){
        $row->foto_desain= "data:image/png;base64,".base64_encode($row->foto_desain);
        array_push($items, $row);
      }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="mainstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <!-- API input nomor Telepon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- Remixicon -->
    <link href="../libs/remixicon/fonts/remixicon.css" rel="stylesheet">

    <title>Get Your Idea</title>

    <style>
      .utama .kiri{
          width: 250px;
          height: 1960px;
          background-color: #1B262C;
      }

      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
      .wrapper{
        max-width: 1100px;
      }
      .gallery{
        display: flex;
        flex-wrap: wrap;
      }
      .gallery .image{
        padding: 7px;
        width: calc(100% / 3);
      }
      .gallery .image span{
        display: flex;
        width: 100%;
        overflow: hidden;
      }
      .gallery .image img{
        width: 100%;
        transition: all 0.3s ease;
        display: block;
      }
      .gallery .image:hover img{
        transform: scale(1.1);
      }

      .image{
        position: relative;
      }

      .bottom{
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        left: 50%;
        top: 92%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
      }

      .image:hover .bottom{
        opacity: 1;
      }

      .text{
        width: 352px;
        overflow: hidden;
        transition: all .3s ease;
        background-color: #000;
        color: white;
        font-size: 30px;
        padding: 0 0 0 20px;
        }
      .text a{
        text-decoration: none;
        color: #fff;
      }

      .preview-box{
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.9);
        background: #fff;
        max-width: 650px;
        width: 100%;
        z-index: 5;
        opacity: 0;
        pointer-events: none;
        border-radius: 3px;
        padding: 0 5px 5px 5px;
        box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
      }
      .preview-box.show{
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
        transition: all 0.3s ease;
      }
      .preview-box .details{
        display: flex;
        align-items: center;
        padding: 12px 15px 12px 10px;
        justify-content: space-between;
      }
      .preview-box .details .title{
        display: flex;
        font-size: 18px;
        font-weight: 400;
      }
      .details .title p{
        margin: 0 5px;
      }
      .details .title p.current-img{
        font-weight: 500;
      }
      .details .icon{
        color: #007bff;
        font-size: 20px;
        cursor: pointer;
      }
      .preview-box .image-box{
        display: flex;
        width: 100%;
        position: relative;
      }
      .image-box .slide{
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #fff;
        font-size: 30px;
        cursor: pointer;
        height: 50px;
        width: 60px;
        line-height: 50px;
        text-align: center;
        border-radius: 3px;
      }
      .slide.prev{
        left: 0px;
      }
      .slide.next{
        right: 0px;
      }
      .image-box img{
        width: 100%;
        border-radius: 0 0 3px 3px;
      }
      .shadow{
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 2;
        display: none;
        background: rgba(0,0,0,0.45);
      }

      @media(max-width: 1000px){
        .gallery .image{
          width: calc(100% / 2);
        }
      }
      @media(max-width: 600px){
        .gallery .image{
          width: 100%;
          padding: 4px;
        }
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

        <div class="icon" style="font-size: 25px;">
          <a href=""><i class="ri-notification-3-fill"></i></a>
        </div>

        <div class="user">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Userxxx
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
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

    <!-- Konten -->
    <section class="utama">
    <!-- Bagian Section Kiri  -->
      <div class="kiri">
          <nav>
          <a href="idea.php">Get Your Idea</a>
          <a href="rekom.php">Recommended</a>
          <a href="simulation.php">Simulation 3D</a>
          </nav>
      </div>
    <!-- Akhir Bagian Section Kiri -->

    <!-- Bagian Section Kanan -->
      <div class="kanan" style="padding-top:20px; padding-left:30px">
        <p class="text1">3D Model Visualizations Gallery</p>
        <p class="text2">Get your ide for designing room, make your dream room now!!</p>
        <hr>

        <div class="wrapper">
          <div class="gallery">
            <?php foreach ($items as $key => $item):?>
            <div class="image">
              <span><img src="<?=$item->foto_desain?>" alt=""></span>
              <div class="bottom">
                <div class="text">
                  <a href="#"><i class="ri-heart-3-line"></i></a>
                  <!-- <a href="#"><i class="ri-heart-3-fill"></i></a> -->
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="preview-box">
          <div class="details">
            <span class="title">Image <p class="current-img"></p> of <p class="total-img"></p></span>
            <span class="icon fas fa-times"></span>
          </div>
          <div class="image-box">
            <div class="slide prev"><i class="fas fa-angle-left"></i></div>
            <div class="slide next"><i class="fas fa-angle-right"></i></div>
            <img src="" alt="">
          </div>
        </div>
        <div class="shadow"></div>
      </div>
    <!-- Akhir Bagian Section Kanan -->
    </section>

    <!-- Akhir Section -->
    

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="../js/script.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>