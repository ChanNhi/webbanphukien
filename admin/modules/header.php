<?php
    require('../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $date = getdate();
    $date_thu = $date['weekday'];
    $date_ngay = $date['mday'];
    $date_thang = $date['mon'];
    $date_nam = $date['year'];
    $date_gio = $date['hours'];
    $date_phut = $date['minutes'];
    $date_giay = $date['seconds'];
    $ngay = $date_nam."-".$date_thang."-".$date_ngay;
    $sql_dh = "SELECT * FROM donhang WHERE trangthai = 0 ORDER BY ngaydathang DESC";
    $query_dh = mysqli_query($mysqli,$sql_dh);
    
    // echo $row_dh['ngaydathang']."<br>";
    // echo $now."<br>";
    $num_dh = mysqli_num_rows($query_dh);
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <?php
                if($num_dh>0){
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><?php echo $num_dh ?></span>
            </a>
            <?php
                }
            ?>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Thông báo
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?php echo $date_thu." ".$date_ngay." ".$date_thang ?></div>
                        <span class="font-weight-bold">Có <?php echo $num_dh ?> đơn hàng chưa xác nhận</span>
                    </div>
                </a>
                <?php
                $ngaydathang = "";
                while($row_dh = mysqli_fetch_array($query_dh)){
                    
                    if($ngaydathang==$row_dh['ngaydathang']){
                        $ngaydathang = $row_dh['ngaydathang'];
                    }else{
                        $ngaydathang = $row_dh['ngaydathang'];
                        $query_dh1 = mysqli_query($mysqli, "SELECT * FROM donhang WHERE ngaydathang = '".$ngaydathang."' AND trangthai = 0 LIMIT 1");
                        $query_dh2 = mysqli_query($mysqli, "SELECT * FROM donhang WHERE ngaydathang = '".$ngaydathang."' AND trangthai = 0");
                    }
                    
                    $num_dh1 = mysqli_num_rows($query_dh2);
                    while($row_dh1 = mysqli_fetch_array($query_dh1)){
                    
                ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?php echo $row_dh1['ngaydathang'] ?></div>
                        Có <?php echo $num_dh1 ?> đon hàng mới chưa xác nhận
                    </div>
                </a>
                <?php
                    }
                }
                ?>
                
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <?php
            $sql = "SELECT * FROM admin WHERE id = ".$_SESSION['dangnhapadpk']." LIMIT 1";
            $query = mysqli_query($mysqli, $sql);
            $row = mysqli_fetch_array($query);
        ?>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['hoten'] ?></span>
                <img class="img-profile rounded-circle"
                    src="css/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Hồ sơ
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cài đặt
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?action=dangxuat" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đăng xuất
                </a>
            </div>
        </li>

    </ul>

</nav>