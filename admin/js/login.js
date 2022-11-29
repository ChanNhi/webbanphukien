function kiemtradangnhap(){
        
    var user = document.getElementById('exampleInputEmail').value;
    var pass = document.getElementById('exampleInputPassword').value;
    var select = document.getElementById('dangnhap').value;
    var baoloi = document.getElementById('baoloi').value;
    alert('123');
    if(user==""){
        document.getElementById('baoloi').innerHTML = "Chưa nhập tài khoản";
        return false;
    }
    else
    if(pass==""){
        document.getElementById('baoloi').innerHTML = "Chưa nhập mật khẩu";
        return false;
    }
}