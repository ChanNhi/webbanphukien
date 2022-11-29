
<?php
    include('../../config/config.php');
    if(isset($_POST['danhmuc'])){
        $danhmuc = $_POST["danhmuc"];
        $sql_thuonghieu = "select *from thuonghieu where id_danhmucsp = '".$danhmuc."'";
        $query_thuonghieu = mysqli_query($mysqli, $sql_thuonghieu); 
        while($row_thuonghieu = mysqli_fetch_array($query_thuonghieu)){
    ?>
        <option value="<?php echo $row_thuonghieu['id'] ?>"><?php echo $row_thuonghieu['tenthuonghieu'] ?></option>
    <?php
    }
}
?>
    
