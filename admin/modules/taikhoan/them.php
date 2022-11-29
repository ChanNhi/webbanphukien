<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm tài khoản</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/taikhoan/xuly.php" enctype="multipart/form-data" onsubmit="return kiemtradm();">
        <div class="form-group">
            <label for="exampleInputName1">Họ tên</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Họ tên" name="hoten">
        </div>
        <div class="form-group">
            <label for="exampleInputName1">Tài khoản</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tài khoản" name="taikhoan">
        </div>
        <div class="form-group">
            <label for="exampleInputName1">Mật khẩu</label>
            <input type="password" class="form-control" id="exampleInputName1" placeholder="Mật khẩu" name="matkhau">
        </div>
        <div class="form-group">
            <label for="exampleSelectGender">Chọn chức vụ</label>
            <select class="form-control" id="thuonghieu" name="chucvu">
                <option hidden value="">---Chức vụ---</option>
                <option value="0">Quản lý</option>
                <option value="1">Nhân viên</option>
            </select>
        </div>
        <button type="submit" name="them" class="btn btn-primary me-2">Thêm</button>
        <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>
