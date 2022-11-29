<?php
    if(isset($_SESSION['cart']) && isset($_SESSION['dangnhap'])){
        $tongtien=0;
        $tongsp=0;
        $i=0;
        $soluong = 0;
        $thanhtoan = 0;
        if(isset($_POST['laythongtin'])){
            $sql = "SELECT * FROM user WHERE id=".$_SESSION['dangnhap']." LIMIT 1";
            $query = mysqli_query($mysqli, $sql);
            $row = mysqli_fetch_array($query);
        }
?>
<div class="container delivery">
    <div class="container delivery-left shadow p-3 mb-5 bg-body rounded">
        <h4>THÔNG TIN THANH TOÁN</h4>
        <form action="" method="POST">
            <label for="laythongtin"><span style="color:red">*</span>Lấy thông tin có sẳn</label>
            <input hidden id="laythongtin" type="submit" name="laythongtin" value="Lấy thông tin có sẳn">
        </form>
        <form action="pages/main/function.php" method="POST" onsubmit="return kiemtrathanhtoan();">
            <p>Tên</p>
            <input id="hoten" type="text" name="hoten" value="<?php if(isset($_POST['laythongtin'])){echo $row['hoten'];}?>">
            <p>Địa chỉ</p>
            <input id="diachi" type="text" name="diachi" value="<?php if(isset($_POST['laythongtin'])){echo $row['diachi'];}?>">
            <p>Số điện thoại</p>
            <input id="sdt" type="text" name="sdt" value="<?php if(isset($_POST['laythongtin'])){echo $row['sdt'];}?>">
            <p>Địa chỉ email</p>
            <input id="email"type="text" name="email" value="<?php if(isset($_POST['laythongtin'])){echo $row['email'];}?>">
            <p>Ghi chú</p>
            <input id="ghichu"type="text" name="ghichu">
            <p>Phương thức thanh toán</p>
            <input required id="pttt" type="radio" name="pttt" value=0>
            <label for="pttt">Thanh toán khi giao hàng</label>
            <br>
            <input id="pttt1" type="radio" name="pttt" value=1>
            <label for="pttt1">Thanh toán VNpay</label>
            <br>
            <input type="submit" name="dathang" value="ĐẶT HÀNG">
        </form>
    </div>

    <div class="container delivery-right shadow p-3 mb-5 bg-body rounded">
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Tạm tính</th>
            </tr>
            <?php
                  foreach($_SESSION['cart'] as $cart_item){
                    if($cart_item['giagiam']>0){
                        $giagiam = $cart_item['giasp']-($cart_item['giasp']*$cart_item['giagiam']/100);
                        $thanhtien=$giagiam;
                        $tongtien = $thanhtien*$cart_item['soluong'];
                        $thanhtoan += $tongtien;
                    }else{
                        $thanhtien=$cart_item['giasp'];
                        $tongtien = $thanhtien*$cart_item['soluong'];
                        $thanhtoan += $tongtien;
                    }
                      $soluong = $soluong+1;
                ?>
            <tr>
                <td><?php echo $cart_item['tensp'] ?></td>
                <td><?php echo $cart_item['soluong'] ?></td>
                <td style="color:red"><?php echo number_format($tongtien,'0',',','.') ?><span>đ</span></td>
            </tr>
            <?php
                  }
            ?>
            <tr>
                <td style="font-size:20px;font-weight:bold" colspan="2">Tạm tính</td>
                <td  style="font-size:17px"><?php echo number_format($thanhtoan,'0',',','.') ?><span>đ</span></td>
            </tr>
            <tr>
                <td style="font-size:20px;font-weight:bold" colspan="2">Giao hàng</td>
                <td style="font-size:17px">Miễn phí</td>
            </tr>
            <tr>
                <td style="font-size:20px;font-weight:bold" colspan="2">Tổng</td>
                <td style="color:red;font-size:17px"><?php echo number_format($thanhtoan,'0',',','.') ?><span>đ</span></td>
            </tr>
        </table>
    </div>
</div>
<?php
    }else{
        header('Location:index.php');
    }

?>