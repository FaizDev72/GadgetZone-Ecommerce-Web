<?php
  require 'inc/head.php';

  if(isset($_POST['review_submit'])){
    if(isset( $_POST['rate'])){
      $rate = mysqli_real_escape_string($conn, $_POST['rate']);
    }else{
      $rate = 1;
    }
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $sql3 = "INSERT INTO reviews(user_id, prod_id, rating, title, review, date) VALUES({$user_id}, {$prod_id}, {$rate}, '{$title}', '{$description}', Now())";
    if(!mysqli_query($conn, $sql3)){ 
      header("Location: ".$BASE_URL."/product.php?id=".$prod_id."&error=Query Failed!");
    }else{
      header("Location: ".$BASE_URL."/product.php?id=".$prod_id."&success=Reviewed!");
    }
  }
?>
<body data-bs-spy="scroll" data-bs-target="#navbar-example2">
    <!-- =========================Header========================= -->
    <header class="header-wrapper" id="header-wrapper">
      <!-- Nav 1 -->
      <?php
        require 'inc/main-nav.php';
      ?>
      
      <!-- Nav 2 -->
      <?php
       require 'inc/nav-link.php';

      //  Add to cart
      if(isset($_POST['add-to-cart'])){
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
        $sql6 = "SELECT * from cart where prod_id = {$prod_id} and user_id = {$user_id}";
        $result6 = mysqli_query($conn, $sql6);
        if(mysqli_num_rows($result6) > 0){
          $sql1 = "UPDATE cart set qty = qty + 1 where prod_id = {$prod_id} and user_id = {$user_id}";
          if(!mysqli_query($conn, $sql1)){ 
            echo("<script>location.href = '".$BASE_URL."/cart.php?msg=ERROR';</script>");
          }else{
            echo("<script>location.href = '".$BASE_URL."/cart.php?msg=INSERTED';</script>");
          }
        }else{
          $sql1 = "INSERT INTO cart(prod_id, user_id, qty) values({$prod_id}, {$user_id}, 1)";
          if(!mysqli_query($conn, $sql1)){ 
            echo("<script>location.href = '".$BASE_URL."/cart.php?msg=ERROR';</script>");
          }else{
            echo("<script>location.href = '".$BASE_URL."/cart.php?msg=INSERTED1';</script>");
          }
        }
        
      }

      //  Buy Now
      if(isset($_POST['buy'])){
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);

        $sql1 = "INSERT INTO orders(prod_id, user_id, qty, name, email, address, mobile, city, date, status) values({$prod_id}, {$user_id}, 1, '{$name}', '{$email}', '{$address}', {$mobile}, '{$city}', Now(), 1)";
        if(!mysqli_query($conn, $sql1)){ 
          echo("<script>location.href = '".$BASE_URL."/order.php?msg=ERROR';</script>");
        }else{
          echo("<script>location.href = '".$BASE_URL."/order.php?msg=INSERTED';</script>");
        }
      }
      ?>

      <!-- Scrollspy nav -->
      <nav id="navbar-example2" class="scrollspy-nav border border-top">
        <ul class="nav nav-pills ps-2">
          <li class="nav-item border-end">
            <a class="nav-link" href="#scrollspy-product">Product</a>
          </li>
          <li class="nav-item border-end">
            <a class="nav-link" href="#scrollspy-productInfo">Specs</a>
          </li>
          <li class="nav-item border-end">
            <a class="nav-link" href="#scrollspy-review">Review</a>
          </li>
        </ul>
      </nav>
    </header>
    
    <?php
        $id = $_GET['id'];
        $sql = "SELECT 
                  p.id,
                  c.id AS catg_id,
                  b.id AS brand_id,
                  b.name AS brand_name,
                  c.name AS catg_name,
                  p.name, p.color,p.mrp,
                  p.deal_price, p.highlights, 
                  p.description, p.img
                FROM
                  products p
                INNER JOIN categories c ON
                  p.catg_id = c.id
                INNER JOIN brands b ON
                  c.brand_id = b.id
                WHERE p.id = {$id}";
        $result = mysqli_query($conn, $sql) or die( "Unsuccessfull Query " . $sql);
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
        ?>
    <!-- Breadcrumb -->
    <section class="breadcrumb-wrapper">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb m-2 ms-4">
              <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item" aria-current="page"><a><?php echo $row['brand_name']?></a></li>
              <li class="breadcrumb-item"><a href="categories.php?catg=<?php echo $row['catg_name'] ?>"><?php echo $row['catg_name']?></a></li>
            </ol>
          </nav>
    </section>

    <!-- Scrollspy wrapper -->
  <section class="scrollspy-wrapper">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
      <div id="scrollspy-product">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-11 mb-5 mb-lg-0">
                      <div class="row justify-content-around product-image-wrapper align-items-center flex-column flex-lg-row">
                          <div class="col-10 col-lg-8 product-large-img-wrapper d-flex align-items-center flex-column">
                              <div class="product-large-img">
                                  <img src="admin/uploads/<?php echo $row['img'] ?>" alt="">
                              </div> 
                              <div class="product-btn product-fixed-btn">
                                <?php 
                                  if(isset($_SESSION['user_id']) and isset($_SESSION['email'])){
                                ?>
                                  <form class="cart-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                    <input type="text" hidden name="prod_id" value="<?php echo $row['id'] ?>">
                                    <input type="text" hidden name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                    <button class="rounded-btn cart-btn btn-primary w-100" name="add-to-cart" type="submit">Add to Cart</button>
                                  </form>
                                  <button class="order-btn btn-outline-primary rounded-btn checkout-btn" style="border: 2px solid #0c6dff;" data-bs-toggle="modal" data-bs-target="#buyModal">Buy Now</button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="buyModalLabel">Shipping Details</h5>
                                          <button type="button" class="font-25 bg-light border-0 text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                        </div>
                                        <div class="modal-body">
                                          <?php
                                          $sql5 = "select * from user where id = {$_SESSION['user_id']}";
                                          $result5 = mysqli_query($conn, $sql5);
                                          if(mysqli_num_rows($result5)){
                                            while($row5 = mysqli_fetch_assoc($result5)){
                                              ?>
                                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <input type="text" class="form-control border-primary border-2" value="<?php echo $_SESSION['user_id'] ?>" name = "user_id" hidden>
                                                <input type="text" class="form-control border-primary border-2" value="<?php echo $row['id'] ?>" name = "prod_id" hidden>
                                                <div class="mb-3">
                                                  <label for="brand-name" class="form-label font-20">Name</label>
                                                  <input type="text" class="form-control border-primary border-2" value="<?php echo $row5['f_name'].' '.$row5['l_name'] ?>" required name="name">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="brand-name" class="form-label font-20">Email</label>
                                                  <input type="text" class="form-control border-primary border-2" value="<?php echo $row5['email'] ?>" required name="email">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="brand-name" class="form-label font-20">Mobile no.</label>
                                                  <input type="text" class="form-control border-primary border-2" value="<?php echo $row5['mobile'] ?>" required name="mobile">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="brand-name" class="form-label font-20">Address</label>
                                                  <input type="text" class="form-control border-primary border-2" value="<?php echo $row5['address'] ?>" required name="address">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="brand-name" class="form-label font-20">City</label>
                                                  <input type="text" class="form-control border-primary border-2" value="<?php echo $row5['city'] ?>" required name="city">
                                                </div>
                                        </div>
                                                <div class="modal-footer border-primary border-2">
                                                  <button type="submit" name="buy" class="btn btn-outline-primary rounded-pill border-2 fw-bold">Submit</button>
                                                </div>
                                              </form>
                                              <?php
                                            }
                                          }
                                          ?>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- modal end -->
                                  <?php
                                }else{
                                ?>
                                <button class="rounded-btn cart-btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartModal"> Add to Cart</button>
                                <button class="rounded-btn checkout-btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cartModal">Buy Now</button>
                                <?php
                                  }
                                ?>
                              </div>
                          </div>
                      </div>
                      <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="cartModalLabel">Alert</h5>
                              <button type="button" class="font-25 bg-light border-0 text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                            </div>
                            <div class="modal-body">
                            Sorry but you have to &nbsp;&nbsp;<a href = "<?php echo $BASE_URL?>/login.php" class="btn btn-warning rounded-pill fw-bold font-18"> Login </a>&nbsp;&nbsp; to proceed further
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-11 ps-4">
                      <div class="product-title">
                        <div class="product-name mb-2"><h4 style="font-weight:500" class="font-20"><?php echo $row['name']?></h4></div>
                        <div class="product-short-rate-review mb-2">
                          <span class="bg-primary text-light p-1 me-2 text-center">
                          <?php
                            function rating1($rate,$id,$conn){
                              $sql4 = "select * from reviews where prod_id = {$id} and rating = {$rate};";
                              $result4 = mysqli_query($conn, $sql4);
                              return mysqli_num_rows($result4);
                            }
                            $star1 = rating1(1, $id, $conn);
                            $star2 = rating1(2, $id, $conn);
                            $star3 = rating1(3, $id, $conn);
                            $star4 = rating1(4, $id, $conn);
                            $star5 = rating1(5, $id, $conn);
                            try {
                              $avg = (5*$star5 + 4*$star4 + 3*$star3 + 2*$star2 + 1*$star1) / ($star5+$star4+$star3+$star2+$star1);
                            } catch (\Throwable $th) {
                              $avg  = 0;
                            }
                          ?>
                          <?php echo round($avg,1); ?><i class="fas fa-star ps-1"></i>
                          </span>
                          (<?php echo mysqli_num_rows(mysqli_query($conn, "select * from reviews where prod_id = {$id}")); ?> Reviews)
                        </div>
                      </div>
                      <div class="product-price-details">
                        <div class="product-mrp font-18 text-muted"><s>M.R.P : <span>₹<?php echo $row['mrp'] ?></span></s></div>
                        <div class="product-deal">
                          <h4 style="font-weight:600">Deal Price : <span>₹<?php echo $row['deal_price'] ?></span> <span class="font-14 text-muted">Inclusive of all taxes</span></h4>
                        </div>
                        <div class="product-discount mb-2 text-primary font-18"><h6 class="d-inline font-18" style="font-weight:600">You Save : ₹<span><?php echo $row['mrp'] - $row['deal_price'] . "(" . round(100 * ($row['mrp'] - $row['deal_price']) / $row['mrp'],1) ."%)" ?></span></h6></div>
                      </div>
                      <div class="product-color mb-2 font-20 text-dark" style="font-weight:600">Color : <h6 class="d-inline-block text-uppercase font-20 text-secondary"><?php echo $row['color'] ?></h6><br>
                     
                      </div>
                      <div class="highlight d-flex align-content-center flex-column justify-content-start">
                        <span class="me-5 font-20 text-uppercase" style="font-weight:600">Highlights</span>
                        <div class="text-muted font-14 ms-4">
                          <?php echo $row['highlights'] ?>
                        </div>
                      </div>
                    </div>
              </div>
          </div>
        </div>
      </div>
      <div id="scrollspy-productInfo" class="mt-5">
          <div class="container">
            <div class="row related-product-wrapper mb-5">
              <?php
                $sql1 = "SELECT 
                  p.id,
                  c.id AS catg_id,
                  b.id AS brand_id,
                  b.name AS brand_name,
                  c.name AS catg_name,
                  p.name, p.color,p.mrp,
                  p.deal_price,p.img
                FROM
                  products p
                INNER JOIN categories c ON
                  p.catg_id = c.id
                INNER JOIN brands b ON
                  c.brand_id = b.id
                WHERE p.status = 1 and p.catg_id = {$row['catg_id']}";
                $result1 = mysqli_query($conn, $sql1) or die( "Unsuccessfull Query " . $sql1);
                if(mysqli_num_rows($result1) > 0){
              ?>
              <h4 class="text-uppercase mb-4">Related Products</h4>
              <div class="col-12 owl-carousel owl-theme" style="z-index:0;">
                <?php
                  
                    while($row1 = mysqli_fetch_assoc($result1)){
                      if($row1['id'] != $row['id']){
                ?>
                      <div class="item p-2 border">
                        <a href="product.php?id=<?php echo $row1['id']?>">
                          <div class="mb-2"><img src="<?php echo 'admin/uploads/'.$row1['img'] ?>" class="img-fluid h-100 w-auto" alt=""></div>
                        </a>
                        <div class="text-left trend-content">
                          <h5><?php echo substr($row1['name'], 0,40)?></h5>
                          <p class="mb-1">M.R.P : ₹<?php echo $row1['mrp'] ?></p>
                          <p class="mb-1">Deal price : <span class="h5">₹<?php echo $row1['deal_price'] ?></span></p>
                          <p class="mb-1">You save : ₹<?php echo $row1['mrp'] - $row1['deal_price'] . "(" . round(100 * ($row1['mrp'] - $row1['deal_price']) / $row1['mrp'],1) ."%)" ?></p>
                        </div>
                      </div>
                <?php
                    }
                  }
                
                ?>
              </div>
              <?php
                }
              ?>
            </div>
            <div class="row border-top border-bottom w-100 py-4">
              <div class="col-12">
                <h4 class="text-uppercase mb-3">Specfication</h4>
                <div class="table-responsive w-100">
                  <?php echo $row['description'] ?>
                </div>

              </div>
            </div>
          </div>
      </div>
      <div id="scrollspy-review" class="mt-4">
        <div class="container">
            <div class="row">
              <div class="col-xl-4 mb-3 mb-xl-0 pb-4">
                <h4>Reviews & Rating</h4>
                <?php
                  $sql2 = "SELECT
                            r.id,
                            u.id AS user_id,
                            u.f_name,u.l_name,
                            p.id AS prod_id,
                            p.name AS prod_name,
                            r.title,r.review,
                            r.rating, r.date
                          FROM
                            reviews r
                          INNER JOIN products p ON
                            r.prod_id = p.id
                          INNER JOIN user u ON
                            r.user_id = u.id
                          WHERE p.id = {$id}";
                  $result2 = mysqli_query($conn, $sql2) or die( "Unsuccessfull Query " . $sql2);
                  if(mysqli_num_rows($result2) > 0){
                    
                ?>
                <div class="review-analysis d-flex flex-column">
                  <div class="overall-analysis w-75 d-flex justify-content-center flex-column">
                    <?php
                    function rating($rate,$id,$conn){
                      $sql4 = "select * from reviews where prod_id = {$id} and rating = {$rate};";
                      $result4 = mysqli_query($conn, $sql4);
                      return mysqli_num_rows($result4);
                    }
                    $star1 = rating(1, $id, $conn);
                    $star2 = rating(2, $id, $conn);
                    $star3 = rating(3, $id, $conn);
                    $star4 = rating(4, $id, $conn);
                    $star5 = rating(5, $id, $conn);
                    $avg = (5*$star5 + 4*$star4 + 3*$star3 + 2*$star2 + 1*$star1) / ($star5+$star4+$star3+$star2+$star1);
                    ?>
                    <h2>
                      <?php echo round($avg,1); ?> <i class="fad fa-star ps-1"></i>
                    </h2>
                    <span><?php echo mysqli_num_rows($result2); ?> Reviews & Rating</span>
                  </div>
                </div>
                <div class="write-review d-flex align-items-start justify-content-center flex-column mt-3">
                  <h4 class="">Review and Rate this product</h4>
                  <span class="mb-2">share your thoughts with other customer</span>
                  <button class="btn btn-primary  rounded-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Write a review</button>
                </div>
              </div>
              <div class="col-xl-8 recent-review font-16">
                <h4>Recent reviews from India</h4>
                <?php
                while($row2 = mysqli_fetch_assoc($result2)){
                ?>
                <div class="review mb-3 border-bottom pb-4">
                  <div class="review-profile mb-2">
                    <span><i class="fad fa-user-circle "></i></span>
                    <span class="font-16"><?php echo $row2['f_name']." ".$row2['l_name']?></span>
                  </div>
                  <div class="mb-2">
                    <span class="bg-primary text-light p-1 me-2 text-center">
                    <?php echo $row2['rating']?><i class="fas fa-star ps-1  font-12"></i>
                    </span>
                    <span class="review-title font-18 fw-bold"><?php echo $row2['title']?></span>
                  </div>
                  <div class="review-date text-secondary font-14 mb-3">Reviewed on <?php echo $row2['date']?></div>
                  <div class="review-description font-14"><?php echo $row2['review']?></div>
                </div>
              
              <?php
                }
                echo '</div>';
              }else{
                echo '
                <h5>No Reviews and Rating for this product</h5>
                <button class="btn btn-primary  rounded-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Write a review</button>' ;
              }
              ?>
          </div>
            <!-- Modal -->
            <?php
            if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
              $result6 = mysqli_query($conn, "select * from orders where user_id = {$_SESSION['user_id']} and prod_id = {$id}");
              if(mysqli_num_rows($result6) > 0){
                ?>
                <div class="modal fade review-dialog" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">RATING AND  REVIEW</h5>
                        <button type="button" class="font-25 bg-light border-0 text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="review-form d-flex flex-column bg-light">
                        <input type="text" value="<?php echo $id ?>" name = "prod_id" hidden>
                        <input type="text" value="<?php echo $_SESSION['user_id'] ?>" name = "user_id" hidden>
                          <div class="review-form-rating">
                            <h5>Rate your experience</h5>
                            <div class="rate">
                              <input type="radio" id="star5" name="rate" value="5" hidden/>
                              <label for="star5" title="text">5 stars</label>
                              <input type="radio" id="star4" name="rate" value="4" hidden/>
                              <label for="star4" title="text">4 stars</label>
                              <input type="radio" id="star3" name="rate" value="3" hidden/>
                              <label for="star3" title="text">3 stars</label>
                              <input type="radio" id="star2" name="rate" value="2" hidden/>
                              <label for="star2" title="text">2 stars</label>
                              <input type="radio" id="star1" name="rate" value="1" hidden/>
                              <label for="star1" title="text">1 star</label>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><h5>Review Title</h5></label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title...." required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><h5>Write Review</h5></label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required placeholder="description...."></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name = "review_submit" class="btn btn-primary rounded-pill  fw-600">Publish Review</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
               <?php 
              }else{
                ?>
                <div class="modal fade review-dialog" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                        <button type="button" class="font-25 bg-light border-0 text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                      </div>
                      <div class="modal-body font-18 fw-bold">
                        Sorry you didn't buy the product yet
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php
              }
            }else{
              ?>
              <div class="modal fade review-dialog" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                      <button type="button" class="font-25 bg-light border-0 text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                      Sorry but you have to &nbsp;&nbsp;<a href = "<?php echo $BASE_URL?>/login.php" class="btn btn-warning rounded-pill fw-bold font-18"> Login </a>&nbsp;&nbsp; to write a review
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
      </div>
    </div>
  </section>
  <?php
      }
    }
  ?>

<?php
  require 'inc/footer.php';
?>