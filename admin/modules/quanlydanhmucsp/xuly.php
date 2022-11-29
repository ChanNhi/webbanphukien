<?php
    //Thêm danh mục
    include('../../config/config.php');
    $tendanhmuc = $_POST['tendanhmuc'];
    $trangthai = $_POST['trangthai'];
    if(isset($_POST['them'])){
        $sql_them = "INSERT INTO danhmucsp(tendanhmuc, trangthai) VALUES('".$tendanhmuc."','".$trangthai."')";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlydanhmuc');
    }
    elseif(isset($_POST['sua'])){
        //sua
        $sql_them = "update danhmucsp set tendanhmuc='".$tendanhmuc."', trangthai = '".$trangthai."' where id='".$_GET['iddanhmuc']."'";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlydanhmuc');
    }
    else{
        //xoa
        $id = $_GET['iddanhmuc'];
        $sql_xoa = "delete from danhmucsp where id = '$id'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlydanhmuc');
    }
?>