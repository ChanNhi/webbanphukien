<?php
  if(isset($_SESSION['dangnhap'])){
      $sql = "SELECT * FROM user WHERE id = ".$_SESSION['dangnhap']." LIMIT 1";
      $query = mysqli_query($mysqli, $sql);
      $row = mysqli_fetch_array($query);
?>
<div class="profile shadow p-3 mb-5 bg-body rounded">
<div class="container rounded bg-white mt-5 mb-5">
        <div class="row container">
            <div class="col-md-3 border-right profile-img">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?php echo $row['taikhoan'] ?></span>
                    <span style="margin-top:20px"><a href="edit/<?php echo $_SESSION['dangnhap'] ?>.html">Đổi mật khẩu</a></span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Thông tin của bạn</h4>
                    </div>
                    <form action="pages/main/function.php?id=<?php echo $row['id'] ?>" method="POST">
                        <!-- <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Họ tên</label>
                                <input type="text" class="form-control" placeholder="Họ tên" value="<?php echo $row['hoten'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Giới tính</label>
                                <input type="text" class="form-control" value="" placeholder="Giới tính">
                            </div>
                        </div> -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Họ tên</label>
                                <input type="text" name="hoten" class="form-control" placeholder="Nhập vào số điện thoại" value="<?php echo $row['hoten'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">SĐT</label>
                                <input type="text" name="sdt" class="form-control" placeholder="Nhập vào số điện thoại" value="<?php echo $row['sdt'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Địa chỉ</label>
                                <input type="text" name="diachi" class="form-control" placeholder="Nhập địa chỉ" value="<?php echo $row['diachi'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Nhập vào Email" value="<?php echo $row['email'] ?>">
                            </div>
                            
                        </div>
                        <div class="mt-5 text-center">
                            <input class="btn btn-primary profile-button" type="submit" name="suathongtin" value="Lưu thay đổi">
                        </div>
                    </form>
                    
                </div>
            </div>
            
        </div>
</div>
</div>
<?php
  }else{
    exit;
  }
?>