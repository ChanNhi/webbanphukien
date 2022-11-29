<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include('../../config/config.php');
    require('../../../carbon/autoload.php');
    
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $iddonhang = $_GET['iddonhang'];
    $sql_donhang = "SELECT * FROM donhang WHERE id=".$iddonhang."";
    $query_donhang = mysqli_query($mysqli,$sql_donhang);
    $row_donhang = mysqli_fetch_array($query_donhang);
    $tongtien = $row_donhang['tongtien'];
    $soluong = $row_donhang['soluong'];

    if(isset($_POST['capnhatdh'])){
        $donhang = 1;
        $doanhthu = $tongtien;
        $iddonhang = $_GET['iddonhang'];
        $trangthai = $_POST['trangthai'];
        $sql = "UPDATE donhang SET trangthai = '".$trangthai."' WHERE id = ".$iddonhang."";
        $query = mysqli_query($mysqli, $sql);

        $sql_thongke = "SELECT * FROM thongke WHERE ngaydat='".$now."'";
        $query_thongke = mysqli_query($mysqli,$sql_thongke);
        $row_thongke = mysqli_fetch_array($query_thongke);
        $num_thongke = mysqli_num_rows($query_thongke);
        if($row_donhang['trangthai']==2){
            if($num_thongke==0){
                $sql_themthongke = "INSERT INTO thongke(ngaydat, donhang, doanhthu, soluongban) VALUES('".$now."', '".$donhang."', '".$doanhthu."', '".$soluong."')";
                $query_themthongke = mysqli_query($mysqli, $sql_themthongke);
            }
            else{
                $doanhthu1 = $row_thongke['doanhthu']+$tongtien;
                $soluong1 = $row_thongke['soluongban']+$soluong;
                $donhang1 = $row_thongke['donhang']+1;
                $sql_themthongke = "UPDATE thongke SET donhang='".$donhang1."', doanhthu='".$doanhthu1."', soluongban='".$soluong1."' WHERE ngaydat='".$now."'";
                $query_themthongke = mysqli_query($mysqli, $sql_themthongke);
            }
        }

        header('Location:../../index.php?action=chitietdonhang&iddonhang='.$iddonhang.'');
    }
?>