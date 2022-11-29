<?php
  include('./admin/config/config.php');
  session_start();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/webphukien/"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">
    <?php
    if(isset($_GET['page'])){
      $t = $_GET['page'];
    }
    else{
        $t = "";
        
    }
    if($t==''){
    ?>
    <title>Phụ kiện máy tính</title>
    <?php
    }else if($t==$_GET['page']){
    ?>
    <title>Phụ kiện máy tính - <?php echo $_GET['page'] ?></title>
    <?php
    }
    ?>
</head>
<body>
    <?php
        include('pages/header.php');
        include('pages/main.php');
        include('pages/footer.php');
    ?>
    <script src="./js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    
    <script>
        const bigImg = document.querySelector(".product-detail-big-img img")
          const smalImg =  document.querySelectorAll(".product-detail-small-img img")
          smalImg.forEach(function(imgItem,X){
            imgItem.addEventListener("click",function(){
              bigImg.src = imgItem.src
            })
          })
          
    </script>
</body>
</html>