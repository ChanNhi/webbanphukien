<?php
if(isset($_SESSION['cart']) && isset($_SESSION['dangnhap']) && isset($_SESSION['dathang'])&&$_SESSION['iddonhang']){
    if(isset($_GET['vnp_Amount'])){
        $vnp_Amount=$_GET['vnp_Amount'];
        $vnp_BankCode=$_GET['vnp_BankCode'];
        $vnp_BankTranNo=$_GET['vnp_BankTranNo'];
        $vnp_CardType=$_GET['vnp_CardType'];
        $vnp_OrderInfo=$_GET['vnp_OrderInfo'];
        $vnp_PayDate=$_GET['vnp_PayDate'];
        $vnp_TmnCode=$_GET['vnp_TmnCode'];
        $vnp_TransactionNo=$_GET['vnp_TransactionNo'];
        $vnp_TxnRef=$_GET['vnp_TxnRef'];
        $iddonhang = $_SESSION['iddonhang'];

        $insert_vnpay = "INSERT INTO vnpay(vnp_amount, vnp_bankCode, vnp_bankTranNo, vnp_cardType, vnp_orderInfo, vnp_payDate, vnp_tmnCode, vnp_transactionNo, vnp_txnRef, id_donhang) 
        VALUES ('".$vnp_Amount."','".$vnp_BankCode."','".$vnp_BankTranNo."','".$vnp_CardType."','".$vnp_OrderInfo."','".$vnp_PayDate."','".$vnp_TmnCode."','".$vnp_TransactionNo."','".$vnp_TxnRef."','".$iddonhang."')";
        $query_vnpay = mysqli_query($mysqli,$insert_vnpay);
    }

    $tongtien=0;
    $tongsp=0;
    $i=0;
    $soluong = 0;
    $thanhtoan = 0;
    $thanhtien = 0;
    $sql_donhang = "SELECT * FROM donhang WHERE id = ".$_SESSION['iddonhang']."";
    $query_donhang = mysqli_query($mysqli, $sql_donhang);
    $row_donhang = mysqli_fetch_array($query_donhang);
?>
<div class="payment shadow p-3 mb-5 bg-body rounded">
    <div class="container">
        <h4>ĐẶT HÀNG THÀNH CÔNG</h4>
        <p>CHI TIẾT ĐƠN HÀNG:</p>
        <table class="payment-thongtin">
            <tr>
                <th style="border-right:1px solid lightgray">Mã đơn hàng</th>
                <th>Thời gian</th>
            </tr>
            <tr>
                <td style="border-right:1px solid lightgray"><?php echo $row_donhang['madonhang'] ?></td>
                <td><?php echo $row_donhang['ngaydathang'] ?></td>
            </tr>
        </table>
        <table class="payment-sanpham">
            <tr>
                <th style="width:10px">Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            <?php
                $sql_donhang_ct = "SELECT * FROM donhang_chitiet WHERE id_donhang = ".$_SESSION['iddonhang']."";
                $query_donhang_ct = mysqli_query($mysqli, $sql_donhang_ct);
                while($row_donhang_ct = mysqli_fetch_array($query_donhang_ct)){
                    if($row_donhang_ct['giagiam']>0){
                        $giagiam = $row_donhang_ct['giasp']-($row_donhang_ct['giasp']*$row_donhang_ct['giagiam']/100);
                        $thanhtien=$giagiam;
                        $tongtien = $thanhtien*$row_donhang_ct['soluong'];
                        $thanhtoan += $tongtien;
                    }else{
                        $thanhtien=$row_donhang_ct['giasp'];
                        $tongtien = $thanhtien*$row_donhang_ct['soluong'];
                        $thanhtoan += $tongtien;
                    }
            ?>
            <tr>
                <td> <img style="width:70px;height:50px" src="./admin/modules/quanlysanpham/uploads/<?php echo $row_donhang_ct['hinhanh'] ?>" alt=""> </td>
                <td><?php echo $row_donhang_ct['tensp'] ?></td>
                <?php
                if($row_donhang_ct['giagiam']==0){
                ?>
                <td><?php echo number_format($row_donhang_ct['giasp'],'0',',','.') ?><span>đ</span></td>
                <?php
                }else{
                ?>
                <td><p class="text-decoration-line-through text-danger"><?php echo number_format($row_donhang_ct['giasp'],0,',','.') ?><sup>đ</sup></p><?php echo number_format($giagiam,0,',','.') ?><sup>đ</sup></td>
                <?php
                }
                ?>
                <td><?php echo $row_donhang_ct['soluong'] ?></td>
                <td><?php echo number_format($tongtien,'0',',','.') ?><span>đ</span></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <div class="container payment-thanhtoan">
            <div>
                <p>Trạng thái:</p>
                <?php
                if($row_donhang['trangthai']==0){
                ?>
                <p class="payment-thanhtoan1">Chưa xác nhận</p>
                <?php
                }else
                if($row_donhang['trangthai']==1){
                ?>
                <p class="payment-thanhtoan1">Đã xác nhận</p>
                <?php
                }else
                if($row_donhang['trangthai']==2){
                ?>
                <p class="payment-thanhtoan1">Đã vận chuyển</p>
                <?php
                }
                ?>
            </div>
            <div>
                <p>Tạm tính:</p>
                <p class="payment-thanhtoan1"><?php echo number_format($row_donhang['tongtien'],'0',',','.') ?><span>đ</span></p>
            </div>
            <div>
                <p>Phí vận chuyển:</p>
                <p class="payment-thanhtoan1">Miễn phí</p>
            </div>
            <div style="font-weight:bold">
                <p>Tổng cộng:</p>
                <p class="payment-thanhtoan1"><?php echo number_format($row_donhang['tongtien'],'0',',','.') ?><span>đ</span></p>
            </div>
        </div>
    </div>
    <div class="container payment-thongtin1">
        <h4>Thông tin thanh toán</h4>
        <p><?php echo $row_donhang['hoten'] ?> <?php echo $row_donhang['sdt'] ?></p>
        <p><?php echo $row_donhang['diachi'] ?></p>
        <h4>Phương thức thanh toán</h4>
        <?php
            if($row_donhang['phuongthuctt']==0){
        ?>
        <p>Thanh toán khi giao hàng</p>
        <?php
            }else{
        ?>
        <p>Thanh toán trực tuyến</p>
        <?php
            }
        ?>
    </div>
</div>
<?php
unset($_SESSION['cart']);
unset($_SESSION['dathang']);
unset($_SESSION['iddonhang']);
}else{
// header('Location:../../index.php?page=cart');
?>
<p>LỖI</p>
<?php
}
?>
