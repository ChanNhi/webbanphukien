<?php

    session_start();
    include('../../admin/config/config.php');
    //tăng số lượng
    if(isset($_POST['tanggiohang'])){
        $id = $_GET['idsanpham'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'], 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                $_SESSION['cart'] = $product;
            }else{
                $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong']+1, 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                $_SESSION['cart'] = $product;
            }
            header('Location:../../cart.html');
    }
}
    //trừ số lượng
    if(isset($_POST['giamgiohang'])){
        $id = $_GET['idsanpham'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'], 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                $_SESSION['cart'] = $product;
            }else{
                if($cart_item['soluong']>1){
                    $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                    'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong']-1, 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                    $_SESSION['cart'] = $product;
                }
                else{
                    $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                    'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'], 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                    $_SESSION['cart'] = $product;
                }
            }
            header('Location:../../cart.html');
    }
}
    //xóa
    if(isset($_SESSION['cart']) && isset($_GET['delcart'])){
        $id = $_GET['delcart'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'], 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
            }
            $_SESSION['cart'] = $product;
            
        }
        header('Location:../../cart.html');
    }
    //Thêm sản phẩm vào giỏ hàng
    if(isset($_POST['addcart'])){
        // session_destroy();
        $id = $_GET['idsanpham'];
        $soluong = 1;
        $stt = 0;
        $sql = "SELECT * FROM sanpham WHERE id='".$id."' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query); 
        if($row){
            $new_product=array(array('tensp'=>$row['tensp'], 'hinhanh'=>$row['hinhanh'],
            'id'=>$id,'soluong'=>$soluong, 'giasp'=>$row['giasp'],'giagiam'=>$row['giagiam']));
            //kiểm tra session sản phẩm đã tồn tại
            if(isset($_SESSION['cart'])){
                $found = false;
                foreach($_SESSION['cart'] as $cart_item){
                    if($cart_item['id']==$id){
                        $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                        'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'] + 1, 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                        $found = true;
                    }
                    else{
                        $product[] = array('tensp'=>$cart_item['tensp'], 'hinhanh'=>$cart_item['hinhanh'],
                        'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'], 'giasp'=>$cart_item['giasp'],'giagiam'=>$cart_item['giagiam']);
                    }
                }
                if($found == false){
                    $_SESSION['cart'] = array_merge($product,$new_product);
                }
                else{
                    $_SESSION['cart'] = $product;
                }
            }
            else{
                $_SESSION['cart'] = $new_product;
                // echo "Chưa tồng tại session cart";
            }
        }
        header('Location:../../cart.html');
    }
?>