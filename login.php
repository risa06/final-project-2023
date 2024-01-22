<?php
  ob_start();
  include "connection.php";
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Nunito -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome 6.4.0 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap 4.4.1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style>
    body {
      font-family: "Nunito", sans-serif;
    }
    .container-fluid, .row {
      height: 100vh;
    }
    .section {
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      flex-direction: column;
      padding: 0;
      margin: 0;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .section2 {
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      flex-direction: column;
      padding: 0;
      margin: 0;
      justify-content: center;
      align-items: center;
      background: #A6B1E1;
      height: 100vh;
    } 
    .wrapper {
      width: 100%;
      max-width: 100%;
      padding: 50px;
      height: 100vh;
    }
    .wrapper .form-control {
      border: 1px solid #A6B1E1;
      background-color: #F4EEFF;
      border-radius: 8px;
      padding: 10px;
      font-size: 18px;
    }
    .wrapper .form-control::-webkit-input-placeholder {
      color: #A6B1E1;
    }
    .wrapper .login-btn {
      padding: 10px;
      background-color: #424874;
      border-radius: 8px;
      font-size: 20px;
      font-weight: bold;
      color: #F4EEFF;
    }
    .wrapper .login-btn:hover {
      background-color: #A6B1E1;
    }
    .login-title {
      font-size: 50px;
      font-weight: 800;
      color: #424874;
    }
    form {
      width: 100%;
    }
    h3 {
      font-size: 20px; 
      font-weight: 600;
      text-align: center;
      color: red;
      margin-top: 25px; 
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="container-fluid">
    <div class="row">

      <!-- Illustration -->
      <div class="col-sm-6 col-md-6 px-0 d-none d-sm-block my-auto section2">
        <div class="section2">
          <div class="d-flex">
            <div class="my-auto">
              <i class="fas fa-house-signal mr-2" style="color: #424874; font-size: 100px"></i>
            </div>
            <div class="my-auto">
              <h1 class="login-title m-0">Smart<br>Home</h1>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Login Form -->
      <div class="col-sm-6 col-md-6 section">
        <div class="wrapper">
          <i class="fas fa-house-signal mb-4" style="color: #424874; font-size: 50px"></i>
          <h1 class="login-title">Hello!</h1>
          <form action="#" method="POST">
            <div class="form-group">
              <input type="email" name="input_email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" name="input_password" id="password" class="form-control" placeholder="Password">
            </div>
            <input type="submit" name="button_login" class="btn btn-block login-btn" id="login" value="LOGIN">
          </form>

          <?php
            if (isset($_POST['button_login'])) {
              $email = $_POST['input_email'];
              $password = $_POST['input_password'];

              $qry = mysqli_query($connection, "SELECT * FROM user WHERE email='$email' AND password=md5('$password')");
              $check = mysqli_num_rows($qry);
              $x = mysqli_fetch_array($qry);

              if ($check == 1) {
                  $_SESSION['input_email'] = $email;
                  $_SESSION['input_password'] = $password;
                  $_SESSION['name'] = $x['name'];
                  header ("location: index.php");
                  exit;
              }
              else {
                  echo "<h3>Email atau Password yang Anda masukkan salah!</h3>";
              }
            }
          ?>

        </div>
      </div>

    </div>
  </div>

  <!-- jQuery 3.4.1 -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

  <!-- Bootstrap 4.4.1 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>

