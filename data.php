<?php
  include "connection.php";

  session_start();
  if(empty($_SESSION['input_email']) OR empty($_SESSION['input_password'])) {
    header('location: login.php');
  }
  else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data</title>

  <?php
    include "library.php";
  ?>

  <!-- style.css -->
  <link rel="stylesheet" href="style.css">

  <style>
    .table th {
      text-align: center;
      color: #424874;
      background-color: #A6B1E1;
      font-size: 16px;
      font-weight: 600;
      padding: 8px;
    }
    .table thead th {
      vertical-align: middle;
    }
    .table td { 
      color: #424874;
      background-color: #F4EEFF;
      font-size: 14px;
      font-weight: 400;
      padding: 8px;
    }
    .bg-white {
      color: #424874;
      font-size: 16px;
      font-weight: 600;
    }
    .total-pagination tr td {
      padding: 0;
      background-color: #FFFFFF;
      border-color: #FFFFFF;
      width: 100%;
    }
    h5 {
      color: #424874;
      font-size: 16px;
      font-weight: 500;
      margin: 0;
    }
    ul {
      margin: 0;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <div class="nav-link">Data</div>
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
              <h1 class="m-0">Data</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

              <div class="card-body py-0 px-0">
                <div class="table-responsive" id="data">
                  <!-- Table from data_source.php -->
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

  <!-- AJAX - jQuery -->
  <script>
    $(document).ready(function(){
          load_data();
          function load_data(page){
              $.ajax({
                    url:"data_source.php",
                    method:"POST",
                    data:{page:page},
                    success:function(data){
                        $('#data').html(data);
                    }
              })
          }
          $(document).on('click', '.halaman', function(){
              var page = $(this).attr("id");
              load_data(page);
          });
    });
  </script>
    
</body>
</html>

<?php } ?>