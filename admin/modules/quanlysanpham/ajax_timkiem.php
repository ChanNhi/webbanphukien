<?php
    include('../../config/config.php');
    $a = $_POST['data'];
    $sql = "SELECT sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.mota, sanpham.thongso, 
            sanpham.tinhtrang, sanpham.trangthai, sanpham.id_thuonghieu, thuonghieu.tenthuonghieu
            FROM thuonghieu INNER JOIN sanpham
            ON thuonghieu.id = sanpham.id_thuonghieu
            WHERE sanpham.tensp LIKE '%$a%'";
    $query = mysqli_query($mysqli, $sql);
    $num = mysqli_num_rows($query);
    if($num>0){
        $i = 1;
        while($row = mysqli_fetch_array($query)){
?>
    <tr>
        <td><?php echo $i ?></td>
        <td><img style="width:40px; height:60px" src="./modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>" alt=""></td>
        <td><a class="text-muted" href="index.php?query=hinhanhmota&action=hinhanhmota&idsanpham=<?php echo $row['id'] ?>"><?php echo $row['tensp'] ?></a></td>
        <?php
        if($row['tinhtrang']==0){
        ?>
        <td>Hết hàng</td>
        <?php
        }else{
        ?>
        <td>Còn hàng</td>
        <?php
        }
        ?>
        <?php
            if($row['trangthai']==0){
        ?>
        <td>Ẩn</td>
        <?php
            }else{
        ?>
        <td>Hiện</td>
        <?php
            }
        ?>
        <td><?php echo $row['giagiam'] ?></td>
        <td><?php echo $row['tenthuonghieu'] ?></td>
        <td><a href="index.php?action=suasanpham&idsanpham=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
        <td><a onclick="return del('<?php echo $row['tensp'];?>')" class="delete" href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></td>                 
    </tr>
<?php
    $i++;
        }
    }
?>

<!-- <td><a href="index.php?query=quanlysanpham&action=sua&idthuonghieu=<?php echo $row['id_thuonghieu'] ?>&idsanpham=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
        <td><a onclick="return del('<?php echo $row['tensp'];?>')" class="delete" href="modules/quanlysanpham/xuly.php&idthuonghieu=<?php echo $row['id_thuonghieu'] ?>&idsanpham=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></td> -->