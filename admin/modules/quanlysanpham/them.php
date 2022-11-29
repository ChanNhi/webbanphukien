<?php
    $sql_danhmuc = "select *from danhmucsp order by id ASC";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Thêm sản phẩm</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/quanlysanpham/xuly.php" enctype="multipart/form-data" onsubmit="return kiemtradm();">
          <div class="form-group">
            <label for="exampleInputName1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên sản phẩm" name="tensp">
          </div>
          <div class="form-group">
            <label>File upload</label>
            <input name="hinhanh" class="form-control" type="file" id="formFile">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Giá sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Giá sản phẩm" name="gia">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Giá giảm (%)</label>
            <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Giá sản phẩm" name="giagiam">
          </div>
          <div class="form-group">
            <label for="exampleTextarea1">Mô tả sản phẩm</label>
            <textarea name="mota" class="form-control" id="exampleTextarea1" rows="4" name="mota"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleTextarea1">Thông số kỹ thuật</label>
            <textarea name="thongso" class="form-control" id="exampleTextarea1" rows="4" name="thongso"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Chọn danh mục</label>
              <select class="form-control" id="danhmuc" name="danhmuc">
                  <option hidden value="">---Chọn danh mục---</option>
              <?php
                  while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
              ?>
                  <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
              <?php
              }
              ?>
              </select>
              
            </div>
            <div class="form-group">
            <label for="exampleSelectGender">Chọn thương hiệu</label>
              <select class="form-control" id="thuonghieu" name="thuonghieu">
                  <option hidden value="">Chọn thượng hiệu</option>
                  
              </select>
            </div>

            <div class="form-group">
            <label for="exampleSelectGender">Chọn tình trạng</label>
              <select class="form-control" id="thuonghieu" name="tinhtrang">
                  <option hidden value="">Chọn tình trạng</option>
                  <option value="0">Hết hàng</option>
                  <option value="1">Còn hàng</option>
              </select>
            </div>

            <div class="form-group">
            <label for="exampleSelectGender">Chọn trạng thái</label>
              <select class="form-control" id="thuonghieu" name="trangthai">
                  <option hidden value="">Chọn trạng thái</option>
                  <option value="0">Ản</option>
                  <option value="1">Hiện</option>
              </select>
            </div>
          <button type="submit" name="them" class="btn btn-primary me-2">Thêm</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#danhmuc").change(function(){
            var danhmuc = $(this).val();
            //alert(danhmuc);
            $.post('modules/quanlysanpham/ajax_them.php', {danhmuc:danhmuc},function(data){
                $("#thuonghieu").html(data);
            });
        });
    });
</script>