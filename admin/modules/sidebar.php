<?php
    if(isset($_GET['action'])&&$_GET['action'] == 'dangxuat'){
        unset($_SESSION['dangnhapad']);
        header('Location: login.php');
    }
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php?query=thongke&action=thongke">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    <a class="nav-link" href="index.php?query=quanlydanhmuc&action=quanlydanhmuc">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Danh mục</span></a>
    <a class="nav-link" href="index.php?query=quanlythuonghieu&action=quanlythuonghieu">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Thương hiệu</span></a>
    <a class="nav-link" href="index.php?query=quanlysanpham&action=quanlysanpham">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Sản phẩm</span></a>
    <a class="nav-link" href="index.php?query=quanlydonhang&action=quanlydonhang">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Đơn hàng</span></a>
    <a class="nav-link" href="index.php?query=quanlybanner&action=quanlybanner">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Banner</span></a>
    <?php
        $sql = "SELECT * FROM admin WHERE id = ".$_SESSION['dangnhapadpk']." LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        if($row['chucvu']==0){
    ?>
    <a class="nav-link" href="index.php?query=quanlydanhmuc&action=quanlytaikhoan">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tài khoản</span></a>
    <?php
        }
    ?>
</li>
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>
