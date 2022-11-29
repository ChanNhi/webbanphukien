<div class="container product-content">
    <div class="container product-sidebar">
        <p>Thương hiệu</p>
        <ul class="product-sidebar-content">
            <?php
                $sql_thuonghieu = "SELECT * FROM thuonghieu WHERE id_danhmucsp = ".$_GET['iddanhmuc']."";
                $query_thuonghieu = mysqli_query($mysqli, $sql_thuonghieu);
                while($row_thuonghieu = mysqli_fetch_array($query_thuonghieu)){
                    
            ?>
            <li style="text-transform: uppercase;">
                <?php
                if(isset($_GET['idthuonghieu'])&&$row_thuonghieu['id']==$_GET['idthuonghieu']){
                ?>
                <a style="color:blue" href="category-<?php echo $_GET['iddanhmuc'] ?>/brand-<?php echo $row_thuonghieu['id'] ?>.html"><?php echo $row_thuonghieu['tenthuonghieu'] ?></a>
                <?php
                }else{
                ?>
                <a href="category-<?php echo $_GET['iddanhmuc'] ?>/brand-<?php echo $row_thuonghieu['id'] ?>.html"><?php echo $row_thuonghieu['tenthuonghieu'] ?></a>
                <?php
                }
                ?>
            </li>
            <?php
                }
            ?>
        </ul>
    </div>
    <?php
        $param = "";
        $paramsort = "";
        $ordercon = "";
        $search ="";
        //tìm kiếm
        if(isset($_GET['timkiem'])){
        $search = isset($_GET['thongtin']) ? $_GET['thongtin'] : "";
        }
        if($search){
            $where = "AND (sanpham.tensp LIKE '%".$search."%')";
            $param .= "thongtin=".$search."/";
            $paramsort = "thongtin=".$search."/";
        }
        //Sắp xếp
        $ordercon = "Expr1 DESC";
        $orderfield =  isset($_GET['field']) ? $_GET['field'] : "";
        $ordersort =  isset($_GET['sort']) ? $_GET['sort'] : "";
        if(!empty($orderfield)&&!empty($ordersort)){
            $ordercon = "sanpham.".$orderfield." ".$ordersort;
            $param .= "field-".$orderfield."/sort-".$ordersort."/";
        }

    ?>
    <div class="container product-right">
        <div class="product-right-main">
            <div class="product-right-main-main">
                <div class="mb-3">
                    <?php
                    if(isset($_GET['iddanhmuc'])&&!isset($_GET['idthuonghieu'])){
                        $iddanhmuc = $_GET['iddanhmuc'];
                    ?>
                    <form action="" method="POST" class="d-flex">
                        <select style="width:200px" class="me-2 form-control" name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <option hidden value="">Sắp xếp</option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort']=='desc'){ ?> selected <?php } ?> value="category/<?php echo $iddanhmuc ?>/field-giasp/<?php echo $paramsort ?>sort-desc.html">Giá cao đến thấp</option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort']=='asc'){ ?> selected <?php } ?> value="category/<?php echo $iddanhmuc ?>/field-giasp/<?php echo $paramsort ?>sort-asc.html">Giá thấp đến cao</option>
                        </select>
                    </form>
                    <?php
                        }else if(isset($_GET['iddanhmuc'])&&isset($_GET['idthuonghieu'])){
                        $iddanhmuc = $_GET['iddanhmuc'];
                        $idthuonghieu = $_GET['idthuonghieu'];
                    ?>
                    <form action="index.php?page=product&iddanhmuc=<?php echo $iddanhmuc ?>&idthuonghieu=<?php echo $idthuonghieu ?>" method="GET" class="d-flex">
                        <select style="width:200px"  class="me-2 form-control"name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <option value="">Sắp xếp</option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort']=='desc'){ ?> selected <?php } ?> value="?page=product&iddanhmuc=<?php echo $iddanhmuc ?>&idthuonghieu=<?php echo $idthuonghieu ?>&field=giasp&sort=desc">Giá cao đến thấp</option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort']=='asc'){ ?> selected <?php } ?> value="?page=product&iddanhmuc=<?php echo $iddanhmuc ?>&idthuonghieu=<?php echo $idthuonghieu ?>&field=giasp&sort=ASC">Giá thấp đến cao</option>
                        </select>
                    </form>
                    <?php
                        }else{
                            $iddanhmuc = "";
                            $idthuonghieu = "";
                        }
                    ?>
                </div>
                <div style="margin-bottom:20px" class="product-right-top">
                <?php
                    $sql_danhmuc = "SELECT * FROM danhmucsp WHERE id = ".$_GET['iddanhmuc']."";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    $row_danhmuc = mysqli_fetch_array($query_danhmuc);
                ?>
                
                <div class="product-right-bottom">
                <h2><a style="color:white" href="category/<?php echo $_GET['iddanhmuc'] ?>.html"><?php echo $row_danhmuc['tendanhmuc'] ?></a></h2>
                    <div class="row">
                        <?php
                            include('func_product.php');
                            while($row_sp = mysqli_fetch_array($query_sp)){
                        ?>
                        <div class="col-md-3 product-right-bottom-product">
                            <div class="product-top">
                                <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_sp['hinhanh'] ?>" alt="" width="200px" height="130px">
                                <div class="overplay">
                                    <a href="product/brand-<?php echo $row_sp['id_thuonghieu'] ?>/<?php echo $row_sp['id'] ?>.html">
                                        <button type="button" class="btn btn-secondary" title="Xem chi tiết"><i class="fa fa-eye"></i></button>
                                    </a>
                                    <a href="index.php?page=home&action=themyeuthich">
                                        <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                                    </a>
                                    <button type="button" class="btn btn-secondary addcart" title="Thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <p><?php echo $row_sp['tensp'] ?></p>
                                <?php
                                    if($row_sp['giagiam']==0){
                                ?>
                                <h5 id="product-price"><?php echo number_format($row_sp['giasp'],0,',','.') ?><sup>đ</sup></h5>
                                <?php
                                    }else{
                                    $giagiam = $row_sp['giasp']-($row_sp['giasp']*$row_sp['giagiam']/100);
                                ?>
                                <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_sp['giasp'],0,',','.') ?><sup>đ</sup></h6>
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
                    <?php include('pagination.php');?>
                </div>
                
            </div>
        </div>
    </div>
</div>