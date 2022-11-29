<?php
    
    include('../../config/config.php');
    $hinhanhsp1 = $_FILES['hinhanh']['name'];
    $hinhanhsp_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanhsp = time().'_'.$hinhanhsp1;
    $id_sanpham = $_GET['idsanpham'];
    //Thêm ảnh mô tả
    if(isset($_POST['them'])){
        $sql_them = "INSERT INTO hinhanhmota(hinhanh, id_sanpham) VALUES('".$hinhanhsp."','".$id_sanpham."')";
        mysqli_query($mysqli, $sql_them);
        move_uploaded_file($hinhanhsp_tmp,'uploads/'.$hinhanhsp); 
        header('Location:../../index.php?action=hinhanhmota&idsanpham='.$id_sanpham.'');
    }
    elseif(isset($_POST['sua'])){
        //sua
        if($hinhanhsp1!=''){
            move_uploaded_file($hinhanhsp_tmp,'uploads/'.$hinhanhsp);
            $sql = "SELECT * FROM hinhanhmota WHERE id = '".$_GET['idanh']."' LIMIT 1";
            $query = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_array($query)){
                unlink('uploads/'.$row['hinhanhmota']);
            }
            $sql_sua = "UPDATE hinhanhmota SET hinhanh='".$hinhanhsp."', id_sanpham='".$id_sanpham."' WHERE id='".$_GET['idanh']."'";
        }
        else{
            $sql_sua = "UPDATE hinhanhmota SET id_sanpham='".$id_sanpham."' WHERE id='".$_GET['idanh']."'";
        }
        mysqli_query($mysqli, $sql_sua);
        header('Location:../../index.php?action=hinhanhmota&idsanpham='.$id_sanpham.'');
    }
    else{
        //xoa
        $id = $_GET['idanh'];
        $sql = "SELECT * FROM hinhanhmota WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanhmota']);
        }
        $sql_xoa = "DELETE FROM hinhanhmota WHERE id = '$id'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=hinhanhmota&idsanpham='.$id_sanpham.'');
    }
?>