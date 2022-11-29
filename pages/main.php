
    <div class="main cartegory-right row">
        <?php
            if(isset($_GET['page'])){
                $t = $_GET['page'];
            }
            else{
                $t = "";
                
            }
            if($t==''){
                include('main/home.php');
            }
            else if($t == $_GET['page']){
                    include("main/".$_GET['page'].".php");
                }
        ?>
    </div>