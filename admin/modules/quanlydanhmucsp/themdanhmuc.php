<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm danh mục</h4>
        <form class="forms-sample" required method="POST" id="formquanly" action="modules/quanlydanhmucsp/xuly.php" enctype="multipart/form-data" onsubmit="return kiemtradm();">
        <div class="form-group">
            <label for="exampleInputName1">Tên danh mục</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên danh mục" name="tendanhmuc">
        </div>
        <div class="form-group">
            <label for="exampleSelectGender">Chọn trạng thái</label>
            <select class="form-control" id="thuonghieu" name="trangthai">
                <option hidden value="">Chọn trạng thái</option>
                <option value="0">Không nổi bật</option>
                <option value="1">Nổi bật</option>
            </select>
        </div>
        <button type="submit" name="them" class="btn btn-primary me-2">Thêm</button>
        <button class="btn btn-light">Cancel</button>
        </form>
    </div>
    </div>