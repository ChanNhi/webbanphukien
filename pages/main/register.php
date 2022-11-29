<div class="login shadow p-3 mb-5 bg-body rounded">
        <section class="vh-100">
            <div class="container-fluid h-custom">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="images/login.jpg" class="img-fluid"
                    alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form action="index.php?page=register" method="POST" onsubmit="return kiemtradk();">

                    <!-- name input -->
                    <div class="form-outline mb-4">
                      <input required autocomplete="off" name="hoten" type="text" id="form3Example3 hoten" class="form-control form-control-lg"
                        placeholder="Vui lòng nhập họ tên" />
                      <label class="form-label" for="form3Example3">Họ tên</label>
                    </div>
                    <!-- username input -->
                    <div class="form-outline mb-4">
                      <input required autocomplete="off" name="taikhoan" type="text" id="form3Example3 taikhoan" class="form-control form-control-lg"
                        placeholder="Vui lòng nhập tên tài khoản" />
                      <label class="form-label" for="form3Example3">Tên tài khoản</label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                      <input required name="matkhau" type="password" id="form3Example4 matkhau" class="form-control form-control-lg"
                        placeholder="Vui lòng nhập mật khẩu" />
                      <label class="form-label" for="form3Example4">Mật khẩu</label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                      <input required name="matkhau1" type="password" id="form3Example4 matkhau1" class="form-control form-control-lg"
                        placeholder="Vui lòng nhập lại mật khẩu" />
                      <label class="form-label" for="form3Example4">Nhập lại mật khẩu</label>
                    </div>
          
                    <div class="text-center text-lg-start mt-4 pt-2">
                      <input required id="dangky" name="dangky" type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Đăng ký"></input>
                    </div>
          
                  </form>
                </div>
              </div>
            </div>
            
          </section>

    </div>