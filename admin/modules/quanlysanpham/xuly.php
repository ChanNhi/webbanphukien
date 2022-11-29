<?php

    //Thêm sản phẩm
    include('../../config/config.php');
    $tensp = $_POST['tensp'];

    $hinhanhsp1 = $_FILES['hinhanh']['name'];
    $hinhanhsp_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanhsp = time().'_'.$hinhanhsp1;
    

    $giasp = $_POST['gia'];
    $giagiam = $_POST['giagiam'];
    $motasp = $_POST['mota'];
    $thongsosp = $_POST['thongso'];
    $idthuonghieu = $_POST['thuonghieu'];
    $tinhtrangsp = $_POST['tinhtrang'];
    $trangthaisp = $_POST['trangthai'];
    //Thêm
    if(isset($_POST['them'])){
        $sql_them = "INSERT INTO sanpham(tensp, hinhanh, giasp, giagiam, mota, thongso, tinhtrang, trangthai, id_thuonghieu) 
                    VALUES('".$tensp."','".$hinhanhsp."','".$giasp."','".$giagiam."','".$motasp."','".$thongsosp."','".$tinhtrangsp."','".$trangthaisp."','".$idthuonghieu."')"; 
        mysqli_query($mysqli, $sql_them);
        move_uploaded_file($hinhanhsp_tmp,'uploads/'.$hinhanhsp);
        header('Location:../../index.php?action=quanlysanpham');
    }   
    elseif(isset($_POST['sua'])){
        //sua
        if($hinhanhsp1!=''){
            move_uploaded_file($hinhanhsp_tmp,'uploads/'.$hinhanhsp);
            $sql = "SELECT * FROM sanpham WHERE id = '".$_GET['idsanpham']."' LIMIT 1";
            $query = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_array($query)){
                unlink('uploads/'.$row['hinhanh']);
            }
            $sql_sua = "UPDATE sanpham SET tensp='".$tensp."', hinhanh='".$hinhanhsp."',giasp='".$giasp."',giagiam='".$giagiam."',mota='".$motasp."', thongso='".$thongsosp."',tinhtrang='".$tinhtrangsp."',trangthai='".$trangthaisp."',id_thuonghieu='".$idthuonghieu."' WHERE id = '".$_GET['idsanpham']."'";
        }
        else{
            $sql_sua = "UPDATE sanpham SET tensp='".$tensp."',giasp='".$giasp."',giagiam='".$giagiam."',mota='".$motasp."',thongso='".$thongsosp."',tinhtrang='".$tinhtrangsp."',trangthai='".$trangthaisp."',id_thuonghieu='".$idthuonghieu."' WHERE id = '".$_GET['idsanpham']."'";
        }
        mysqli_query($mysqli, $sql_sua);
        header('Location:../../index.php?action=quanlysanpham');
    }

    else{
        //xoa
        $id = $_GET['idsanpham'];
        $sql = "SELECT * FROM sanpham WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanh']);
        }
        $sql_xoa = "delete from sanpham where id = '$id'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlysanpham');
    }
?>