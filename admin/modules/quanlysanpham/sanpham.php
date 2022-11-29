<div class="admin-content-right">
    <div class="container center admin-content-right-sanpham">
        <h4 class="text-center">QUẢN LÝ SẢN PHẨM</h4>
        <div class="container">
            <a href="index.php?query=quanlysanpham&action=themsanpham">Thêm</a>
            <div class="admin-content-right-sanpham-row">
                <?php
                    $sql_dm = "SELECT * FROM danhmucsp";
                    $query_dm = mysqli_query($mysqli, $sql_dm);
                    $i = 1;
                    while($row_dm = mysqli_fetch_array($query_dm)){  
                ?>
                <div class="row admin-content-right-sanpham-row-row">
                    <p>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo $i?>" aria-expanded="false" aria-controls="collapseExample">
                            <?php echo $row_dm['tendanhmuc'] ?>
                        </button>
                    </p>
                    <?php
                    $sql_th = "SELECT * FROM thuonghieu WHERE id_danhmucsp = ".$row_dm['id']."";
                    $query_th = mysqli_query($mysqli, $sql_th);
                    while($row_th = mysqli_fetch_array($query_th)){
                    ?>
                    <div class="collapse" id="collapseExample<?php echo $i?>">
                        <a href="index.php?action=lietkesanpham&iddanhmuc=<?php echo $row_th['id_danhmucsp'] ?>&idthuonghieu=<?php echo $row_th['id'] ?>" class="card card-body">
                            <?php echo $row_th['tenthuonghieu']?>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                $i++;
                    }
                ?>
            </div>
        </div>
    </div> 
</div>