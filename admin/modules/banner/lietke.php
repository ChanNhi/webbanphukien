<?php
    //include('../../config/config.php');

    //Hiển thị banner
    $sql_lietke = "SELECT * FROM banner ORDER BY id DESC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">QUẢN LÝ BANNER</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="index.php?action=thembanner">Thêm</a></h6>
        </div>
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
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th colspan=2>Quản lý</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        <?php
                            $i = 1;
                            while($row = mysqli_fetch_array($query_lietke)){
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><img style="width:40px; height:60px" src="./modules/banner/uploads/<?php echo $row['hinhanh']?>" alt=""></td>
                            <?php
                                if($row['trangthai']==0){
                            ?>
                            <td>Ẩn</td>
                            <?php
                                }else if($row['trangthai']==1){
                            ?>
                            <td>Hiển thị slider</td>
                            <?php
                                }else{
                            ?>
                            <td>Khác</td>
                            <?php
                                }
                            ?>
                            <td><a href="index.php?action=suabanner&idbanner=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a onclick="return del('banner')" class="delete" href="modules/banner/xuly.php?idbanner=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></td>                 
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
                        <div class="col-sm-12 col-md-7">
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
<script>
    function del(name){
        return confirm("Bạn có chắc muốn xóa "+name+"?");
    }
</script>