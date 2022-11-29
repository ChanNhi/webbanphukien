<?php
    $sql_sua = "SELECT * FROM sanpham WHERE id = '".$_GET['idsanpham']."' LIMIT 1";
    $query_sua = mysqli_query($mysqli, $sql_sua);
    $row = mysqli_fetch_array($query_sua);

    $sql_danhmuc = "select *from danhmucsp order by id ASC";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

?>
<?php
    $sql_danhmuc = "select *from danhmucsp order by id ASC";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

?>
<div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sửa sản phẩm</h4>
                  <form class="forms-sample" required method="POST" id="formquanly" action="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
                    <div class="form-group">
                      <label for="exampleInputName1">Tên sản phẩm</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên sản phẩm" name="tensp" value="<?php echo $row['tensp'] ?>">
                    </div>
                    <div class="form-group">
                    <img style="width:100px; height:150px; margin:20px auto auto auto" src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" alt="">
                      <label>File upload</label>
                      <input name="hinhanh" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Giá sản phẩm</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Giá sản phẩm" name="gia" value="<?php echo $row['giasp'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Giá giảm (%)</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Giá sản phẩm" name="giagiam" value="<?php echo $row['giagiam'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Mô tả sản phẩm</label>
                      <textarea name="mota" class="form-control" id="exampleTextarea1" rows="4" name="mota" value=""><?php echo $row['mota'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Thông số kỹ thuật</label>
                      <textarea name="thongso" class="form-control" id="exampleTextarea1" rows="4" name="thongso" value=""><?php echo $row['thongso'] ?></textarea>
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
                            <?php
                            $sql_lietke_thuonghieu = "SELECT * FROM thuonghieu";
                            $query_lietke_thuonghieu = mysqli_query($mysqli, $sql_lietke_thuonghieu);
                            while($row_lietke_thuonghieu = mysqli_fetch_array($query_lietke_thuonghieu)){
                            if($row_lietke_thuonghieu['id']==$row['id_thuonghieu']){
                            ?>
                                <option selected value="<?php echo $row_lietke_thuonghieu['id'] ?>"><?php echo $row_lietke_thuonghieu['tenthuonghieu'] ?></option>
                            <?php
                                }else{
                            ?>
                                <option value="<?php echo $row_lietke_thuonghieu['id'] ?>"><?php echo $row_lietke_thuonghieu['tenthuonghieu'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                      </div>

                      <div class="form-group">
                      <label for="exampleSelectGender">Chọn tình trạng</label>
                        <select class="form-control" id="thuonghieu" name="tinhtrang">
                            <option hidden value="">Chọn tình trạng</option>
                            <option hidden value="">---Chọn tình trạng---</option>
                            <?php
                                if($row['tinhtrang']==0){
                            ?>
                            <option selected value="0">Hết hàng</option>
                            <option value="1">Còn hàng</option>
                            <?php
                                }else{
                            ?>
                            <option value="0">Hết hàng</option>
                            <option selected value="1">Còn hàng</option>
                            <?php
                                }
                            ?>  
                        </select>
                      </div>

                      <div class="form-group">
                      <label for="exampleSelectGender">Chọn trạng thái</label>
                        <select class="form-control" id="thuonghieu" name="trangthai">
                            <option hidden value="">Chọn trạng thái</option>
                            <?php
                            if($row['trangthai']==0){
                            ?>
                            <option selected value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                            <?php
                                }else{
                            ?>
                            <option value="0">Ẩn</option>
                            <option selected value="1">Hiện</option>
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