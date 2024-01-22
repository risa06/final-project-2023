<?php

  session_start();
  if(empty($_SESSION['input_email']) OR empty($_SESSION['input_password'])) {
    header('location: login.php');
  }
  else {

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <?php
    include "library.php";
  ?>

  <!-- style.css -->
  <link rel="stylesheet" href="style.css">
  
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <div class="nav-link">Home</div>
        </li>
    </nav>

    <!-- Main Sidebar Container -->
    <?php
      include "sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white">
      <!-- Title -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="m-0">Welcome to Outlier Detection System Using Smart Home Data</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- TEMPERATURE -->
            <div class="col-lg-6 col-12">
              <a href="visual_temperature.php">
                <div class="small-box">
                  <div class="inner">
                    <i class="fas fa-thermometer-half" style="color: #424874; font-size: 80px"></i>
                    <p>Temperature</p>
                  </div>
                </div>
              </a>
            </div>
            <!-- HUMIDITY -->
            <div class="col-lg-6 col-12">
              <a href="visual_humidity.php">
                <div class="small-box">
                  <div class="inner">
                    <i class="fas fa-tint" style="color: #424874; font-size: 80px"></i>
                    <p>Humidity</p>
                  </div>
                </div>
              </a>
            </div>
            <!-- LIGHT -->
            <div class="col-lg-6 col-12">
              <a href="visual_light.php">
                <div class="small-box">
                  <div class="inner">
                    <i class="fas fa-lightbulb" style="color: #424874; font-size: 80px"></i>
                    <p>Light</p>
                  </div>
                </div>
              </a>
            </div>
            <!-- CO2 -->
            <div class="col-lg-6 col-12">
              <a href="visual_co2.php">
                <div class="small-box">
                  <div class="inner">
                    <i class="fas fa-cloud" style="color: #424874; font-size: 80px"></i>
                    <p>CO<sub>2</sub></p>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </section>

    </div>
  
    <!-- Footer -->
    <?php 
      include "footer.php";
    ?>

  </div>

</body>

</html>

<?php } ?>
