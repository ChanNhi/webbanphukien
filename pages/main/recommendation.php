<?php
    //include('../../admin/config/config.php');   
    include('recommend.php');
    
    $sql_danhgia = "SELECT * FROM sanpham_danhgia";
    $query_danhgia = mysqli_query($mysqli,$sql_danhgia);
    $matrix = array();
    while($row_danhgia = mysqli_fetch_array($query_danhgia)){
        $query_user = mysqli_query($mysqli,"SELECT id FROM user WHERE id=".$row_danhgia['id_user']."");
        $row_user = mysqli_fetch_array($query_user);
        $matrix[$row_user['id']][$row_danhgia['tensp']] = $row_danhgia['danhgia'];
        
    }
    // echo "<pre>";
    // print_r($matrix);
    // echo "</pre>";

    // echo "<hr>";
    // echo "<pre>";
    // print_r(getRecommendation($matrix,6));
    // echo "</pre>";

    // echo "<hr>";
    // echo "<pre>";
    // var_dump(similarity_distance($matrix,6,5));
    // echo "</pre>";

    // echo "<hr>";
    // $a = array();
    // foreach($matrix[3] as $key=>$value){
        
    //     // echo "<pre>";
    //     // print_r($value);
    //     // echo "</pre>";
        
    //     echo "<pre>";
    //     print_r($matrix[3][$key]);
    //     echo "</pre>";
        
    // }
    
?>