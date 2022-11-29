<?php
    
    include('../../config/config.php');
    $trangthai = $_POST['trangthai'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh1 = time().'_'.$hinhanh;

    //Thêm banner
    if(isset($_POST['them'])){
        $sql_them = "INSERT INTO banner(hinhanh, trangthai) VALUES('".$hinhanh1."','".$trangthai."')";
        mysqli_query($mysqli, $sql_them);
        move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh1);
        header('Location:../../index.php?action=quanlybanner');
    }
    elseif(isset($_POST['sua'])){
        //sua
        if($hinhanh!=''){
            move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh1);
            $sql = "SELECT * FROM banner WHERE id = '".$_GET['idbanner']."' LIMIT 1";
            $query = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_array($query)){
                unlink('uploads/'.$row['hinhanh']);
            }
            $sql_sua = "UPDATE banner SET hinhanh='".$hinhanh1."', trangthai='".$trangthai."' WHERE id='".$_GET['idbanner']."'";
        }
        else{
            $sql_sua = "UPDATE banner SET trangthai='".$trangthai."' WHERE id='".$_GET['idbanner']."'";
        }
        mysqli_query($mysqli, $sql_sua);
        header('Location:../../index.php?action=quanlybanner');
    }
    else{
        //xoa
        $id = $_GET['idbanner'];
        $sql = "SELECT * FROM banner WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanh']);
        }
        $sql_xoa = "DELETE FROM banner WHERE id = '$id'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlybanner');
    }
?>