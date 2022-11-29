<?php
    if(isset($_SESSION['cart'])){
        $tongtien=0;
        $tongsp=0;
        $i=0;
        $soluong = 0;
        $thanhtoan = 0;
?>
<div class="list-cart ">
        <div class="list-cart-left shadow p-3 mb-5 bg-body rounded">
            <h4>Giỏ hàng của bạn</h4>
            <table>
                <tr>
                    <th class="">Hình ảnh</th>
                    <th class="product-tittle">Tên sản phẩm</th>
                    <th class="price">Đơn giá</th>
                    <th class="quantity">Số lượng</th>
                    <th class="total">Thành tiền</th>
                    <th>Xóa</th>
                </tr>
                
                <?php
                  foreach($_SESSION['cart'] as $cart_item){
                      if($cart_item['giagiam']>0){
                          $giagiam = $cart_item['giasp']-($cart_item['giasp']*$cart_item['giagiam']/100);
                          $thanhtien=$giagiam;
                          $tongtien = $thanhtien*$cart_item['soluong'];
                          $thanhtoan += $tongtien;
                      }
                      else{
                        $thanhtien=$cart_item['giasp'];
                        $tongtien = $thanhtien*$cart_item['soluong'];
                        $thanhtoan += $tongtien;
                      }
                      
                      $soluong = $soluong+1;
                ?>
                <tr>
                    <td><img src="admin/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh'] ?>" alt="" width="70px;" height="70px"></td>
                    <td><?php echo $cart_item['tensp'] ?></td>
                    <?php
                    if($cart_item['giagiam']==0){
                    ?>
                    <td><?php echo number_format($cart_item['giasp'],0,',','.') ?><sup>đ</sup></td>
                    <?php
                    }else{
                    ?>
                    <td><p class="text-decoration-line-through text-danger"><?php echo number_format($cart_item['giasp'],0,',','.') ?><sup>đ</sup></p><?php echo number_format($giagiam,0,',','.') ?><sup>đ</sup></td>
                    <?php
                    }
                    ?>
                    <td>
                    <form action="pages/main/addcart.php?idsanpham=<?php echo $cart_item['id'] ?>" method="POST">
                        <p class="increase"><input type="submit" name="giamgiohang" value="-"></p>
                        <p class="value"><?php echo $cart_item['soluong'] ?></p>
                        <p class="reduction"><input type="submit" name="tanggiohang" value="+"></p>
                    </form>  
                    </td>
                    <td><?php echo number_format($tongtien,0,',','.') ?><sup>đ</sup></td>
                    <td>
                        <a href="pages/main/addcart.php?delcart=<?php echo $cart_item['id'] ?>">
                          <!-- <img src="./images/xoa.png" alt="" style="width:35px;height:35px"> -->
                          Xóa
                        </a>
                    </td>
                </tr>
                <?php
                  }
                ?>
            </table>
        </div>
        <div class="list-cart-right shadow p-3 mb-5 bg-body rounded">
          <h4>Thanh toán</h4>
            <table>
              <tr>
                <td>Tạm tính</td>
                <td style="float: right;"><?php echo number_format($thanhtoan,0,',','.') ?><sup>đ</sup></td>
              </tr>
              <tr>
                <td>Phí vận chuyển</td>
                <td style="float: right;">0<sup>đ</sup></td>
              </tr>
              <tr>
                <td>Thành tiền</td>
                <td style="float: right;"><?php echo number_format($thanhtoan,0,',','.') ?><sup>đ</sup></td>
              </tr>
            </table>
            <?php
            if(isset($_SESSION['dangnhap'])){
            ?>
            <div class="thanh-toan">
              <a href="delivery.html">Tiến hành đặt hàng</a>
            </div>
            <?php
            }else{
            ?>
            <div class="thanh-toan">
              <a href="login.html">Đăng nhập để thanh toán</a>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
            }else{
        ?>
            <div class="list-cart-empty">
              <img style="width:200px; height:200px" src="./images/cartempty.jpg" alt="">
              <h3>GIỎ HÀNG CỦA BẠN TRỐNG</h3>
            </div>
            
        <?php
            }
        ?>
</div>
