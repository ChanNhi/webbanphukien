<div class="container rating-content">
    <div class="product-right-bottom">
        <div class="row justify-content-center">
            <?php
                $sql = "SELECT * FROM sanpham WHERE id=".$_GET['idsanpham']."";
                $query_sp = mysqli_query($mysqli,$sql);
                $row_sp = mysqli_fetch_array($query_sp);
            ?>
            <div class="col-md-3 product-right-bottom-product text-center">
                <div class="product-top">
                    <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_sp['hinhanh'] ?>" alt="" width="300px" height="230px">
                </div>
                <div class="product-bottom text-center">
                    <p><?php echo $row_sp['tensp'] ?></p>
                    <h5><?php echo number_format($row_sp['giasp'],0,',','.') ?><sup>đ</sup></h5>
                </div>
            </div>
        </div>
        <?php
            $sql_danhgia = "SELECT * FROM sanpham_danhgia WHERE id_user=".$_SESSION['dangnhap']." AND id_sp=".$_GET['idsanpham']."";
            $query_danhgia = mysqli_query($mysqli,$sql_danhgia);
            $row_danhgia = mysqli_fetch_array($query_danhgia);
            $num_danhgia = mysqli_num_rows($query_danhgia);
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
            <form action="pages/main/function.php?idsanpham=<?php echo $row_sp['id'] ?>" method="POST">
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
                <input type="radio" id="1-star-rating" name="star-rating" value="1">
                <label for="1-star-rating" class="star-rating star">
                <i class="fas fa-star d-inline-block"></i>
                </label>
            </form>
            
        </div>
        
        </div>
    </div>
    </div>
</div>