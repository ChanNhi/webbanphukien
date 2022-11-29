<?php


if(isset($_GET['action'])&&$_GET['action']=='themyeuthich'){
  if(!isset($_SESSION['dangnhap'])){
    header('Location:index.php?page=login');
  }
}
   //ĐĂNG KÝ
if(isset($_POST['dangky'])){
  $hoten = $_POST['hoten'];
  $taikhoan = $_POST['taikhoan'];
  $matkhau = md5($_POST['matkhau']);
  $matkhau1 = md5($_POST['matkhau1']);
  if(mysqli_num_rows(mysqli_query($mysqli, "SELECT taikhoan FROM user where taikhoan='".$taikhoan."'"))>0){
      echo '<script>alert("Tên tài khoản đã tồn tại");</script>';
  }
  else
  if(mysqli_num_rows(mysqli_query($mysqli, "SELECT taikhoan FROM user where taikhoan='".$taikhoan."'"))==0){
      $sql_dk = "INSERT INTO user(hoten, taikhoan, matkhau) VALUES('".$hoten."','".$taikhoan."','".$matkhau."') ";
      $query_dk = mysqli_query($mysqli, $sql_dk);
      header('Location:login.html');
  }
  
}

  //ĐĂNG NHẬP
if(isset($_POST['dangnhap'])){
  $taikhoan = $_POST['taikhoan'];
  $matkhau = md5($_POST['matkhau']);
  // $matkhau = $_POST['matkhau'];
  $sql = "SELECT * FROM user WHERE taikhoan = '".$taikhoan."' AND matkhau = '".$matkhau."' LIMIT 1";
  $query = mysqli_query($mysqli, $sql);
  $row = mysqli_fetch_array($query);
  $count = mysqli_num_rows($query);
  if($count>0){
      $_SESSION['dangnhap'] = $row['id'];
      header('Location:index.html');
  }
  else{
  echo '<script>alert("Sai tên đăng nhập hoặc mật khẩu");</script>';
  }
}

//Đăng xuất
if(isset($_GET['page'])&&$_GET['page'] == 'dangxuat'){
  unset($_SESSION['dangnhap']);
  header('Location:index.html');
}
//Đổi mật khẩu
if(isset($_POST['doimatkhau'])){
  $matkhau = md5($_POST['matkhau']);
  $matkhau1 = md5($_POST['matkhau1']);
  $matkhau2 = md5($_POST['matkhau2']);
  $id = $_GET['idtaikhoan'];
  
  $sql = "SELECT * FROM user WHERE id = '".$id."' LIMIT 1";
  $query = mysqli_query($mysqli, $sql);
  $row = mysqli_fetch_array($query);

  if($row['matkhau']!=$matkhau){
    echo '<script>alert("Mật khẩu cũ không chính xác");</script>';
  }
  else{
    $sql_doi = "UPDATE user SET matkhau='".$matkhau1."' WHERE id = '".$id."' LIMIT 1";
    $query_doi = mysqli_query($mysqli, $sql_doi);
    header('Location:profile.html');
  }
}
//Xóa đơn hàng
if(isset($_SESSION['dangnhap'])){
  if(isset($_GET['query'])&&$_GET['query']=='xoadh'&&$_SESSION['dangnhap']==$_GET['user']){
      $sql = "DELETE FROM donhang_chitiet WHERE id_donhang = ".$_GET['iddonhang']."";
      $query = mysqli_query($mysqli, $sql);
      $sql_dh = "DELETE FROM donhang WHERE id = ".$_GET['iddonhang']."";
      $query_dh = mysqli_query($mysqli, $sql_dh);
      header('Location:../../orderlist.html');
  }
}
?>
<div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <img src="images/logo.png" alt="width:10px" class="navbar-brand" href="#">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="header-login">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      
                      <?php
                          if(isset($_SESSION['dangnhap'])){
                            $sql_user = "SELECT * FROM user WHERE id = ".$_SESSION['dangnhap']." LIMIT 1";
                            $query_user = mysqli_query($mysqli, $sql_user);
                            $row_user = mysqli_fetch_array($query_user);
                      ?>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown iddangnhap" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Chào <?php echo $row_user['hoten'] ?>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.html">Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item" href="wishlist.html">Danh sách yêu thích</a></li>
                            <li><a class="dropdown-item" href="orderlist.html">Đơn hàng</a></li>
                            <li><a class="dropdown-item" href="dangxuat.html">Đăng xuất</a></li>
                          </ul>
                        </li>
                        <?php
                          }else{
                        ?>
                        <li class="nav-item">
                          <a id="iddangnhap" class="nav-link active" aria-current="page" href="login.html">Đăng nhập</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li class="nav-item cart-number-icon">
                          <a class="nav-link cart-numbers" href="cart.html">
                            <img src="./images/cart.png" alt="">
                            <?php
                              if(isset($_SESSION['cart'])){
                                $soluong = 0;
                                foreach($_SESSION['cart'] as $cart_item){
                                  $soluong +=1;
                                }
                            ?>
                            <span style="color:red">
                                <?php echo $soluong; ?>
                            </span>
                            <?php
                                }else{
                            ?>
                            <span style="color:red">
                                0
                            </span>
                            <?php
                                }
                              ?>
                          </a>
                        </li>
                      </ul>
                </div> 
              </div>
            </div>
          </nav>

        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html">Trang chủ</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dang mục sản phẩm
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                      <?php
                          //Hiển thị danh mục header
                          $sql = "SELECT * FROM danhmucsp";
                          $query = mysqli_query($mysqli, $sql);
                          while($row = mysqli_fetch_array($query)){
                      ?>
                      <li><a class="dropdown-item" href="category/<?php echo $row['id'] ?>.html"><?php echo $row['tendanhmuc'] ?></a></li>
                      <?php
                          }
                      ?>
                    </ul>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link cart-numbers" href="index.php?page=cart"><i class="fa fa-shopping-cart"></i><span style="color:red">0</span></a>
                  </li> -->
                  <li class="nav-item">
                    <a class="nav-link" href="#">Thông tin</a>
                  </li>
                </ul>
                <?php
                    if(isset($_GET['iddanhmuc'])){
                        $iddanhmuc = $_GET['iddanhmuc'];
                ?>
                <form action="index.php?page=product&iddanhmuc=<?php echo $iddanhmuc ?>" method="GET" class="d-flex">
                    <input type="hidden" name="page" value="product">
                    <input type="hidden" name="iddanhmuc" value="<?php echo $iddanhmuc ?>">
                    <input style="width:200px" class="form-control me-2" type="text" name="thongtin" value="<?php echo isset($_GET['thongtin']) ? $_GET['thongtin'] : "" ?>" placeholder="Search" aria-label="Search">
                    <input class="btn btn-outline-success bg-primary text-black-50" type="submit" name="timkiem" value="Tìm kiếm">
                </form>
                <?php
                    }else if(isset($_GET['iddanhmuc'])&&isset($_GET['idthuonghieu'])){
                    $iddanhmuc = $_GET['iddanhmuc'];
                    $idthuonghieu = $_GET['idthuonghieu'];
                ?>
                <form action="index.php?page=product&iddanhmuc=<?php echo $iddanhmuc ?>&idthuonghieu=<?php echo $idthuonghieu ?>" method="GET" class="d-flex">
                    <input type="hidden" name="page" value="product">
                    <input type="hidden" name="iddanhmuc" value="<?php echo $iddanhmuc ?>">
                    <input type="hidden" name="idthuonghieu" value="<?php echo $idthuonghieu ?>">
                    <input style="width:200px" class="form-control me-2" type="text" name="thongtin" value="<?php echo isset($_GET['thongtin']) ? $_GET['thongtin'] : "" ?>" placeholder="Search" aria-label="Search">
                    <input class="btn btn-outline-success bg-primary text-black-50" type="submit" name="timkiem" value="Tìm kiếm">
                </form>
                <?php
                    }else{
                      $iddanhmuc = "";
                      $idthuonghieu = "";
                    }
                ?>
              </div>
            </div>
          </nav>
          
    </div>