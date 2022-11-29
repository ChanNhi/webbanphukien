<?php
    include('../../config/config.php');
    
    //thêm
    if(isset($_POST['them'])){
        $tenthuonghieu = $_POST['tenthuonghieu'];
        $id_danhmuc = $_POST['id_danhmuc'];
        $sql_them = "INSERT INTO thuonghieu(tenthuonghieu , id_danhmucsp) VALUES('".$tenthuonghieu."', '".$id_danhmuc."')";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlythuonghieu');
    }
    //sua
    if(isset($_POST['sua'])){
        $tenthuonghieu = $_POST['tenthuonghieu'];
        $id_danhmuc = $_POST['id_danhmuc'];
        $id = $_GET['idthuonghieu'];
        $sql_sua = "UPDATE thuonghieu SET tenthuonghieu='".$tenthuonghieu."', id_danhmucsp='".$id_danhmuc."' WHERE id='$id'";
        mysqli_query($mysqli, $sql_sua);
        header('Location:../../index.php?action=quanlythuonghieu');
    }
    else{
        $id = $_GET['idthuonghieu'];
        $sql_xoa = "DELETE FROM thuonghieu WHERE id='$id'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlythuonghieu');
    }
?>