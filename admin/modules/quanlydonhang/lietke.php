<?php
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:10;
    $current_page = !empty($_GET['trang'])?$_GET['trang']:1;
    $offset = ($current_page-1)*$item_per_page;

    $sql = "SELECT * FROM donhang ORDER BY id DESC LIMIT ".$item_per_page." OFFSET ".$offset."";
    $query = mysqli_query($mysqli, $sql);
    
    $totalrecord = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM donhang"));
    $totalpage = ceil($totalrecord/$item_per_page);
    
?>
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">QUẢN LÝ ĐƠN HÀNG</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><a href="index.php?action=themdanhmuc">Thêm</a></h6>
    </div> -->
    <div class="card-body">
        <div class="table-responsive">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length">
                            <!-- <label>Show 
                                <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option><option value="25">25</option>
                                    <option value="50">50</option><option value="100">100</option>
                                </select> entries
                            </label> -->
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 text-end">
                        <div id="dataTable_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
                        </div>
                    </div>
                </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:40px">STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt hàng</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        while($row = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['madonhang'] ?></td>
                        <td><?php echo $row['hoten'] ?></td>
                        <td><?php echo $row['sdt'] ?></td>
                        <?php
                            if($row['trangthai']==0){
                        ?>
                        <td>Chưa xác nhận</td>
                        <?php
                            }else if($row['trangthai']==1){
                        ?>
                        <td>Đã xác nhận</td>
                        <?php
                            }else if($row['trangthai']==2){
                        ?>
                        <td>Đã vận chuyển</td>
                        <?php
                            }else if($row['trangthai']==3){
                        ?>
                        <td>Đã giao</td>
                        <?php
                            }else if($row['trangthai']==4){
                        ?>
                        <td>Đã hủy</td>
                        <?php
                            }
                        ?>
                        <td><?php echo $row['ngaydathang'] ?></td>
                        <td><a href="index.php?action=chitietdonhang&iddonhang=<?php echo $row['id'] ?>">Xem</a></td>
                    </tr>
                    <?php
                        $i++;
                        }
                    ?>
                </tbody>
            </table>
            <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7 text-center">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination">
                                <?php
                                if($current_page > 1){
                                    $prve_page = $current_page - 1;
                                ?>
                                <li class="paginate_button page-item previous" id="dataTable_previous">
                                    <a href="index.php?query=quanlydonhang&action=quanlydonhang&per_page=<?php echo $item_per_page ?>&trang=<?php echo $prve_page ?>" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Trước</a>
                                </li>
                                <?php
                                }
                                ?>
                                <?php
                                for($num=1;$num<=$totalpage;$num++){
                                    if($current_page!=$num){
                                        if($num > $current_page - 3 && $num < $current_page + 3){
                                ?>
                                <li class="paginate_button active">
                                    <a href="index.php?query=quanlydonhang&action=quanlydonhang&per_page=<?php echo $item_per_page ?>&trang=<?php echo $num ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $num ?></a>
                                </li>
                                <?php
                                        }
                                    }else{
                                ?>
                                <li class="paginate_button page-item active">
                                    <a href="index.php?query=quanlydonhang&action=quanlydonhang&per_page=<?php echo $item_per_page ?>&trang=<?php echo $num ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $num ?></a>
                                </li>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if($current_page < $totalpage - 1){
                                    $next_page = $current_page + 1;
                                ?>
                                <li class="paginate_button page-item previous" id="dataTable_previous">
                                    <a href="index.php?query=quanlydonhang&action=quanlydonhang&per_page=<?php echo $item_per_page ?>&trang=<?php echo $next_page ?>" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Tiếp</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    function del(name){
        return confirm("Bạn có chắc muốn xóa: "+name+"?");
    }
</script>