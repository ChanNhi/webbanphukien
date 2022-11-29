<div class="content">
  <!-- Slider -->
  <div class="slider">

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <?php
      $query_banner = mysqli_query($mysqli, "SELECT * FROM banner WHERE trangthai = 1");
      $num_banner = mysqli_num_rows($query_banner);
      ?>
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <?php
        for ($i = 2; $i <= $num_banner; $i++) {
        ?>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i - 1; ?>" aria-label="Slide <?php echo $i ?>"></button>
        <?php
        }
        ?>
      </div>
      <div class="carousel-inner">
        <?php
        $t = 1;
        while ($row_banner = mysqli_fetch_array($query_banner)) {
          if ($t == 1) {
        ?>
            <div class="carousel-item active">
              <img src="./admin/modules/banner/uploads/<?php echo $row_banner['hinhanh'] ?>" class="d-block w-100 img-slider" alt="" width="50px" height="300px">
            </div>
          <?php
          } else {
          ?>
            <div class="carousel-item">
              <img src="./admin/modules/banner/uploads/<?php echo $row_banner['hinhanh'] ?>" class="d-block w-100 img-slider" alt="" width="50px" height="300px">
            </div>
        <?php
          }
          $t++;
        }
        ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- Sản phẩm mới nhẩt -->
  <div class="container">
    <div class="container-main">
      <h2 style="width:240px">Sản phẩm mới nhất</h2>
      <div class="row">
        <?php
        $sql_spm = "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
                    FROM     danhmucsp INNER JOIN
                                      thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                                      sanpham ON thuonghieu.id = sanpham.id_thuonghieu
                    WHERE  (sanpham.trangthai = 1) ORDER BY sanpham.id DESC LIMIT 8";
        $query_spm = mysqli_query($mysqli, $sql_spm);
        while ($row_spm = mysqli_fetch_array($query_spm)) {
        ?>
          <div data-name="<?php echo $row_spm['tensp'] ?>" data-price="<?php echo $row_spm['giasp'] ?>" style="height: 340px;" class="col-md-3">
            <div class="product-top">
              <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_spm['hinhanh'] ?>" alt="" width="200px" height="130px">
              <div class="overplay product-top-1">
                <form action="pages/main/addcart.php?idsanpham=<?php echo $row_spm['id'] ?>" method="POST">
                  <a href="product/brand-<?php echo $row_spm['id_thuonghieu'] ?>/<?php echo $row_spm['id'] ?>.html">
                    <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                  </a>
                  <a href="index.php?page=home&action=themyeuthich">
                    <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                  </a>

                  <input hidden type="submit" class="addcart" name="addcart" id="addcart">
                  <label for="addcart" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></label>
                </form>
              </div>
            </div>
            <div class="product-bottom text-center">
              <p id="product-name"><?php echo $row_spm['tensp'] ?></p>
              <?php
              if ($row_spm['giagiam'] == 0) {
              ?>
                <h5 id="product-price"><?php echo number_format($row_spm['giasp'], 0, ',', '.') ?><sup>đ</sup></h5>
              <?php
              } else {
                $giagiam = $row_spm['giasp'] - ($row_spm['giasp'] * $row_spm['giagiam'] / 100);
              ?>
                <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_spm['giasp'], 0, ',', '.') ?><sup>đ</sup></h6>
                <h5 id="product-price"><?php echo number_format($giagiam, 0, ',', '.') ?><sup>đ</sup></h5>
              <?php
              }
              ?>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Banner -->
  <?php
  $query_banner1 = mysqli_query($mysqli, "SELECT * FROM banner WHERE trangthai = 2 ORDER BY id DESC LIMIT 2");
  $num_banner1 = mysqli_num_rows($query_banner1);
  if ($num_banner1 == 2) {
  ?>
    <div class="container">
      <div class="container-main">
        <div class="row">
          <div class="col-md-12 d-flex justify-content-center">
            <?php

            while ($row_banner1 = mysqli_fetch_array($query_banner1)) {
            ?>
              <img class="col-6 h-90 d-inline-block m-4" src="./admin/modules/banner/uploads/<?php echo $row_banner1['hinhanh'] ?>" alt="">
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>

  <!-- Sản phẩm giảm giá -->
  <div class="container">
    <div class="container-main">
      <h2>Hot sales</h2>
      <div class="row">
        <?php
        $query_goiy = mysqli_query($mysqli, "SELECT * FROM sanpham WHERE giagiam > 0 AND trangthai = 1 ORDER BY giagiam DESC LIMIT 8");
        while ($row_goiy = mysqli_fetch_array($query_goiy)) {
        ?>
          <div data-name="<?php echo $row_goiy['tensp'] ?>" data-price="<?php echo $row_goiy['giasp'] ?>" style="height: 340px;" class="col-md-3">
            <div class="product-top">
              <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_goiy['hinhanh'] ?>" alt="" width="200px" height="130px">
              <div class="overplay product-top-1">
                <form action="pages/main/addcart.php?idsanpham=<?php echo $row_goiy['id'] ?>" method="POST">
                  <a href="product/brand-<?php echo $row_goiy['id_thuonghieu'] ?>/<?php echo $row_goiy['id'] ?>.html">
                    <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                  </a>
                  <a href="index.php?page=home&action=themyeuthich">
                    <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                  </a>

                  <input hidden type="submit" class="addcart" name="addcart" id="addcart">
                  <label for="addcart" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></label>
                </form>

              </div>
            </div>
            <div class="product-bottom text-center">
              <p id="product-name"><?php echo $row_goiy['tensp'] ?></p>
              <?php
              if ($row_goiy['giagiam'] == 0) {
              ?>
                <h5 id="product-price"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') ?><sup>đ</sup></h5>
              <?php
              } else {
                $giagiam = $row_goiy['giasp'] - ($row_goiy['giasp'] * $row_goiy['giagiam'] / 100);
              ?>
                <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') ?><sup>đ</sup></h6>
                <h5 id="product-price"><?php echo number_format($giagiam, 0, ',', '.') ?><sup>đ</sup></h5>
              <?php
              }
              ?>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <?php
  //Hiển thị sản phẩm thuộc danh mục nổi bật
  $sql = "SELECT * FROM danhmucsp WHERE trangthai = 1";
  $query = mysqli_query($mysqli, $sql);
  while ($row = mysqli_fetch_array($query)) {
  ?>
    <div class="container">
      <div class="container-main">
        <h2><a class="text-light" href="category/<?php echo $row['id'] ?>.html"><?php echo $row['tendanhmuc'] ?></a></h2>
        <div class="row">
          <?php
          //Hiển thị sản phẩm theo danh mục nổi bật
          $sql_sp = "SELECT sanpham.id AS Expr1, sanpham.id, sanpham.tensp, sanpham.hinhanh, sanpham.giasp, sanpham.giagiam, sanpham.id_thuonghieu
                    FROM     danhmucsp INNER JOIN
                                      thuonghieu ON danhmucsp.id = thuonghieu.id_danhmucsp INNER JOIN
                                      sanpham ON thuonghieu.id = sanpham.id_thuonghieu
                    WHERE  (danhmucsp.id = " . $row['id'] . ") AND (sanpham.trangthai = 1) ORDER BY Expr1 DESC LIMIT 4 ";
          $query_sp = mysqli_query($mysqli, $sql_sp);
          while ($row_sp = mysqli_fetch_array($query_sp)) {
          ?>
            <div data-name="<?php echo $row_sp['tensp'] ?>" data-price="<?php echo $row_sp['giasp'] ?>" style="height: 340px;" class="col-md-3">
              <div class="product-top">
                <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_sp['hinhanh'] ?>" alt="" width="200px" height="130px">
                <div class="overplay product-top-1">
                  <form action="pages/main/addcart.php?idsanpham=<?php echo $row_sp['id'] ?>" method="POST">
                    <a href="product/brand-<?php echo $row_sp['id_thuonghieu'] ?>/<?php echo $row_sp['id'] ?>.html">
                      <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                    </a>
                    <a href="index.php?page=home&action=themyeuthich">
                      <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                    </a>

                    <input hidden type="submit" class="addcart" name="addcart" id="addcart">
                    <label for="addcart" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></label>
                  </form>
                </div>
              </div>
              <div class="product-bottom text-center">
                <p id="product-name"><?php echo $row_sp['tensp'] ?></p>
                <?php
                if ($row_sp['giagiam'] == 0) {
                ?>
                  <h5 id="product-price"><?php echo number_format($row_sp['giasp'], 0, ',', '.') ?><sup>đ</sup></h5>
                <?php
                } else {
                  $giagiam = $row_sp['giasp'] - ($row_sp['giasp'] * $row_sp['giagiam'] / 100);
                ?>
                  <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_sp['giasp'], 0, ',', '.') ?><sup>đ</sup></h6>
                  <h5 id="product-price"><?php echo number_format($giagiam, 0, ',', '.') ?><sup>đ</sup></h5>
                <?php
                }
                ?>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <?php

  //Đã đăng nhập
  if (isset($_SESSION['dangnhap'])) {
    include('recommendation.php');
    $query_user = mysqli_query($mysqli, "SELECT * FROM user WHERE id=" . $_SESSION['dangnhap'] . "");
    $row_user = mysqli_fetch_array($query_user);
    $query_danhgia = mysqli_query($mysqli, "SELECT * FROM sanpham_danhgia WHERE id_user=" . $_SESSION['dangnhap'] . "");
    $num_danhgia = mysqli_num_rows($query_danhgia);

    if ($num_danhgia > 0) {
      $recommendation = array();
      $recommendation = getRecommendation($matrix, $_SESSION['dangnhap']);
      // var_dump(getRecommendation($matrix,$row_user['id']));

      // echo "<pre>";
      // print_r($recommendation);
      // echo "</pre>";

      //Có gợi ý
      if (!empty($recommendation)) {
  ?>
        <div class="container">
          <div class="container-main">
            <h2>Gợi ý sản phẩm</h2>
            <div class="row">
              <?php
              foreach ($recommendation as $tensp => $rating) {
                $sql_rec = "SELECT * FROM sanpham WHERE tensp='" . $tensp . "' AND trangthai = 1";
                $query_rec = mysqli_query($mysqli, $sql_rec);
                while ($row_rec = mysqli_fetch_array($query_rec)) {
              ?>
                  <div data-name="<?php echo $row_rec['tensp'] ?>" data-price="<?php echo $row_rec['giasp'] ?>" style="height: 340px;" class="col-md-3">
                    <div class="product-top">
                      <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_rec['hinhanh'] ?>" alt="" width="200px" height="130px">
                      <div class="overplay product-top-1">
                        <form action="pages/main/addcart.php?idsanpham=<?php echo $row_rec['id'] ?>" method="POST">
                          <a href="product/brand-<?php echo $row_rec['id_thuonghieu'] ?>/<?php echo $row_rec['id'] ?>.html">
                            <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                          </a>
                          <a href="index.php?page=home&action=themyeuthich">
                            <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                          </a>

                          <input hidden type="submit" class="addcart" name="addcart" id="addcart">
                          <label for="addcart" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></label>
                        </form>

                      </div>
                    </div>
                    <div class="product-bottom text-center">
                      <p id="product-name"><?php echo $row_rec['tensp'] ?></p>
                      <?php
                      if ($row_rec['giagiam'] == 0) {
                      ?>
                        <h5 id="product-price"><?php echo number_format($row_rec['giasp'], 0, ',', '.') ?><sup>đ</sup></h5>
                      <?php
                      } else {
                        $giagiam = $row_rec['giasp'] - ($row_rec['giasp'] * $row_rec['giagiam'] / 100);
                      ?>
                        <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_rec['giasp'], 0, ',', '.') ?><sup>đ</sup></h6>
                        <h5 id="product-price"><?php echo number_format($giagiam, 0, ',', '.') ?><sup>đ</sup></h5>
                      <?php
                      }
                      ?>
                    </div>
                  </div>

              <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      <?php
      } else {
        //Không có gợi ý
      ?>
        <div class="container">
          <div class="container-main">
            <h2>Gợi ý sản phẩm</h2>
            <div class="row">
              <?php
              $query_goiy = mysqli_query($mysqli, "SELECT * FROM sanpham ORDER BY soluongban DESC LIMIT 8");
              while ($row_goiy = mysqli_fetch_array($query_goiy)) {
              ?>
                <div data-name="<?php echo $row_goiy['tensp'] ?>" data-price="<?php echo $row_goiy['giasp'] ?>" style="height: 340px;" class="col-md-3">
                  <div class="product-top">
                    <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_goiy['hinhanh'] ?>" alt="" width="200px" height="130px">
                    <div class="overplay product-top-1">
                      <form action="pages/main/addcart.php?idsanpham=<?php echo $row_goiy['id'] ?>" method="POST">
                        <a href="product/brand-<?php echo $row_goiy['id_thuonghieu'] ?>/<?php echo $row_goiy['id'] ?>.html">
                          <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                        </a>
                        <a href="index.php?page=home&action=themyeuthich">
                          <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                        </a>

                        <input hidden type="submit" class="addcart" name="addcart" id="addcart">
                        <label for="addcart" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></label>
                      </form>

                    </div>
                  </div>
                  <div class="product-bottom text-center">
                    <p id="product-name"><?php echo $row_goiy['tensp'] ?></p>
                    <?php
                    if ($row_goiy['giagiam'] == 0) {
                    ?>
                      <h5 id="product-price"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') ?><sup>đ</sup></h5>
                    <?php
                    } else {
                      $giagiam = $row_goiy['giasp'] - ($row_goiy['giasp'] * $row_goiy['giagiam'] / 100);
                    ?>
                      <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') ?><sup>đ</sup></h6>
                      <h5 id="product-price"><?php echo number_format($giagiam, 0, ',', '.') ?><sup>đ</sup></h5>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      <?php
      }
    } else {
      //Người dùng chưa đánh giá sản phẩm nào
      ?>
      <div class="container">
        <div class="container-main">
          <h2>Gợi ý sản phẩm</h2>
          <div class="row">
            <?php
            $query_goiy = mysqli_query($mysqli, "SELECT * FROM sanpham ORDER BY soluongban DESC LIMIT 8");
            while ($row_goiy = mysqli_fetch_array($query_goiy)) {
            ?>
              <div data-name="<?php echo $row_goiy['tensp'] ?>" data-price="<?php echo $row_goiy['giasp'] ?>" style="height: 340px;" class="col-md-3">
                <div class="product-top">
                  <img src="./admin/modules/quanlysanpham/uploads/<?php echo $row_goiy['hinhanh'] ?>" alt="" width="200px" height="130px">
                  <div class="overplay product-top-1">
                    <form action="pages/main/addcart.php?idsanpham=<?php echo $row_goiy['id'] ?>" method="POST">
                      <a href="product/brand-<?php echo $row_goiy['id_thuonghieu'] ?>/<?php echo $row_goiy['id'] ?>.html">
                        <button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
                      </a>
                      <a href="index.php?page=home&action=themyeuthich">
                        <button id="themyeuthich" type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
                      </a>

                      <input hidden type="submit" class="addcart" name="addcart" id="addcart">
                      <label for="addcart" class="btn btn-secondary" title="Add to cart"><i class="fa fa-shopping-cart"></i></label>
                    </form>

                  </div>
                </div>
                <div class="product-bottom text-center">
                  <p id="product-name"><?php echo $row_goiy['tensp'] ?></p>
                  <?php
                  if ($row_goiy['giagiam'] == 0) {
                  ?>
                    <h5 id="product-price"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') ?><sup>đ</sup></h5>
                  <?php
                  } else {
                    $giagiam = $row_goiy['giasp'] - ($row_goiy['giasp'] * $row_goiy['giagiam'] / 100);
                  ?>
                    <h6 id="product-price" class="text-decoration-line-through text-danger"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') ?><sup>đ</sup></h6>
                    <h5 id="product-price"><?php echo number_format($giagiam, 0, ',', '.') ?><sup>đ</sup></h5>
                  <?php
                  }
                  ?>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>
</div>