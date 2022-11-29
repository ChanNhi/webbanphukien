<?php
    $sql_lietke = "SELECT * FROM thuonghieu WHERE id = '".$_GET['idthuonghieu']."' LIMIT 1";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
    $row = mysqli_fetch_array($query_lietke);
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Sửa thương hiệu</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/quanlythuonghieu/xuly.php?idthuonghieu=<?php echo $_GET['idthuonghieu'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
        <div class="form-group">
            <label for="exampleInputName1">Tên thương hiệu</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên danh mục" name="tenthuonghieu" value="<?php echo $row['tenthuonghieu'] ?>">
        </div>
        <div class="form-group">
            <label for="exampleSelectGender">Chọn thương hiệu</label>
            <select class="form-control" id="thuonghieu" name="id_danhmuc">
                <option hidden value="">Chọn danh mục</option>
                <?php
                    $sql_danhmuc = "SELECT *FROM danhmucsp";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                        if($row['id_danhmucsp']==$row_danhmuc['id']){
                ?>
                    <option selected value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                <?php
                    }else{
                ?>
                    <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" name="sua" class="btn btn-primary me-2">Sửa</button>
        <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>