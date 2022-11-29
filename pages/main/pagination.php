<?php
//Tồn tài idthuonhieu
if(isset($_GET['idthuonghieu'])){
?>
<div class="product-right-main-bottom">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php

            if($current_page > 1){
                $prve_page = $current_page - 1;
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&idthuonghieu=<?php echo $_GET['idthuonghieu'] ?>&<?php echo $param ?>trang=<?php echo $prve_page ?>">Trước</a></li>
            <?php
            }
            ?>

            <?php
                for($num =1 ; $num <= $totalpage; $num++){
                    if($num != $current_page){
                        if($num > $current_page - 3 && $num < $current_page + 3){
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&idthuonghieu=<?php echo $_GET['idthuonghieu'] ?>&<?php echo $param ?>trang=<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php
                    }
                }else{
            ?>
            <li class="page-item"><a style="background-color:#0062cc;color:white" class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&idthuonghieu=<?php echo $_GET['idthuonghieu'] ?>&<?php echo $param ?>trang=<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php
                }
            }
            ?>
            <?php
            if($current_page < $totalpage - 1){
                $next_page = $current_page + 1;
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&idthuonghieu=<?php echo $_GET['idthuonghieu'] ?>&<?php echo $param ?>trang=<?php echo $next_page ?>">Tiếp</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</div>
<?php
//Không Tồn tài idthuonhieu
}else{
?>
<!-- <div class="product-right-main-bottom">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
        <?php
            if($current_page > 1){
                $prve_page = $current_page - 1;
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&<?php echo $param ?>&trang=<?php echo $prve_page ?>">Trước</a></li>
            <?php
            }
            ?>

            <?php
                for($num = 1 ; $num <= $totalpage; $num++){
                    if($num != $current_page){
                        if($num > $current_page - 3 && $num < $current_page + 3){
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&<?php echo $param ?>trang=<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php
                        }
                }else{
            ?>
            <li class="page-item">
                <a style="background-color:#0062cc;color:white" class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&<?php echo $param ?>trang=<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php
                }
            }
            ?>
            
            
            <?php
            if($current_page < $totalpage - 1){
                $next_page = $current_page + 1;
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=product&iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>&<?php echo $param ?>trang=<?php echo $next_page ?>">Tiếp</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</div> -->
<div class="product-right-main-bottom">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
        <?php
            if($current_page > 1){
                $prve_page = $current_page - 1;
            ?>
            <li class="page-item"><a class="page-link" href="category/<?php echo $_GET['iddanhmuc'] ?>/<?php echo $param ?>trang-<?php echo $prve_page ?>.html">Trước</a></li>
            <?php
            }
            ?>

            <?php
                for($num = 1 ; $num <= $totalpage; $num++){
                    if($num != $current_page){
                        if($num > $current_page - 3 && $num < $current_page + 3){
            ?>
            <li class="page-item"><a class="page-link" href="category/<?php echo $_GET['iddanhmuc'] ?>/<?php echo $param ?>trang-<?php echo $num ?>.html"><?php echo $num ?></a></li>
            <?php
                        }
                }else{
            ?>
            <li class="page-item">
                <a style="background-color:#0062cc;color:white" class="page-link" href="category/<?php echo $_GET['iddanhmuc'] ?>/<?php echo $param ?>trang-<?php echo $num ?>.html"><?php echo $num ?></a></li>
            <?php
                }
            }
            ?>
            
            
            <?php
            if($current_page < $totalpage - 1){
                $next_page = $current_page + 1;
            ?>
            <li class="page-item"><a class="page-link" href="category/<?php echo $_GET['iddanhmuc'] ?>/<?php echo $param ?>trang-<?php echo $next_page ?>.html">Tiếp</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</div>
<?php
}
?>