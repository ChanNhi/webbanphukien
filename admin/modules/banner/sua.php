<?php
    $sql_lietke = "SELECT * FROM banner WHERE id='".$_GET['idbanner']."' ORDER BY id DESC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
    $row = mysqli_fetch_array($query_lietke)
?>


<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Sửa banner</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/banner/xuly.php?idbanner=<?php echo $row['id'] ?>" enctype="multipart/form-data" onsubmit="return kiemtradm();">
          <div class="form-group">
            <label>File upload</label>
            <input name="hinhanh" class="form-control" type="file" id="formFile">
            <img style="width:100px; height:150px; margin:20px auto auto auto" src="modules/banner/uploads/<?php echo $row['hinhanh'] ?>" alt="">
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Chọn trạng thái</label>
            <select class="form-control" id="thuonghieu" name="trangthai">
                <option hidden value="">Chọn trạng thái</option>
                <?php
                    if($row['trangthai']==0){
                ?>
                <option selected value="0">Ẩn</option>
                <option value="1">Hiển thị slider</option>
                <option value="2">Khác</option>
                <?php
                    }else if($row['trangthai']==1){
                ?>
                <option value="0">Ẩn</option>
                <option selected value="1">Hiển thị slider</option>
                <option value="2">Khác</option>
                <?php
                    }else{
                ?>
                <option value="0">Ẩn</option>
                <option value="1">Hiển thị slider</option>
                <option selected value="2">Khác</option>
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
