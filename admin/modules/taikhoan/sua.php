<?php
    //include('../../config/config.php');
    $sql_sua = "select *from admin where id='".$_GET['idtaikhoan']."' limit 1";
    $query_sua = mysqli_query($mysqli, $sql_sua);
    $row = mysqli_fetch_array($query_sua);

?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm tài khoản</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/taikhoan/xuly.php?idtaikhoan=<?php echo $_GET['idtaikhoan'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
        <div class="form-group">
            <label for="exampleInputName1">Họ tên</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Họ tên" name="hoten" value="<?php echo $row['hoten'] ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputName1">Tài khoản</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tài khoản" name="taikhoan" value="<?php echo $row['taikhoan'] ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputName1">Mật khẩu</label>
            <input type="password" class="form-control" id="exampleInputName1" placeholder="Mật khẩu" name="matkhau" value="">
        </div>
        <div class="form-group">
            <label for="exampleSelectGender">Chọn chức vụ</label>
            <select class="form-control" id="thuonghieu" name="chucvu">
                <option hidden value="">---Chức vụ---</option>
                <?php
                if($row['chucvu']==0){
                ?>
                <option selected value="0">Quản lý</option>
                <option value="1">Nhân viên</option>
                <?php
                }else{
                ?>
                <option value="0">Quản lý</option>
                <option selected value="1">Nhân viên</option>
                <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" name="sua" class="btn btn-primary me-2">Sửa</button>
        <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>
