<?php
  if(isset($_SESSION['dangnhap'])){
?>
<div class="login">
        <section class="vh-100">
            <div class="container-fluid h-custom">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="images/login.jpg" class="img-fluid"
                    alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form action="index.php?page=editpass&idtaikhoan=<?php echo $_GET['idtaikhoan'] ?>" method="POST" onsubmit="return kiemtradn();">
                    <!-- username input -->
                    <div class="form-outline mb-4">
                      <input name="matkhau" type="password" id="form3Example3 taikhoan" class="form-control form-control-lg" placeholder="Vui lòng nhập mật khẩu cũ" />
                      <label class="form-label" for="form3Example3">Mật khẩu cũ</label>
                    </div>
          
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                      <input name="matkhau1" type="password" id="form3Example4 matkhau" class="form-control form-control-lg" placeholder="Vui lòng nhập mật khẩu mới" />
                      <label class="form-label" for="form3Example4">Mật khẩu mới</label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                      <input name="matkhau2" type="password" id="form3Example4 matkhau" class="form-control form-control-lg" placeholder="Vui lòng nhập lại mật khẩu mới" />
                      <label class="form-label" for="form3Example4">Nhập lại mật khẩu mới</label>
                    </div>
          
                    <div class="text-center text-lg-start mt-4 pt-2">
                      <input id="doimatkhau" name="doimatkhau" type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Đổi mật khẩu"></input>
                      
                    </div>
          
                  </form>
                </div>
              </div>
            </div>
            
          </section>

    </div>
<?php
  }else{
    exit;
  }
?>
