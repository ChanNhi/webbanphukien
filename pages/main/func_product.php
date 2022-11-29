<?php
    //Phân trang
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:12;
    $current_page = !empty($_GET['trang'])?$_GET['trang']:1;
    $offset = ($current_page-1)*$item_per_page;

    //tồn tài $search
    if($search){
        if(isset($_GET['idthuonghieu'])){
            $sql_sp = "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
        FROM     danhmucsp INNER JOIN
                        thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                        sanpham ON thuonghieu.id = sanpham.id_thuonghieu
        WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) AND (sanpham.id_thuonghieu = ".$_GET['idthuonghieu'].") 
        ".$where."
        ORDER BY ".$ordercon."
        LIMIT ".$item_per_page." OFFSET ".$offset."";

        //Phan trang
            $totalrecord = mysqli_query($mysqli, "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
        FROM     danhmucsp INNER JOIN
                        thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                        sanpham ON thuonghieu.id = sanpham.id_thuonghieu
        WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) AND (sanpham.id_thuonghieu = ".$_GET['idthuonghieu'].") 
        ".$where."
        ORDER BY Expr1 DESC");
        }
        //Không có thương hiệu
        else{
            $sql_sp = "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
            FROM     danhmucsp INNER JOIN
                            thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                            sanpham ON thuonghieu.id = sanpham.id_thuonghieu
            WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) 
            ".$where."
            ORDER BY ".$ordercon."
            LIMIT ".$item_per_page." OFFSET ".$offset."";

            //Phan trang
            $totalrecord = mysqli_query($mysqli, "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
            FROM     danhmucsp INNER JOIN
                            thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                            sanpham ON thuonghieu.id = sanpham.id_thuonghieu
            WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) 
            ".$where."
            ORDER BY Expr1 DESC");
        }
    //Không tồn tài $search
    }else{
            if(isset($_GET['idthuonghieu'])){
                $sql_sp = "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
            FROM     danhmucsp INNER JOIN
                            thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                            sanpham ON thuonghieu.id = sanpham.id_thuonghieu
            WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) AND (sanpham.id_thuonghieu = ".$_GET['idthuonghieu'].") 
            ORDER BY ".$ordercon."
            LIMIT ".$item_per_page." OFFSET ".$offset."";

            //Phan trang
                $totalrecord = mysqli_query($mysqli, "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
            FROM     danhmucsp INNER JOIN
                            thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                            sanpham ON thuonghieu.id = sanpham.id_thuonghieu
            WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) AND (sanpham.id_thuonghieu = ".$_GET['idthuonghieu'].") 
            ORDER BY Expr1 DESC");
            }
            //Không cso thương hiêụ
            else{
                $sql_sp = "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
                FROM     danhmucsp INNER JOIN
                                thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                                sanpham ON thuonghieu.id = sanpham.id_thuonghieu
                WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) 
                ORDER BY ".$ordercon."
                LIMIT ".$item_per_page." OFFSET ".$offset."";

                //Phan trang
                $totalrecord = mysqli_query($mysqli, "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
                FROM     danhmucsp INNER JOIN
                                thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                                sanpham ON thuonghieu.id = sanpham.id_thuonghieu
                WHERE  (danhmucsp.id = ".$_GET['iddanhmuc'].") AND (sanpham.trangthai = 1) 
                ORDER BY Expr1 DESC");
            }
        }
    
    
    $totalrecord = mysqli_num_rows($totalrecord);
    $totalpage = ceil($totalrecord/$item_per_page);

    $query_sp = mysqli_query($mysqli, $sql_sp);
    // echo $num = mysqli_num_rows($query_sp);exit;
    
?>