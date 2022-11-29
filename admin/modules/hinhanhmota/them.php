<?php
    $sql = "SELECT *FROM sanpham WHERE id = ".$_GET['idsanpham']."";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Thêm ảnh mô tả</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/hinhanhmota/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
          <div class="form-group">
            <label for="exampleInputName1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên sản phẩm" name="tensp" value="<?php echo $row['tensp'] ?>">
          </div>
          <div class="form-group">
            <label>File upload</label>
            <input name="hinhanh" class="form-control" type="file" id="formFile">
          </div>
          <button type="submit" name="them" class="btn btn-primary me-2">Thêm</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
</div>
