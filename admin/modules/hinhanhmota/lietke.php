<?php
    //include('../../config/config.php');

    //Hiển thị sản phẩm
    $sql_lietke = "SELECT sanpham.tensp, hinhanhmota.hinhanh, hinhanhmota.id, hinhanhmota.id_sanpham
    FROM   hinhanhmota INNER JOIN
                 sanpham ON hinhanhmota.id_sanpham = sanpham.id
    WHERE (hinhanhmota.id_sanpham = '".$_GET['idsanpham']."')
    ORDER BY hinhanhmota.id DESC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">QUẢN LÝ SẢN PHẨM</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><a href="index.php?action=themhinhanh&idsanpham=<?php echo $_GET['idsanpham'] ?>">Thêm</a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th colspan=2>Quản lý</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $i = 1;
                                    while($row = mysqli_fetch_array($query_lietke)){
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $row['tensp']?></td>
                                    <td><img style="width:40px; height:60px" src="./modules/hinhanhmota/uploads/<?php echo $row['hinhanh']?>" alt=""></td>
                                    <td><a href="index.php?query=hinhanhmota&action=suahinhanh&idsanpham=<?php echo $row['id_sanpham'] ?>&idanh=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
                                    <td><a onclick="return del('hình ảnh')" class="delete" href="modules/hinhanhmota/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>&idanh=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></td>                 
                                </tr>
                                <?php
                                $i++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
</div>
<!-- /.container-fluid -->

<script>
    function del(name){
        return confirm("Bạn có chắc muốn xóa "+name+"?");
    }
</script>