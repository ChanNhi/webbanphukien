<?php
    // include('../../config/config.php');
    $sql_dm = "select *from danhmucsp order by id DESC";
    $query_dm = mysqli_query($mysqli, $sql_dm);

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">QUẢN LÝ THƯƠNG HIỆU</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="index.php?action=themthuonghieu">Thêm</a></h6>
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
                <?php
                    $i = 1;
                    while($row_dm = mysqli_fetch_array($query_dm)){
                ?>
                <!-- Danh mục -->
                    <div class="mb-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo $i?>" aria-expanded="false" aria-controls="collapseExample">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row_dm['tendanhmuc'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="collapse" id="collapseExample<?php echo $i?>">
                        ầdfdfdsgsfgf
                    </div> -->
                    <!-- Thương hiệu -->
                    <div class="collapse" id="collapseExample<?php echo $i?>">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên thương hiệu</th>
                                <td colspan="2">Quản lý</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_th = "SELECT * FROM thuonghieu WHERE id_danhmucsp = ".$row_dm['id']."";
                                $query_th = mysqli_query($mysqli,$sql_th);
                                while($row_th = mysqli_fetch_array($query_th)){
                            ?>
                            <tr>
                                <td><?php echo $row_th['tenthuonghieu'] ?></td>
                                <td><a href="index.php?action=suathuonghieu&idthuonghieu=<?php echo $row_th['id'] ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a onclick="return del('<?php echo $row_th['tenthuonghieu'];?>')" class="delete" href="modules/quanlythuonghieu/xuly.php?idthuonghieu=<?php echo $row_th['id'] ?>"><i class="fas fa-trash"></i></a></td>
                            </tr>

                            <?php
                                $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                $i++;
                    }
                ?>
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