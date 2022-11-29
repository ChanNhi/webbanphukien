
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Thêm banner</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/banner/xuly.php" enctype="multipart/form-data" onsubmit="return kiemtradm();">
          <div class="form-group">
            <label>File upload</label>
            <input name="hinhanh" class="form-control" type="file" id="formFile">
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Chọn trạng thái</label>
            <select class="form-control" id="thuonghieu" name="trangthai">
                <option hidden value="">Chọn trạng thái</option>
                <option value="0">Ẩn</option>
                <option value="1">Hiển thị slider</option>
                <option value="2">Khác</option>
            </select>
        </div>
          <button type="submit" name="them" class="btn btn-primary me-2">Thêm</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
</div>
