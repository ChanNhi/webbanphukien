function kiemtradm(){
    var tendanhmuc = document.getElementById('tendanhmuc').value;
    var trangthai = document.getElementById('trangthai').value;
    if(tendanhmuc == ""){
        alert('Bạn chưa nhập tên danh mục');
        return false;
    }
    else
    if( trangthai == ""){
        alert('Bạn chưa chọn trạng thái');
    }
}