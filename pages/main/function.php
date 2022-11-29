<?php
session_start();
include('../../admin/config/config.php');
require('../../mail/sendmail.php');
require('../../carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
// echo $now;exit;
    //Cập nhật thông tin người dùng
    if(isset($_POST['suathongtin'])){
        $id = $_GET['id'];
        $hoten = $_POST['hoten'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $sql = "UPDATE user SET hoten='".$hoten."', sdt='".$sdt."', diachi='".$diachi."', email='".$email."' WHERE id=".$id."";
        $query = mysqli_query($mysqli, $sql);
        echo "<script>alert('Cập nhật thành công');</script>";
        header('Location:../../profile.html');
    }


    //Đặt hàng
    if(isset($_SESSION['cart'])){
        $tongtien=0;
        $tongsp=0;
        $i=0;
        $soluong = 0;
        $thanhtoan = 0;
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
        }
        if(isset($_POST['dathang'])){
            $hoten = $_POST['hoten'];
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];
            $ghichu = $_POST['ghichu'];
            $email = $_POST['email'];
            $pttt = $_POST['pttt'];
            $madonhang = 'NH'.rand(0,999999);
            $id_user = $_SESSION['dangnhap'];

            //Thanh toán khi giao hàng
            if($_POST['pttt']==0){
                $sql_thanhtoan = "INSERT INTO donhang(hoten, madonhang, sdt, diachi, email, ghichu, soluong, tongtien, ngaydathang, phuongthuctt, id_user) VALUES ('".$hoten."','".$madonhang."','".$sdt."','".$diachi."','".$email."','".$ghichu."','".$soluong."', '".$thanhtoan."','".$now."','".$pttt."','".$id_user."')";
                if(mysqli_query($mysqli, $sql_thanhtoan)){
                    //Lấy id đơn hàng vừa tạo
                    $id_donhang = mysqli_insert_id($mysqli);
                }
                foreach($_SESSION['cart'] as $cart_item){
                    $tensp = $cart_item['tensp'];
                    $giasp = $cart_item['giasp'];
                    $giagiam = $cart_item['giagiam'];
                    $soluong = $cart_item['soluong'];
                    $hinhanh = $cart_item['hinhanh'];
                    $id_sp = $cart_item['id'];
                    $sql_donhang = "INSERT INTO donhang_chitiet(id_sp, tensp, hinhanh, giasp, giagiam, soluong, id_donhang) VALUES('".$id_sp."','".$tensp."', '".$hinhanh."', '".$giasp."', '".$giagiam."' ,'".$soluong."','".$id_donhang."')";
                    mysqli_query($mysqli, $sql_donhang);

                    //Thêm số lượng bán vào sản phẩm
                    $query_sp = mysqli_query($mysqli, "SELECT * FROM sanpham WHERE id = '".$id_sp."'");
                    $row_sp = mysqli_fetch_array($query_sp);

                    $soluongban = $row_sp['soluongban']+$soluong;
                    $update_sp = "UPDATE sanpham SET soluongban = $soluongban WHERE id = '".$id_sp."'";
                    mysqli_query($mysqli, $update_sp);
                }
                $_SESSION['dathang'] = $_SESSION['dangnhap'];


                //Gửi mail
                $hoten = $_POST['hoten'];
                $sdt = $_POST['sdt'];
                $diachi = $_POST['diachi'];
                $ghichu = $_POST['ghichu'];
                $email = $_POST['email'];
                $tieude = "XAC NHAN DAT HANG THANH CONG";
                $noidung = "<p>Cảm ơn quí khách đã đặt hàng tại shop phụ kiện máy tính, mã đơn hàng của quí khách: ".$madonhang."</p>";
                $noidung .="<table>
                                <thead>
                                    <tr>
                                        <td>Tên người nhận:</td>
                                        <td>".$hoten."</td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại:</td>
                                        <td>".$sdt."</td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ:</td>
                                        <td>".$diachi."</td>
                                    </tr>
                                    <tr>
                                        <td>Ghi chú:</td>
                                        <td>".$ghichu."</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng tiền đơn hàng:</td>
                                        <td>".number_format($thanhtoan,0,',','.')."<sup>đ</sup></td>
                                    </tr>
                                </thead>
                            </table>";
                $noidung .= "<h4>Đơn hàng của quí khách bao gồm:</h4>";
                foreach($_SESSION['cart'] as $cart_item){
                    $thanhtien=$cart_item['giasp'];
                    $tongtien = $thanhtien*$cart_item['soluong'];
                    $noidung .="<ul style='border:1px solid blue;margin:10px'>
                    <li>Tên sản phẩm: ".$cart_item['tensp']."</li>
                    <li>Giá sản phẩm: ".number_format($cart_item['giasp'],0,',','.')."<sup>đ</sup></li>
                    <li>Số lượng: ".$cart_item['soluong']."</li>
                    <li>Giá sản phẩm: ".number_format($tongtien,0,',','.')."<sup>đ</sup></li>
                    </ul>";
                }
                $maildathang =$email;
                $mail = new Mailer();
                $mail->dathangmail($tieude, $noidung, $maildathang);
                header('Location:../../payment/donhang-'.$id_donhang.'.html');
            }
            
            else{
                header('Location:../../index.php?page=vnpay&hoten='.$hoten.'&madonhang='.$madonhang.'&sdt='.$sdt.'&diachi='.$diachi.'&email='.$email.'&ghichu='.$ghichu.'&soluong='.$soluong.'&tongtien='.$thanhtoan.'&ngaydathang='.$now.'&pttt='.$pttt.'&iduser='.$id_user.'');
            }

        }
        //Thanh toán vnpay
        if(isset($_POST['redirect'])){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            /*
            * To change this license header, choose License Headers in Project Properties.
            * To change this template file, choose Tools | Templates
            * and open the template in the editor.
            */

            $vnp_TmnCode = "4AT1PD6J"; //Website ID in VNPAY System
            $vnp_HashSecret = "SNFBPXCMUUJLBSYRCCUHDNBYZYHNWNFP"; //Secret key
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/webphukien/index.php?page=paymentonl";
            $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
            //Config input format
            //Expire

            $startTime = date("YmdHis");
            $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));    
            $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = $_POST['order_desc'];//ghi chú
            $vnp_OrderType = $_POST['order_type'];
            $vnp_Amount = $_POST['amount'] * 100;//tongtien
            $vnp_Locale = $_POST['language'];
            $vnp_BankCode = $_POST['bank_code'];//Ngân hàng
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            $vnp_ExpireDate = $_POST['txtexpire'];

            $hoten= $_POST['hoten'];
            $email= $_POST['email'];
            $sdt= $_POST['sdt'];
            $diachi= $_POST['diachi'];
            $ghichu= $_POST['ghichu'];
            $id_user = $_SESSION['dangnhap'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate"=>$vnp_ExpireDate,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

             $sql_thanhtoan = "INSERT INTO donhang(hoten, madonhang, sdt, diachi, email, ghichu, soluong, tongtien, ngaydathang, phuongthuctt, id_user) VALUES ('".$hoten."','".$vnp_TxnRef."','".$sdt."','".$diachi."','".$email."','".$ghichu."','".$soluong."', '".$thanhtoan."','".$now."','1','".$id_user."')";
                if(mysqli_query($mysqli, $sql_thanhtoan)){
                    //Lấy id đơn hàng vừa tạo
                    $id_donhang = mysqli_insert_id($mysqli);
                }
                foreach($_SESSION['cart'] as $cart_item){
                    $tensp = $cart_item['tensp'];
                    $giasp = $cart_item['giasp'];
                    $giagiam = $cart_item['giagiam'];
                    $soluong = $cart_item['soluong'];
                    $hinhanh = $cart_item['hinhanh'];
                    $id_sp = $cart_item['id'];
                    $sql_donhang = "INSERT INTO donhang_chitiet(id_sp, tensp, hinhanh, giasp, giagiam, soluong, id_donhang) VALUES('".$id_sp."','".$tensp."', '".$hinhanh."', '".$giasp."', '".$giagiam."' ,'".$soluong."','".$id_donhang."')";
                    mysqli_query($mysqli, $sql_donhang);

                     //Thêm số lượng bán vào sản phẩm
                     $query_sp = mysqli_query($mysqli, "SELECT * FROM sanpham WHERE id = '".$id_sp."'");
                     $row_sp = mysqli_fetch_array($query_sp);
 
                     $soluongban = $row_sp['soluongban']+$soluong;
                     $update_sp = "UPDATE sanpham SET soluongban = $soluongban WHERE id = '".$id_sp."'";
                     mysqli_query($mysqli, $update_sp);
                }
                $_SESSION['iddonhang']=$id_donhang;
                $_SESSION['dathang'] = $_SESSION['dangnhap'];
            
                $hoten = $_POST['hoten'];
                $sdt = $_POST['sdt'];
                $diachi = $_POST['diachi'];
                $ghichu = $_POST['ghichu'];
                $email = $_POST['email'];
                $tieude = "XAC NHAN DAT HANG THANH CONG";
                $noidung = "<p>Cảm ơn quí khách đã đặt hàng tại shop phụ kiện máy tính, mã đơn hàng của quí khách: ".$madonhang."</p>";
                $noidung .="<table>
                                <thead>
                                    <tr>
                                        <td>Tên người nhận:</td>
                                        <td>".$hoten."</td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại:</td>
                                        <td>".$sdt."</td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ:</td>
                                        <td>".$diachi."</td>
                                    </tr>
                                    <tr>
                                        <td>Ghi chú:</td>
                                        <td>".$ghichu."</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng tiền đơn hàng:</td>
                                        <td>".number_format($thanhtoan,0,',','.')."<sup>đ</sup></td>
                                    </tr>
                                </thead>
                            </table>";
                $noidung .= "<h4>Đơn hàng của quí khách bao gồm:</h4>";
                foreach($_SESSION['cart'] as $cart_item){
                    $thanhtien=$cart_item['giasp'];
                    $tongtien = $thanhtien*$cart_item['soluong'];
                    $noidung .="<ul style='border:1px solid blue;margin:10px'>
                    <li>Tên sản phẩm: ".$cart_item['tensp']."</li>
                    <li>Giá sản phẩm: ".number_format($cart_item['giasp'],0,',','.')."<sup>đ</sup></li>
                    <li>Số lượng: ".$cart_item['soluong']."</li>
                    <li>Giá sản phẩm: ".number_format($tongtien,0,',','.')."<sup>đ</sup></li>
                    </ul>";
                }
                $maildathang =$email;
                $mail = new Mailer();
                $mail->dathangmail($tieude, $noidung, $maildathang);
                // header('Location:../../payment/donhang-'.$id_donhang.'.html');

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }

    }

    //Đánh giá
    $star = 0;
    if(isset($_POST['danhgia'])){
        $star = $_POST['star-rating'];
        $idsp = $_GET['idsanpham'];
        $idthuonghieu = $_GET['idthuonghieu'];
        $sql_sp = "SELECT * FROM sanpham WHERE id=".$idsp."";
        $query_sp = mysqli_query($mysqli,$sql_sp);
        $row_sp = mysqli_fetch_array($query_sp);

        $sql_danhgia = "SELECT * FROM sanpham_danhgia WHERE id_user=".$_SESSION['dangnhap']." AND id_sp=".$_GET['idsanpham']."";
        $query_danhgia = mysqli_query($mysqli,$sql_danhgia);
        $row_danhgia = mysqli_fetch_array($query_danhgia);
        $num_danhgia = mysqli_num_rows($query_danhgia);
        if($num_danhgia>0){
            $sql ="UPDATE sanpham_danhgia SET id_user='".$_SESSION['dangnhap']."',id_sp='".$idsp."',tensp='".$row_sp['tensp']."',danhgia='".$star."' WHERE id=".$row_danhgia['id']."";
            $query = mysqli_query($mysqli, $sql);
            header('Location:../../product/brand-7/'.$idsp.'.html');
        }
        else{   
            $sql = "INSERT INTO sanpham_danhgia(id_user,id_sp,tensp, danhgia) VALUES('".$_SESSION['dangnhap']."','".$idsp."','".$row_sp['tensp']."','".$star."')";
            $query = mysqli_query($mysqli, $sql);
            header('Location:../../product/brand-'.$idthuonghieu.'/'.$idsp.'.html');
        }
        
    }
    
?>


<!-- 
Ngân hàng: NCB
Số thẻ: 9704198526191432198
Tên chủ thẻ:NGUYEN VAN A
Ngày phát hành:07/15
Mật khẩu OTP:123456
-->
<!-- 
&vnp_Amount=113730000
&vnp_BankCode=NCB
&vnp_BankTranNo=VNP13741242
&vnp_CardType=ATM
&vnp_OrderInfo=Thanh+toán+hóa+đơn+tại+web
&vnp_PayDate=20220508154711
&vnp_ResponseCode=00
&vnp_TmnCode=4AT1PD6J
&vnp_TransactionNo=13741242
&vnp_TransactionStatus=00
&vnp_TxnRef=NH608199
 -->