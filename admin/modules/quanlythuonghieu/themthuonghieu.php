<?php
    $sql_lietke = "select *from danhmucsp order by id ASC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm thương hiệu</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/quanlythuonghieu/xuly.php" enctype="multipart/form-data" onsubmit="return kiemtradm();">
        <div class="form-group">
            <label for="exampleInputName1">Tên thương hiệu</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên thương hiệu" name="tenthuonghieu">
        </div>
        <div class="form-group">
            <label for="exampleSelectGender">Chọn danh mục</label>
            <select class="form-control" id="thuonghieu" name="id_danhmuc">
                <option hidden value="">Chọn danh mục</option>
                <?php
                    while($row = mysqli_fetch_array($query_lietke)){
                ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['tendanhmuc'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" name="them" class="btn btn-primary me-2">Thêm</button>
        <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>
