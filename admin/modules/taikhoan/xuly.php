<?php
    //Thêm tài khoản
    include('../../config/config.php');
    $hoten = $_POST['hoten'];
    $taikhoan = $_POST['taikhoan'];
    $matkhau = md5($_POST['matkhau']);
    $chucvu = $_POST['chucvu'];
    if(isset($_POST['them'])){
        $sql_them = "INSERT INTO admin(hoten, taikhoan, matkhau, chucvu) VALUES('".$hoten."','".$taikhoan."','".$matkhau."','".$chucvu."')";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlytaikhoan');
    }
    elseif(isset($_POST['sua'])){
        //sua
        $sql_sua = "UPDATE admin SET hoten='".$hoten."', taikhoan = '".$taikhoan."', chucvu = '".$chucvu."' WHERE id='".$_GET['idtaikhoan']."'";
        mysqli_query($mysqli, $sql_sua);
        header('Location:../../index.php?action=quanlytaikhoan');
        }
    else
    {
        //xoa
        $sql_admin = "SELECT * FROM admin WHERE id = ".$_GET['idtaikhoan']."";
        $query_admin = mysqli_query($mysqli, $sql_admin);
        $row = mysqli_fetch_array($query_admin);
        $num = mysqli_num_rows($query_admin);

        $sql_admin1 = "SELECT * FROM admin WHERE chucvu = 1 AND id = ".$_GET['idtaikhoan']."";
        $query_admin1 = mysqli_query($mysqli, $sql_admin1);
        $num1 = mysqli_num_rows($query_admin1);
        if($row['chucvu']==0&&$num<=1){
            echo '<script>alert("Không thể xóa");</script>';
            header('Location:../../index.php?action=quanlytaikhoan');
        }
        else
        {
            $id = $_GET['idtaikhoan'];
            $sql_xoa = "delete from admin where id = '$id'";
            mysqli_query($mysqli, $sql_xoa);
            header('Location:../../index.php?action=quanlytaikhoan');
        }
        
    }
?>