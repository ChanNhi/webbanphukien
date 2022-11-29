<?php
    //include('../../config/config.php');
    $sql_sua = "select *from danhmucsp where id='".$_GET['iddanhmuc']."' limit 1";
    $query_sua = mysqli_query($mysqli, $sql_sua);
    $row = mysqli_fetch_array($query_sua);
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Sửa danh mục</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
        <div class="form-group">
            <label for="exampleInputName1">Tên danh mục</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên danh mục" name="tendanhmuc" value="<?php echo $row['tendanhmuc'] ?>">
        </div>
        <div class="form-group">
            <label for="exampleSelectGender">Chọn trạng thái</label>
            <select class="form-control" id="thuonghieu" name="trangthai">
                <option hidden value="">Chọn trạng thái</option>
                <?php
                    if($row['trangthai']==1){
                ?>
                <option value="0">Không nổi bật</option>
                <option selected value="1">Nổi bật</option>
                <?php
                    }else{
                ?>
                <option selected value="0">Không nổi bật</option>
                <option value="1">Nổi bật</option>
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