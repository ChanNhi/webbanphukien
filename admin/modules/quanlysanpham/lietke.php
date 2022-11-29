<?php
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:10;
    $current_page = !empty($_GET['trang'])?$_GET['trang']:1;
    $offset = ($current_page-1)*$item_per_page;

    $sql_lietke = "SELECT sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.mota, sanpham.thongso, 
                    sanpham.tinhtrang, sanpham.trangthai, sanpham.id_thuonghieu, thuonghieu.tenthuonghieu
                    FROM thuonghieu INNER JOIN sanpham
                    ON thuonghieu.id = sanpham.id_thuonghieu ORDER BY id DESC LIMIT ".$item_per_page." OFFSET ".$offset."";
    // $sql_lietke = "SELECT sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.mota, sanpham.thongso, 
    //                      sanpham.tinhtrang, sanpham.trangthai, sanpham.id_thuonghieu, thuonghieu.tenthuonghieu
    //                      FROM thuonghieu INNER JOIN sanpham
    //                      ON thuonghieu.id = sanpham.id_thuonghieu
    //                      WHERE sanpham.id_thuonghieu = ".$_GET['idthuonghieu']." ORDER BY id DESC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);

    $query_total = mysqli_query($mysqli,"SELECT * FROM sanpham");
    $totalrecord = mysqli_num_rows($query_total);
    $totalpage = ceil($totalrecord/$item_per_page);

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">QUẢN LÝ SẢN PHẨM</h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="index.php?action=themsanpham">Thêm</a></h6>
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
                                <label><input type="search" id="admin-timkiem" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Tình trạng</th>
                                        <th>Trạng thái</th>
                                        <th>Giảm giá</th>
                                        <th>Thương hiệu</th>
                                        <th colspan=2>Quản lý</th>
                                    </tr>
                                </thead>

                                <tbody class="danhsach-sanpham">
                                    <?php
                                        $i = 1;
                                        while($row = mysqli_fetch_array($query_lietke)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><img style="width:40px; height:60px" src="./modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>" alt=""></td>
                                        <td><a class="text-muted" href="index.php?query=hinhanhmota&action=hinhanhmota&idsanpham=<?php echo $row['id'] ?>"><?php echo $row['tensp'] ?></a></td>
                                        <?php
                                        if($row['tinhtrang']==0){
                                        ?>
                                        <td>Hết hàng</td>
                                        <?php
                                        }else{
                                        ?>
                                        <td>Còn hàng</td>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                            if($row['trangthai']==0){
                                        ?>
                                        <td>Ẩn</td>
                                        <?php
                                            }else{
                                        ?>
                                        <td>Hiện</td>
                                        <?php
                                            }
                                        ?>
                                        <td><?php echo $row['giagiam'] ?></td>
                                        <td><?php echo $row['tenthuonghieu'] ?></td>
                                        <td><a href="index.php?action=suasanpham&idsanpham=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
                                        <td><a onclick="return del('<?php echo $row['tensp'];?>')" class="delete" href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></td>                 
                                    </tr>
                                    <?php
                                    $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                <ul class="pagination">
                                    <?php
                                        if($current_page > 1){
                                        $prve_page = $current_page - 1;
                                    ?>
                                    <li class="paginate_button page-item previous" id="dataTable_previous">
                                    <a href="index.php?query=quanlysanpham&action=quanlysanpham&per_page=<?php echo $item_per_page ?>&trang=<?php echo $prve_page ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">Trước</a>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        for($i=1;$i<=$totalpage;$i++){
                                            if($i != $current_page){
                                                if($i > $current_page - 3 && $i < $current_page + 3){
                                            
                                    ?>
                                    <li class="paginate_button">
                                        <a href="index.php?query=quanlysanpham&action=quanlysanpham&per_page=<?php echo $item_per_page ?>&trang=<?php echo $i ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i; ?></a>
                                    </li>
                                    <?php
                                                }
                                        }else{
                                    ?>
                                    <li class="paginate_button page-item active">
                                        <a href="index.php?query=quanlysanpham&action=quanlysanpham&per_page=<?php echo $item_per_page ?>&trang=<?php echo $i ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i; ?></a>
                                    </li>
                                    <?php
                                        }
                                        }
                                    ?>
                                    <?php
                                        if($current_page < $totalpage - 1){
                                        $prve_page = $current_page + 1;
                                    ?>
                                    <li class="paginate_button page-item previous" id="dataTable_previous">
                                    <a href="index.php?query=quanlysanpham&action=quanlysanpham&per_page=<?php echo $item_per_page ?>&trang=<?php echo $prve_page ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">Tiếp</a>
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
</div>
<!-- /.container-fluid -->
<script>
    function del(name){
        return confirm("Bạn có chắc muốn xóa: "+name+"?");
    }
    $(document).ready(function(){
    $('#admin-timkiem').keyup(function(){
        //alert($('#admin-timkiem').val());
        var txt = $('#admin-timkiem').val();
        $.post('modules/quanlysanpham/ajax_timkiem.php', {data:txt},function(data){
                $(".danhsach-sanpham").html(data);
            });
      })
    })
</script>