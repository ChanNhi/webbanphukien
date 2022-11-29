
    <?php
        if(isset($_GET['action'])){
            $t = $_GET['action'];
        }
        else{
            $t = "";
        }
        //Danh mục
        if($t == 'quanlydanhmuc'){
            include('modules/quanlydanhmucsp/quanlydanhmuc.php');
        }
        else if($t == 'themdanhmuc'){
            include('modules/quanlydanhmucsp/themdanhmuc.php');
        }
        else if($t == 'suadanhmuc'){
            include('modules/quanlydanhmucsp/suadanhmuc.php');
        }
        //Thương hiệu
        if($t == 'quanlythuonghieu'){
            include('modules/quanlythuonghieu/quanlythuonghieu.php');
        }
        else if($t == 'themthuonghieu'){
            include('modules/quanlythuonghieu/themthuonghieu.php');
        }
        else if($t == 'suathuonghieu'){
            include('modules/quanlythuonghieu/suathuonghieu.php');
        }
        
        //sản phẩm
        else if($t == 'quanlysanpham'){
            include('modules/quanlysanpham/lietke.php');
        }
        else if($t == 'lietkesanpham'){
            include('modules/quanlysanpham/lietke.php');
        }
        else if($t == 'themsanpham'){
            include('modules/quanlysanpham/them.php');
        }
        else if($t == 'suasanpham'){
            include('modules/quanlysanpham/sua.php');
        }
        else if($t == 'chitietsp'){
            include('modules/quanlysanpham/chitietsp.php');
        }
        //Hình ảnh mô tả
        else if($t == 'hinhanhmota'){
            include('modules/hinhanhmota/lietke.php');
        }
        else if($t == 'themhinhanh'){
            include('modules/hinhanhmota/them.php');
        }
        else if($t == 'suahinhanh'){
            include('modules/hinhanhmota/sua.php');
        }
        //Đơn hàng
        else if($t == 'quanlydonhang'){
            include('modules/quanlydonhang/lietke.php');
        }
        else if($t == 'chitietdonhang'){
            include('modules/quanlydonhang/chitietdonhang.php');
        }
        //Thống kê
        else if($t == 'thongke'){
            include('modules/thongke/dashboard.php');
        }
        //banenr
        else if($t == 'quanlybanner'){
            include('modules/banner/lietke.php');
        }
        else if($t == 'thembanner'){
            include('modules/banner/them.php');
        }
        else if($t == 'suabanner'){
            include('modules/banner/sua.php');
        }
        //tài khoản
        else if($t == 'quanlytaikhoan' && $_SESSION['chucvupk']==0){
            include('modules/taikhoan/lietke.php');
        }
        else if($t == 'themtaikhoan' && $_SESSION['chucvupk']==0){
            include('modules/taikhoan/them.php');
        }
        else if($t == 'suataikhoan' && $_SESSION['chucvupk']==0){
            include('modules/taikhoan/sua.php');
        }
        else if($t == ''){
            include('modules/thongke/dashboard.php');
        }
    ?>
</div>