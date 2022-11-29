
<?php
    $sql_sua = "SELECT sanpham.tensp, hinhanhmota.hinhanh, hinhanhmota.id, hinhanhmota.id_sanpham
    FROM   hinhanhmota INNER JOIN
                 sanpham ON hinhanhmota.id_sanpham = sanpham.id
    WHERE (hinhanhmota.id = '".$_GET['idanh']."' AND hinhanhmota.id_sanpham = '".$_GET['idsanpham']."') LIMIT 1";
    $query_sua = mysqli_query($mysqli, $sql_sua);
    $row = mysqli_fetch_array($query_sua);
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Sửa ảnh mô tả</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/hinhanhmota/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>&idanh=<?php echo $_GET['idanh'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
          <div class="form-group">
            <label for="exampleInputName1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên sản phẩm" name="tensp" value="<?php echo $row['tensp'] ?>">
          </div>
          <div class="form-group">
            <img style="width:100px; height:150px; margin:20px auto auto auto" src="modules/hinhanhmota/uploads/<?php echo $row['hinhanh'] ?>" alt="">
            <label>File upload</label>
            <input name="hinhanh" class="form-control" type="file" id="formFile">
          </div>
          <button type="submit" name="sua" class="btn btn-primary me-2">Sửa</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
</div>