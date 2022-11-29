<?php
    $sql = "SELECT * FROM sanpham WHERE id = ".$_GET['idsanpham']." LIMIT 1";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($query);
?>

<div class="product-detail">
        <div class="product-detail-top shadow p-3 mb-5 bg-body rounded">
            <div class="product-detail-top-top">
                <h4><?php echo $row['tensp'] ?></h4>
            </div>
            <div class="product-detail-top-bottom">
                <div class="product-detail-top-bottom-left">
                    <div class="product-detail-img product-detail-big-img">
                        <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" alt="" width="300px" height="300px">
                    </div>
                    <div class="product-detail-img product-detail-small-img">
                        <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" alt="" width="55px" height="50px">
                        <?php
                            $sql_mota = "SELECT *FROM hinhanhmota WHERE id_sanpham = ".$_GET['idsanpham']." LIMIT 3";
                            $query_mota = mysqli_query($mysqli, $sql_mota);
                            while($row_mota = mysqli_fetch_array($query_mota)){
                        ?>
                        <img src="./admin/modules/hinhanhmota/uploads/<?php echo $row_mota['hinhanh'] ?>" alt="" width="55px" height="50px">
                        <?php
                            }
                        ?>
                    </div>
                </div>

                <div class="product-detail-top-bottom-right">
                    
                    <div>
                        <table>
                            <tr>
                                <th><h5>Tình trạng:</h5></th>
                                <?php
                                    if($row['tinhtrang']==0){
                                ?>
                                <th><h5 id="addcart-tinhtrang" style="color:red">Hết hàng</h5></th>
                                <?php
                                    }else{
                                ?>
                                <th><h5 id="addcart-tinhtrang">Còn hàng</h5></th>
                                <?php
                                    }
                                ?>
                            </tr>
                            <tr>
                                <td><h5>Bảo hành:</h5></td>
                                <td><h5>24 tháng</h5></td>
                            </tr>
                            <?php
                            if($row['giagiam']==0){
                            ?>
                            <tr>
                                <td><h5>Giá:</h5></td>
                                <td><h5 style="color:red"><?php echo number_format($row['giasp'],0,',','.') ?><sup>đ</sup></h5></td>
                            </tr>
                            <?php
                            }else{
                                $giagiam = $row['giasp']-($row['giasp']*$row['giagiam']/100);
                            ?>
                            <tr>
                                <td><h5>Giá:</h5></td>
                                <td>
                                    <h5 style="color:red"><?php echo number_format($giagiam,0,',','.') ?>đ<sup class="text-decoration-line-through"><?php echo number_format($row['giasp'],0,',','.') ?>đ</sup>
                                    </h5>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                    <p style="color: red;">Miễn phí giao hàng toàn quốc</p>
                    <div class="add-cart">
                            <form action="pages/main/addcart.php?idsanpham=<?php echo $row['id'] ?>" method="POST" onsubmit="return checkaddcart();">
                                <div class="add-cart-1">
                                    <input hidden name="themyeuthich" id="themyeuthich" type="submit" value="THÊM VÀO YÊU THÍCH">
                                    <label id="themyeuthich" for="themyeuthich"> THÊM VÀO YÊU THÍCH</label>
                                    <input type="submit" name="addcart" hidden id="themgiohang" value="THÊM VÀO GIỎ HÀNG">
                                    <label for="themgiohang"><i class="fa-solid fa-cart-shopping-fast"></i> THÊM VÀO GIỎ HÀNG</label>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-detail-bottom">
            <div class="product-detail-bottom-left shadow p-3 mb-5 bg-body rounded">
                <?php echo $row['mota'] ?>
            </div>
            <div class="product-detail-bottom-right shadow p-3 mb-5 bg-body rounded">
                <h4>Thông số kỹ thuật:</h4>
                <p>Mô tả chi tiết</p>
                <div>
                <?php echo $row['thongso'] ?>
                </div>
            </div>
        </div>
        <!-- Rating -->
        <div class="product-detail-bottom-bottom shadow p-3 mb-5 bg-body rounded">
            <?php
                $sql_danhgia1 = "SELECT * FROM sanpham_danhgia WHERE id_sp = ".$_GET['idsanpham']."";
                $query_danhgia1 = mysqli_query($mysqli,$sql_danhgia1);
                $num_danhgia1 = mysqli_num_rows($query_danhgia1);
                $tongdanhgia = 0;
                if($num_danhgia1>0){
                    $trungbinh = 0;
                    $q = 0;
                    while($row_danhgia1 = mysqli_fetch_array($query_danhgia1)){
                        $tongdanhgia += $row_danhgia1['danhgia'];
                        $q++;
                    }
                    $trungbinh = $tongdanhgia/$q.'/5 <i class="fa fa-star rating-color"></i> - Đánh giá';
                }
                else{
                    $num_danhgia1 = '';
                    $trungbinh="Chưa có đánh giá";
                }
            ?>
            <div>
                <p>Khách hàng đánh giá</p>
                <hr>
                <div class="height-100 container ">
                    <div class="card p-3">
                        <div class="d-flex">
                            <div class="ratings">
                                <h4><?php echo $trungbinh ?></h4>
                            </div>
                            <h4 class="review-count"><?php echo $num_danhgia1 ?></h4>
                        </div>
                        <!-- 5 sao -->
                        <div class="mt-2 d-flex">
                            <?php
                                $sql_5sao = "SELECT * FROM sanpham_danhgia WHERE id_sp = ".$_GET['idsanpham']." AND danhgia = '5.0'";
                                $num_5sao = mysqli_num_rows(mysqli_query($mysqli,$sql_5sao));
                            ?>
                            <h5 class="review-stat me-1">5 <i class="fa fa-star rating-color"></i></h5>
                            <?php
                            if($num_5sao==0){
                            ?>
                            <div class="small-ratings">
                                Chưa có đánh giá
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="small-ratings">
                                <?php echo $num_5sao ?> đánh giá
                            </div>
                            <?php
                            }
                            ?>  
                        </div>  
                        <!-- 4 sao -->
                        <div class="mt-1 d-flex">
                            <?php
                                $sql_4sao = "SELECT * FROM sanpham_danhgia WHERE id_sp = ".$_GET['idsanpham']." AND danhgia = '4.0'";
                                $num_4sao = mysqli_num_rows(mysqli_query($mysqli,$sql_4sao));
                            ?>
                            <h5 class="review-stat me-1">4 <i class="fa fa-star rating-color"></i></h5>
                            <?php
                            if($num_4sao==0){
                            ?>
                            <div class="small-ratings">
                                Chưa có đánh giá
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="small-ratings">
                                <?php echo $num_4sao ?> đánh giá
                            </div>
                            <?php
                            }
                            ?>  
                        </div>
                        <!-- 3 sao -->
                        <div class="mt-1 d-flex">
                            <?php
                                $sql_3sao = "SELECT * FROM sanpham_danhgia WHERE id_sp = ".$_GET['idsanpham']." AND danhgia = '3.0'";
                                $num_3sao = mysqli_num_rows(mysqli_query($mysqli,$sql_3sao));
                            ?>
                            <h5 class="review-stat me-1">3 <i class="fa fa-star rating-color"></i></h5>
                            <?php
                            if($num_3sao==0){
                            ?>
                            <div class="small-ratings">
                                Chưa có đánh giá
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="small-ratings">
                                <?php echo $num_3sao ?> đánh giá
                            </div>
                            <?php
                            }
                            ?>  
                        </div>
                        <!-- 2 sao -->
                        <div class="mt-1 d-flex">
                            <?php
                                $sql_2sao = "SELECT * FROM sanpham_danhgia WHERE id_sp = ".$_GET['idsanpham']." AND danhgia = '2.0'";
                                $num_2sao = mysqli_num_rows(mysqli_query($mysqli,$sql_2sao));
                            ?>
                            <h5 class="review-stat me-1">2 <i class="fa fa-star rating-color"></i></h5>
                            <?php
                            if($num_2sao==0){
                            ?>
                            <div class="small-ratings">
                                Chưa có đánh giá
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="small-ratings">
                                <?php echo $num_2sao ?> đánh giá
                            </div>
                            <?php
                            }
                            ?>  
                        </div>
                        <!-- 1 sao -->
                        <div class="mt-1 d-flex">
                            <?php
                                $sql_1sao = "SELECT * FROM sanpham_danhgia WHERE id_sp = ".$_GET['idsanpham']." AND danhgia = '1.0'";
                                $num_1sao = mysqli_num_rows(mysqli_query($mysqli,$sql_1sao));
                            ?>
                            <h5 class="review-stat me-1">1 <i class="fa fa-star rating-color"></i></h5>
                            <?php
                            if($num_1sao==0){
                            ?>
                            <div class="small-ratings">
                                Chưa có đánh giá
                            </div>
                            <?php
                            }else{
                            ?>
                            <div2 class="small-ratings">
                                <?php echo $num_1sao ?> đánh giá
                            </div2
                            <?php
                            }
                            ?>  
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_SESSION['dangnhap'])){
                $sql_danhgia = "SELECT * FROM sanpham_danhgia WHERE id_user=".$_SESSION['dangnhap']." AND id_sp=".$_GET['idsanpham']."";
                $query_danhgia = mysqli_query($mysqli,$sql_danhgia);
                $row_danhgia = mysqli_fetch_array($query_danhgia);
                $num_danhgia = mysqli_num_rows($query_danhgia);
            ?>
            <div class="container rating-content">
                <div class="product-right-bottom">
                <?php
                    if($num_danhgia>0){
                ?>
                <h4 style="color:red;margin-top:40px" class="text-center">Bạn đã đánh giá <?php echo $row_danhgia['danhgia'] ?> sao</h4>
                <?php
                }
                ?>
            </div>
            <div class="container-wrapper">  
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="row justify-content-center">    
                            <!-- star rating -->
                        <div class="rating-wrapper">
                            <!-- star 5 -->
                            <form action="pages/main/function.php?idthuonghieu=<?php echo $_GET['idthuonghieu'] ?>&idsanpham=<?php echo $_GET['idsanpham'] ?>" method="POST">
                                <input type="submit" id="danhgia"name="danhgia" value="" checked >
                                <label for="danhgia" class="guidanhgia">
                                Đánh giá
                                </label>
                                <input type="radio" id="5-star-rating" name="star-rating" value="5.0">
                                <label for="5-star-rating" class="star-rating">
                                <i class="fas fa-star d-inline-block"></i>
                                </label>
                                
                                <!-- star 4 -->
                                <input type="radio" id="4-star-rating" name="star-rating" value="4.0">
                                <label for="4-star-rating" class="star-rating star">
                                <i class="fas fa-star d-inline-block"></i>
                                </label>
                                
                                <!-- star 3 -->
                                <input type="radio" id="3-star-rating" name="star-rating" value="3.0">
                                <label for="3-star-rating" class="star-rating star">
                                <i class="fas fa-star d-inline-block"></i>
                                </label>
                                
                                <!-- star 2 -->
                                <input type="radio" id="2-star-rating" name="star-rating" value="2.0">
                                <label for="2-star-rating" class="star-rating star">
                                <i class="fas fa-star d-inline-block"></i>
                                </label>
                                
                                <!-- star 1 -->
                                <input type="radio" id="1-star-rating" name="star-rating" value="1.0">
                                <label for="1-star-rating" class="star-rating star">
                                <i class="fas fa-star d-inline-block"></i>
                                </label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }else{
            ?>
             <div class="container-wrapper">  
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="row justify-content-center">  
                        <h4><a href="login.html">ĐĂNG NHẬP ĐỂ ĐÁNH GIÁ</a></h4>
                    </div>
                </div>
            </div> 
            <?php
            }
            ?>
        </div>
</div>          

    <div class="product-detail-related">
        <div class="row product-detail-related-row">
            <h2>Sản phẩm liên quan</h2>
            <?php
                $sql_splq = "SELECT * FROM sanpham WHERE id_thuonghieu = '".$_GET['idthuonghieu']."' AND trangthai = 1 ORDER BY RAND() LIMIT 4";
                $query_splq = mysqli_query($mysqli, $sql_splq);
                while($row_splq = mysqli_fetch_array($query_splq)){
            ?>
            <div class="col-md-3">
                <div class="product-top">
                
                    <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_splq['hinhanh'] ?>" alt="" width="200px" height="130px">
                    <div class="overplay">
                        <a href="product/brand-<?php echo $row_splq['id_thuonghieu'] ?>/<?php echo $row_splq['id'] ?>.html">
                            <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                        </a>
                        <a href="index.php?page=home&action=themyeuthich">
                            <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                        </a>
                        <button type="button" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></button>
                    </div>
                </div>
                <div class="product-bottom text-center">
                    <p><?php echo $row_splq['tensp'] ?></p>
                    <?php
                        if($row_splq['giagiam']==0){
                    ?>
                    <h5 id="product-price"><?php echo number_format($row_splq['giasp'],0,',','.') ?><sup>đ</sup></h5>
                    <?php
                        }else{
                            $giagiam = $row_splq['giasp']-($row_splq['giasp']*$row_splq['giagiam']/100);
                    ?>
                    <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_splq['giasp'],0,',','.') ?><sup>đ</sup></h6>
                    <h5 id="product-price"><?php echo number_format($giagiam,0,',','.') ?><sup>đ</sup></h5>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
                }
            ?>
            
        </div>
    </div>