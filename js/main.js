
const themyeuthich = document.getElementById('themyeuthich');
var iddangnhap = document.getElementById('iddangnhap').innerHTML;
    if(iddangnhap == "Đăng nhập"){
        themyeuthich.onclick = function(){
            alert('Bạn phải đăng nhập để thêm vào yêu thích!');
            return false;
        }

        // for(var i =0; i < themyeuthich.length;i++){
        //     let themyeuthichBtn = themyeuthich[i];
        //     themyeuthich.onclick = function(){
        //         alert('Bạn phải đăng nhập để thêm vào yêu thích!');
        //         return false;
        //     }
        // }   
    }


function kiemtrathanhtoan(){
    var hoten = document.getElementById('hoten').value;
    var sdt = document.getElementById('sdt').value;
    var diachi = document.getElementById('diachi').value;
    var email = document.getElementById('email').value;
    var pttt = document.getElementById('pttt').value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if(hoten == null || hoten==""){
        alert("Vui lòng nhập họ tên");
        return false;
    }
    else
    if(diachi == null || diachi==""){
        alert("Vui lòng nhập địa chỉ");
        return false;
    }else
    if(sdt == null || sdt==""){
        alert("Vui lòng nhập số điện thoại");
        return false;
    }
    else
    if(email == null || email==""){
        alert("Vui lòng nhập email");
        return false;
    }
    else
    if(pttt == null || pttt==""){
        alert("Vui lòng chọn phương thức thanh toán");
        return false;
    }
    
    }

function kiemtradn(){
    var taikhoan = document.getElementById('taikhoan').value;
    var matkhau = document.getElementById('matkhau').value;
    alert(taikhoan);
    if(taikhoan == null || taikhoan==""){
        alert("Vui lòng nhập tài khoản");
        return false;
    }
    else
    if(matkhau == null || matkhau==""){
        alert("Vui lòng nhập nhập mât khẩu");
        return false;
    }
    }

function kiemtradk() {
    var hoten = document.getElementById('hoten').value;
    var taikhoan = document.getElementById('taikhoan').value;
    var matkhau = document.getElementById('matkhau').value;
    var matkhau1 = document.getElementById('matkhau1').value;
    
    if (hoten == null || hoten == "") {
        alert("Chưa nhập họ tên");
        return false;
    } else if (taikhoan == null || taikhoan == "") {
        alert("Chưa nhập tài khoản");
        return false;
    } else if (matkhau == null || matkhau == "") {
        alert("Chưa nhập mật khẩu");
        return false;
    } else if (matkhau.length < 8) {
        alert("Mật khẩu phải hơn 8 ký tự");
        return false;
    } else if (matkhau1 == null || matkhau1 == "") {
        alert("Chưa nhập mật khẩu");
        return false;
    } else if (matkhau != matkhau1) {
        alert("Mật khẩu nhập lại chưa chính xác");
        return false;
    }
}

function checkaddcart(){
    var addcart = document.getElementById('addcart-tinhtrang').innerHTML;
    if(addcart=="Hết hàng"){
        alert("Sản phẩm tạm hết hàng");
        return false;
    }
    }