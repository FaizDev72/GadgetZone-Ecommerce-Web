<?php
  require 'inc/head.php';
?>
<body>
  <!-- =========================Header========================= -->
  <header class="header-wrapper" id="header-wrapper">
    <!-- Nav 1 -->
    <?php
      require 'inc/main-nav.php';
      $catg_name = $_GET['catg'];
       // Add to cart
       if(isset($_POST['cart_submit'])){
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
        $catg_name = mysqli_real_escape_string($conn, $_POST['catg_name']);
        $sql = "SELECT * From cart WHERE user_id = {$user_id} and prod_id = {$prod_id}";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          $sql1 = "UPDATE cart set qty = qty + 1 WHERE user_id = {$user_id} and prod_id = {$prod_id}";
          if(!mysqli_query($conn, $sql1)){ 
            echo("<script>location.href = '".$BASE_URL."/categories.php?catg=".$catg_name."&msg=ERROR';</script>");
          }else{
            echo("<script>location.href = '".$BASE_URL."/categories.php?catg=".$catg_name."&msg=success';</script>");
          }
        }else{
          $sql1 = "INSERT INTO cart(prod_id, user_id, qty) VALUES( {$prod_id}, {$user_id}, 1)";
          if(!mysqli_query($conn, $sql1)){ 
            echo("<script>location.href = '".$BASE_URL."/categories.php?catg=".$catg_name."&msg=ERROR';</script>");
          }else{
            echo("<script>location.href = '".$BASE_URL."/categories.php?catg=".$catg_name."&msg=success';</script>");
          }
        }
      }
    ?>
    <!-- Nav 2 -->
    <?php
      require 'inc/nav-link.php';
    ?>
  </header>
  <section class="breadcrumb-wrapper">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb m-2 ms-4">
        <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>Brands</a></li>
      </ol>
    </nav>
  </section>
  <section class="filter-product-wrapper">
      <div class="container-fluid">
          <div class="row  justify-content-center align-items-center">
            <div class="col-10 filter-product mt-5">
              <div class="filter-product-gallery mb-5">
              <?php
                  if(isset($_GET['page'])){
                    $page1 = $_GET['page'];
                  }else{
                    $page1 = 1;
                  }
                  $limit1 = 16;
                  $offset1 = ($page1 - 1) * $limit1;
                  $sql2 = "SELECT
                            p.id,
                            b.id AS brand_id,
                            c.id AS catg_id,
                            b.name AS brand_name,
                            c.name AS catg_name,
                            p.name, p.status,p.img,p.trending,
                            p.color, p.mrp, p.description, 
                            p.deal_price,p.highlights
                          FROM
                            products p
                          INNER JOIN categories c ON 
                            p.catg_id = c.id 
                          INNER JOIN brands b ON
                            c.brand_id = b.id
                          WHERE c.name = '{$catg_name}'
                          LIMIT {$offset1},{$limit1}
                          ";
                  $result2 = mysqli_query($conn, $sql2) or die( "Unsuccessfull Query " . $sql2);
                  if(mysqli_num_rows($result2) > 0){
                ?>
                <h4>Total (<?php echo mysqli_num_rows($result2). " " . $catg_name?>'s)</h4>
                <div class="row">
                <?php
                    while($row2 = mysqli_fetch_assoc($result2)){
                ?>
                  <div class="col-6 col-sm-6 col-md-4 col-lg-3 border">
                    <div class="item p-2">
                      <a href="product.php?id=<?php echo $row2['id'] ?>">
                        <div class="mb-2"><img src="<?php echo 'admin/uploads/'.$row2['img'] ?>" class="img-fluid h-100 w-auto" alt=""></div>
                      </a>
                      <div class="text-left trend-content">
                        <h5><?php echo substr($row2['name'], 0,60)?></h5>
                        <p class="mb-1">M.R.P : <span class="h5">₹<?php echo $row2['mrp'] ?></span></p>
                        <p class="mb-1">Deal price : ₹<?php echo $row2['deal_price'] ?></p>
                        <p class="mb-2">You save : <?php echo $row2['mrp'] - $row2['deal_price'] . "(" . round(100 * ($row2['mrp'] - $row2['deal_price']) / $row2['mrp'],1) ."%)"?></p>
                        <?php 
                        if(isset($_SESSION['user_id']) and isset($_SESSION['email'])){
                        ?>
                          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                          <input type="text" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                          <input type="text" name="prod_id" value="<?php echo $row2['id'] ?>" hidden>
                          <input type="text" name="catg_name" value="<?php echo $catg_name ?>" hidden>
                          <button class="btn btn-outline-primary rounded-pill font-14 fw-bold" type="submit" name="cart_submit">Add to Cart</button>
                        </form>
                        <?php
                        }else{
                          ?>
                          <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary rounded-pill font-14 fw-bold" type="submit" name="cart_submit">Add to Cart</button>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <?php
                  }
                  ?>
              </div>
              <?php
              }
              ?>

              <!-- ======================== Pagination ========================= -->
              <?php
                  $sql3 = "SELECT * FROM products p
                  inner join categories c on c.id = p.catg_id where c.name = '{$catg_name}';";
                  $result3 = mysqli_query($conn,$sql3) or die($sql3);
                  if(mysqli_num_rows($result3) > 0){
                      $totalrecords1 = mysqli_num_rows($result3);
                      $totalpages1 = ceil($totalrecords1 / $limit1);
                      echo'<nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center mt-5">';
                      if($page1 > 1){
                          echo '<li class="page-item active"><a class="page-link" href="categories.php?catg='.$catg_name.'&page='.($page1 - 1).'"><i class="fad fa-angle-double-left"></i></a></li>';
                      }else{
                          echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-angle-double-left"></i></a></li>';
                      }
                      for($i = 1; $i <= $totalpages1; $i++){
                          if($page1 == $i){
                              $active1 = 'active';
                          }else{
                              $active1 = '';
                          }
                          echo '<li class="page-item '.$active1.'"><a class="page-link" href="categories.php?catg='.$catg_name.'&page='.$i.'">'.$i.'</a></li>';
                      }
                      if($page1 < $totalpages1){
                          echo '<li class="page-item active"><a class="page-link" href="categories.php?catg='.$catg_name.'&page='.($page1 + 1).'"><i class="fad fa-chevron-double-right"></i></a></li>';
                      }else{
                          echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-chevron-double-right"></i></a></li>';
                      }
                      echo '   </ul>
                      </nav>';
                  }
              ?>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                  <button type="button" class="font-25 bg-light border-0 text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                Sorry but you have to &nbsp;&nbsp;<a href = "<?php echo $BASE_URL?>/login.php" class="btn btn-warning rounded-pill fw-bold font-18"> Login </a>&nbsp;&nbsp; to cart the product
                </div>
              </div>
            </div>
          </div>
      </div>
  </section>

    <!-- Footer -->
<?php
  require 'inc/footer.php';
?>