<?php
if(isset($_SESSION['dangnhap'])){
    $tongtien=0;
    $tongsp=0;
    $i=0;
    $soluong = 0;
    $thanhtoan = 0;
    $thanhtien = 0;
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:5;
    $current_page = !empty($_GET['trang'])?$_GET['trang']:1;
    $offset = ($current_page-1)*$item_per_page;

    $sql_donhang = "SELECT * FROM donhang WHERE id_user = ".$_SESSION['dangnhap']." ORDER BY id DESC LIMIT ".$item_per_page." OFFSET ".$offset."";
    $query_donhang = mysqli_query($mysqli, $sql_donhang);
    $num_donhang = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM donhang WHERE id_user = ".$_SESSION['dangnhap'].""));

    $totalpage = ceil($num_donhang/$item_per_page);
?>
<?php
    if($num_donhang>0){
?>
<div class="orderlist">
    <div class="container orderlist-content shadow p-3 mb-5 bg-body rounded">
        <h4>ĐƠN HÀNG CỦA TÔI</h4>
        <table>
            <tr>
                <th>STT</th>
                <th>Ngày đặt hàng</th>
                <th>Sản phẩm</th>
                <th>tổng tiền</th>
                <th>Trạng thái</th>
                <th colspan=2>Thao tác</th>
            </tr>
            <?php
                $i=1;
                while($row_donhang = mysqli_fetch_array($query_donhang)){
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row_donhang['ngaydathang'] ?></td>
                <td>
                    <!-- <div class="slider">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/slider1.jpg" class="d-block w-100 img-slider" alt="" width="5px" height="20px">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/slider4.png" class="d-block w-100 img-slider" alt="" width="5px" height="20px">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/slider5.jpg" class="d-block w-100 img-slider" alt="" width="5px" height="20px">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div> -->
                    <?php echo $row_donhang['soluong'] ?> sản phẩm</td>
                <td><?php echo number_format($row_donhang['tongtien'],'0',',','.') ?><span>đ</span></td>
                <?php
                    if($row_donhang['trangthai']==0){
                ?>
                <td>Chưa xác nhận</td>
                <?php
                    }else
                    if($row_donhang['trangthai']==1){
                        ?>
                        <td>Đã xác nhận</td>
                <?php
                    }else
                    if($row_donhang['trangthai']==2){
                        ?>
                        <td>Đã vận chuyển</td>
                <?php
                    }else
                    if($row_donhang['trangthai']==3){
                        ?>
                        <td>Đã giao</td>
                <?php
                    }else
                    if($row_donhang['trangthai']==4){
                        ?>
                        <td>Đã hủy</td>
                <?php
                    
                    }
                ?>
                <td style="font-size: 25px;"><a href="order/user-<?php echo $_SESSION['dangnhap'] ?>/<?php echo $row_donhang['id'] ?>.html"><i class="fas fa-eye"></i></a></td>
                <td style="font-size: 25px;"><a onclick="return del('đơn hàng')" href="index.php?query=xoadh&user=<?php echo $row_donhang['id_user'] ?>&iddonhang=<?php echo $row_donhang['id'] ?>"><i class="fas fa-trash"></i></a></td>
            </tr>
            <?php
                $i++;
                }
            ?>
        </table>
        <table style="border:none;height:20px">
            <tr>
                <td style="border:none;height:20px" colspan="6" class="">
                    <nav aria-label="...">
                        <ul class="pagination" style="float:right">
                            <?php
                                if($current_page > 1){
                                    $prve_page = $current_page - 1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="orderlist/trang-<?php echo $prve_page ?>.html" tabindex="-1" aria-disabled="true">Trước</a>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                            for($num=1;$num<=$totalpage;$num++){
                                if($num!=$current_page){
                                    if($num > $current_page - 3 && $num < $current_page + 3){
                            ?>
                            <li class="page-item"><a class="page-link" href="orderlist/trang-<?php echo $num ?>.html"><?php echo $num ?></a></li>
                            <?php
                                    }
                            }else{
                            ?>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="orderlist/trang-<?php echo $num ?>.html"><?php echo $num ?></a></li>
                            <?php
                                }
                            }
                            ?>
                            <?php
                            if($current_page < $totalpage - 1){
                                $next_page = $current_page + 1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="orderlist/trang-<?php echo $next_page ?>.html" tabindex="-1" aria-disabled="true">Tiếp</a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                </td>
            </tr>
        </table>
    </div>
</div>
    <?php
    }else{
    ?>
    <div>
        <div style="background-color:white;border:none" class="container orderlist-content">
            <h4>BẠN CHƯA CÓ ĐƠN HÀNG NÀO</h4>
        </div>
    </div>
    <?php
    }
    ?>

<?php
}else{
    exit;
}
?>
<script>
    function del(name){
        return confirm("Bạn có chắc muốn xóa "+name+"?");
    }
</script>