<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="./css/assets/bootstrap.min.css">
        <link rel="stylesheet" href="./css/assets/jumbotron-narrow.css">
    </head>
    <body>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

$vnp_TmnCode = "4AT1PD6J"; //Website ID in VNPAY System
$vnp_HashSecret = "SNFBPXCMUUJLBSYRCCUHDNBYZYHNWNFP"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
//Config input format
//Expire

$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
?>
<div class="container">
<div>
    <h3 class="text-muted">VNPAY DEMO</h3>
</div>
<h3>Tạo mới đơn hàng</h3>
<div class="table-responsive">
    <form action="pages/main/function.php" id="create_form" method="post">       

        <div class="form-group">
            <label for="language">Loại hàng hóa </label>
            <select name="order_type" id="order_type" class="form-control">
                <option value="topup">Nạp tiền điện thoại</option>
                <option value="billpayment">Thanh toán hóa đơn</option>
                <option value="fashion">Thời trang</option>
                <option value="other">Khác - Xem thêm tại VNPAY</option>
            </select>
        </div>
        <div class="form-group">
            <label for="order_id">Mã hóa đơn</label>
            <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo $_GET['madonhang'] ?>"/>
        </div>
        <div class="form-group">
            <label for="amount">Số tiền</label>
            <input class="form-control" id="amount"
                    name="amount" type="number" value="<?php echo $_GET['tongtien'] ?>"/>
        </div>
        <div class="form-group">
            <label for="order_desc">Nội dung thanh toán</label>
            <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Thanh toán hóa đơn tại web</textarea>
        </div>
        <div class="form-group">
            <label for="bank_code">Ngân hàng</label>
            <select name="bank_code" id="bank_code" class="form-control">
                <option value="">Không chọn</option>
                <option value="NCB"> Ngan hang NCB</option>
                <option value="AGRIBANK"> Ngan hang Agribank</option>
                <option value="SCB"> Ngan hang SCB</option>
                <option value="SACOMBANK">Ngan hang SacomBank</option>
                <option value="EXIMBANK"> Ngan hang EximBank</option>
                <option value="MSBANK"> Ngan hang MSBANK</option>
                <option value="NAMABANK"> Ngan hang NamABank</option>
                <option value="VNMART"> Vi dien tu VnMart</option>
                <option value="VIETINBANK">Ngan hang Vietinbank</option>
                <option value="VIETCOMBANK"> Ngan hang VCB</option>
                <option value="HDBANK">Ngan hang HDBank</option>
                <option value="DONGABANK"> Ngan hang Dong A</option>
                <option value="TPBANK"> Ngân hàng TPBank</option>
                <option value="OJB"> Ngân hàng OceanBank</option>
                <option value="BIDV"> Ngân hàng BIDV</option>
                <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                <option value="VPBANK"> Ngan hang VPBank</option>
                <option value="MBBANK"> Ngan hang MBBank</option>
                <option value="ACB"> Ngan hang ACB</option>
                <option value="OCB"> Ngan hang OCB</option>
                <option value="IVB"> Ngan hang IVB</option>
                <option value="VISA"> Thanh toan qua VISA/MASTER</option>
            </select>
        </div>
        <div class="form-group">
            <label for="language">Ngôn ngữ</label>
            <select name="language" id="language" class="form-control">
                <option value="vn">Tiếng Việt</option>
                <option value="en">English</option>
            </select>
        </div>
        <div class="form-group">
            <label >Thời hạn thanh toán</label>
            <input class="form-control" id="txtexpire"
                    name="txtexpire" type="text" value="<?php echo $expire; ?>"/>
        </div>
        <div class="form-group">
            <h3>Thông tin hóa đơn (Billing)</h3>
        </div>
        <div class="form-group">
            <label >Họ tên (*)</label>
            <input class="form-control" id="hoten"
                    name="hoten" type="text" value="<?php echo $_GET['hoten'] ?>"/>             
        </div>
        <div class="form-group">
            <label >Email (*)</label>
            <input class="form-control" id="email"
                    name="email" type="text" value="<?php echo $_GET['email'] ?>"/>   
        </div>
        <div class="form-group">
            <label >Số điện thoại (*)</label>
            <input class="form-control" id="txt_billing_mobile"
                    name="sdt" type="text" value="<?php echo $_GET['sdt'] ?>"/>   
        </div>
        <div class="form-group">
            <label >Địa chỉ (*)</label>
            <input class="form-control" id="txt_bill_city"
                    name="diachi" type="text" value="<?php echo $_GET['diachi'] ?>"/> 
        </div>
        <div class="form-group">
            <label >Ghi chú (*)</label>
            <input class="form-control" id="txt_bill_city"
                    name="ghichu" type="text" value="<?php echo $_GET['ghichu'] ?>"/> 
        </div>
        <div class="form-group">
            <label>Bang (Áp dụng cho US,CA)</label>
            <input class="form-control" id="txt_bill_state"
                    name="txt_bill_state" type="text" value=""/>
        </div>
        <div class="form-group">
            <label >Quốc gia (*)</label>
            <input class="form-control" id="txt_bill_country"
                    name="txt_bill_country" type="text" value="VN"/>
        </div>
        <button type="submit" name="redirect" id="redirect" class="btn btn-default">Thanh toán Redirect</button>

    </form>
</div>
<p>
    &nbsp;
</p>
</div>
<script src="./css/assets/jquery-1.11.3.min.js"></script>
</body>
</html>