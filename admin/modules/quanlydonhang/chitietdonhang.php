<?php
    $sql_dh = "SELECT * FROM donhang WHERE id='".$_GET['iddonhang']."'";
    $query_dh = mysqli_query($mysqli, $sql_dh);
    $row_dh = mysqli_fetch_array($query_dh);

    $sql = "SELECT * FROM donhang_chitiet WHERE id_donhang ='".$_GET['iddonhang']."'";
    $query = mysqli_query($mysqli, $sql);
?>
<div class="admin-content-right">
    <div class="admin-content-right-top">
        
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Trạng thái</h4>
            <form class="forms-sample" required id="formquanly" action="./modules/quanlydonhang/xuly.php?iddonhang=<?php echo $_GET['iddonhang'] ?>" method="POST">
                <div class="form-group">
                <!-- <label for="exampleSelectGender">Chọn thương hiệu</label> -->
                <select class="form-control" name="trangthai">
                    <?php
                    if($row_dh['trangthai']==0){
                    ?>
                    <option selected value="0">Chưa xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đã vận chuyển</option>
                    <option value="3">Đã giao</option>
                    <option value="4">Đã hủy</option>
                    <?php
                    }else if($row_dh['trangthai']==1){
                    ?>
                    <option value="0">Chưa xác nhận</option>
                    <option selected value="1">Đã xác nhận</option>
                    <option value="2">Đã vận chuyển</option>
                    <option value="3">Đã giao</option>
                    <option value="4">Đã hủy</option>
                    <?php
                    }else if($row_dh['trangthai']==2){
                    ?>
                    <option value="0">Chưa xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option selected value="2">Đã vận chuyển</option>
                    <option value="3">Đã giao</option>
                    <option value="4">Đã hủy</option>
                    <?php
                    }else if($row_dh['trangthai']==3){
                    ?>
                    <option value="0">Chưa xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đã vận chuyển</option>
                    <option selected value="3">Đã giao</option>
                    <option value="4">Đã hủy</option>
                    <?php
                    }else if($row_dh['trangthai']==3){
                    ?>
                    <option value="0">Chưa xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đã vận chuyển</option>
                    <option value="3">Đã giao</option>
                    <option selected value="4">Đã hủy</option>
                    <?php
                    }
                    ?> 
                </select>
                </div>

                <button type="submit" name="capnhatdh" class="btn btn-primary me-2">Cập nhật</button>
            </form>
        </div>
    </div>
    </div>
    
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><a href="index.php?action=themdanhmuc">Thêm</a></h6>
    </div> -->
    <div class="card-body">
        <div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length">
                            <div class="table-responsive p-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="add">
                                            <td>Họ tên</td>
                                            <td><?php echo $row_dh['hoten'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Mã đơn hàng</td>
                                            <td><?php echo $row_dh['madonhang'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Số điện thoại</td>
                                            <td><?php echo $row_dh['sdt'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Địa chỉ</td>
                                            <td><?php echo $row_dh['diachi'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Ghi chú</td>
                                            <td><?php echo $row_dh['ghichu'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length">
                            <div class="table-responsive p-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="add">
                                            <td>Số lượng sản phẩm</td>
                                            <td><?php echo $row_dh['soluong'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Tổng tiền</td>
                                            <td><?php echo $row_dh['tongtien'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Trạng thái</td>
                                            <?php
                                                if($row_dh['trangthai']==0){
                                            ?>
                                            <td>Chưa xác nhận</td>
                                            <?php
                                                }else if($row_dh['trangthai']==1){
                                            ?>
                                            <td>Đã xác nhận</td>
                                            <?php
                                                }else if($row_dh['trangthai']==2){
                                            ?>
                                            <td>Đã vận chuyển</td>
                                            <?php
                                                }else if($row_dh['trangthai']==3){
                                            ?>
                                            <td>Đã giao</td>
                                            <?php
                                                }else if($row_dh['trangthai']==2){
                                            ?>
                                            <td>Đã hủy</td>
                                            <?php
                                                }
                                            ?>  
                                        </tr>
                                        <tr class="add">
                                            <td>Ngày đặt hàng</td>
                                            <td><?php echo $row_dh['ngaydathang'] ?></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Phương thức thanh toán</td>
                                            <td><?php echo $row_dh['phuongthuctt'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length">
                            <label>Show 
                                <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option><option value="25">25</option>
                                    <option value="50">50</option><option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 text-end">
                        <div id="dataTable_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
                        </div>
                    </div> -->
                </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:40px">STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        while($row = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><img src="./modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" style="width:50px;height:70px"alt=""></td>
                        <td><?php echo $row['tensp'] ?></td>
                        <td><?php echo number_format($row['giasp'],'0',',','.') ?><span>đ</span></td>
                        <td><?php echo $row['soluong'] ?></td>
                    </tr>
                    <?php
                        $i++;
                        }
                    ?>
                </tbody>
            </table>
            <!-- <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7 text-center">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item next disabled" id="dataTable_next">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    function del(name){
        return confirm("Bạn có chắc muốn xóa: "+name+"?");
    }
</script>