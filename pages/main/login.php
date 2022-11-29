<?php
  if(!isset($_SESSION['dangnhap'])){
?>
<div class="login shadow p-3 mb-5 bg-body rounded">
        <section class="vh-100">
            <div class="container-fluid h-custom">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="images/login.jpg" class="img-fluid"
                    alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form action="index.php?page=login" method="POST" onsubmit="return kiemtradn();">
                    <!-- username input -->
                    <div class="form-outline mb-4">
                      <input required autocomplete="off" name="taikhoan" type="text" id="form3Example3 taikhoan" class="form-control form-control-lg" placeholder="Vui lòng nhập tên đăng nhập" />
                      <label class="form-label" for="form3Example3">Tên đăng nhập</label>
                    </div>
          
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                      <input required name="matkhau" type="password" id="form3Example4 matkhau" class="form-control form-control-lg" placeholder="Vui lòng nhập mật khẩu" />
                      <label class="form-label" for="form3Example4">Mật khẩu</label>
                    </div>
          
                    <div class="d-flex justify-content-between align-items-center">
                      <!-- Checkbox -->
                      <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                        <label class="form-check-label" for="form2Example3">
                          Ghi nhớ mật khẩu
                        </label>
                      </div>
                      <a href="#!" class="text-body">Quên mật khẩu</a>
                    </div>
          
                    <div class="text-center text-lg-start mt-4 pt-2">
                      <input id="dangnhap" name="dangnhap" type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Đăng nhập"></input>
                      <p class="small fw-bold mt-2 pt-1 mb-0">bạn chưa có tài khoản? <a href="register.html" class="link-danger">Đăng ký ngay</a></p>
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
