<?php
  session_start();
  include('config/config.php');
  if(isset($_SESSION['dangnhapadpk'])){
    header('Location:index.php');
  }
  if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['taikhoan'];
    //$matkhau = md5($_POST['pass']);
    $matkhau = md5($_POST['matkhau']);
    $sql = "SELECT * FROM admin WHERE taikhoan = '".$taikhoan."' AND matkhau = '".$matkhau."' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    $count = mysqli_num_rows($query);
    if($count>0){
      $_SESSION['dangnhapadpk'] = $row['id'];
      $_SESSION['chucvupk'] = $row['chucvu'];
      header('Location:index.php');
    }
    else{
      echo '<script>alert("Tài khoản hoặc mật khẩu không chính xác");</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="./css/login.css"> -->
  <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">  
  <script src="./js/login.js"></script>
  <link href="css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">
  <link href="css/css/sb-admin-2.min.css" rel="stylesheet">
  <title>Đăng nhập vào trang quản lý</title>
</head>
<body class="bg-gradient-primary">>
<div class="logo"></div>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user" method="POST" onsubmit="return kiemtradangnhap();">
                                <div class="form-group">
                                    <input autocomplete="off" type="text" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Nhập vào tài khoản..." name="taikhoan">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Nhập vào mật khẩu..." name="matkhau">
                                </div>
                                <div class="form-group">
                                    <p id="baoloi"></p>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" name="dangnhap" class="btn btn-primary btn-user btn-block">
                                    Đăng nhập
                                </button>
                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> -->
                            </form>
                            
                            <!--<div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
<script src="./js/login.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="css/vendor/jquery/jquery.min.js"></script>
    <script src="css/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="css/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="css/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="css/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="css/js/demo/chart-area-demo.js"></script>
    <script src="css/js/demo/chart-pie-demo.js"></script>
</body>
</html>