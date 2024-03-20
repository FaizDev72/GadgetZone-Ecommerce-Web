<?php
    require 'inc/head.php';
    if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
      header("Location: {$BASE_URL}/login.php");
    }
?>
<body>
    <!-- =========================Header========================= -->
    <header class="header-wrapper" id="header-wrapper">
       <!-- Nav 1 -->
       <?php
        require 'inc/main-nav.php';
        require_once 'dbh/conn.php';

        // Delete cart
        if(isset($_POST['delete-cart'])){
          $id = mysqli_real_escape_string($conn, $_POST['id']);
          $sql1 = "delete from cart where id = {$id}";
          if(!mysqli_query($conn, $sql1)){ 
            echo("<script>location.href = '".$BASE_URL."/cart.php?&msg=ERROR';</script>");
          }else{
            echo("<script>location.href = '".$BASE_URL."/cart.php?&msg=Success';</script>");
          }
        }

        //  Buy Now
        if(isset($_POST['buy'])){
          $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
          $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
          $name = mysqli_real_escape_string($conn, $_POST['name']);
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $address = mysqli_real_escape_string($conn, $_POST['address']);
          $city = mysqli_real_escape_string($conn, $_POST['city']);
          $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

          $sql1 = "INSERT INTO orders(prod_id, user_id, qty, name, email, address, mobile, city, date, status) values({$prod_id}, {$user_id}, 1, '{$name}', '{$email}', '{$address}', {$mobile}, '{$city}', Now(), 1)";
          if(!mysqli_query($conn, $sql1)){ 
            echo("<script>location.href = '".$BASE_URL."/order.php?msg=ERROR';</script>");
          }else{
            echo("<script>location.href = '".$BASE_URL."/order.php?msg=INSERTED';</script>");
          }
        }
      ?>
    </header>

    <!-- Shopping Cart -->
    <div class="cart-wrapper mb-5">
    <?php
      $sql = "SELECT
        ct.id,
        b.id AS brand_id,
        c.id AS catg_id,
        p.id AS prod_id,
        b.name AS brand_name,
        c.name AS catg_name,
        p.name, p.status,p.img,p.trending,
        p.color, p.mrp, p.description, 
        p.deal_price,p.highlights,ct.qty
      FROM
        cart ct
      INNER JOIN products p ON
        ct.prod_id = p.id
      INNER JOIN categories c ON
        p.catg_id = c.id
      INNER JOIN brands b ON
        c.brand_id = b.id
      WHERE ct.user_id = {$_SESSION['user_id']}";
      $result = mysqli_query($conn, $sql) or die( "Unsuccessfull Query " . $sql);
    ?>
      <h4 class="pt-3 ps-5">Shopping Cart</h4>
      <hr>
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-11 cart order-2 order-lg-1" style="box-shadow: 0px 8px 17px rgb(0 0 0 / 19%);border-radius:30px">
            <?php
              if(mysqli_num_rows($result) > 0){
                $counter = 1;
                  while($row = mysqli_fetch_assoc($result)){
            ?>
                    <div class="cart-item row border-bottom p-4" >
                      <input id="cart-id<?php echo $counter ?>" type="text" value="<?php echo $row['id'] ?>" hidden>
                      <div class="row">
                        <div class="col-lg-3 col-12 card-item-imgbox d-flex  align-items-center justify-content-center border-end cart-img-box">
                          <a href="product.php?id=<?php echo $row['prod_id'] ?>">
                            <img class="img-fluid" src="<?php echo 'admin/uploads/'.$row['img'] ?>" alt="">
                          </a>
                        </div>
                        <div class="col-lg-7 col-12">
                          <h5 class="cart-item-name"><?php echo $row['name']?></h5>
                          <p class="mb-1 text-muted">M.R.P : <s class="font-14">₹<?php echo $row['mrp'] ?></s></p>
                          <p class="mb-1 text-primary font-18">Deal price : $<span><?php echo $row['deal_price'] ?></span></p>
                          <p class="mb-1 font-14">You save : ₹<?php echo $row['mrp'] - $row['deal_price'] . "(" . round(100 * ($row['mrp'] - $row['deal_price']) / $row['mrp'],1) ."%)"?></p>
                          <div class="addtocart-btn d-flex align-items-center flex-wrap">
                            <div class="cart-qty me-2 mb-2 mb-md-0">
                              <span class="border-end text-center me-0 me-md-2 px-2" onclick="updateQty(<?php echo $row['id'] ?>,'decrement', 'qty<?php echo $row['id'] ?>')"><i class="fal fa-minus"></i></span>
                              <input id="qty<?php echo $row['id'] ?>" type="text" value="<?php echo $row['qty']?>" id="qty" readonly>
                              <span class="border-start text-center ms-0 ms-md-2 px-2" onclick="updateQty(<?php echo $row['id'] ?>, 'increment', 'qty<?php echo $row['id'] ?>')"><i class="fal fa-plus"></i></span>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                              <input type="text" hidden name="id" value="<?php echo $row['id'] ?>">
                              <button class="btn mx-0" type="submit" name="delete-cart"><i class="text-danger text-center font-25 fad fa-trash-alt"></i></button>
                            </form>
                            <button class="btn btn-outline-primary font-14 fw-bold ms-2" type="submit" name="cart_submit" data-bs-toggle="modal" data-bs-target="#buyModal<?php echo $row['id']?>">BUY</button>
                            <!-- Modal -->
                            <div class="modal fade" id="buyModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="buyModal<?php echo $row['id']?>Label" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="buyModal<?php echo $row['id']?>Label">Shipping Details</h5>
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
                                          <input type="text" class="form-control border-primary border-2" value="<?php echo $row['prod_id'] ?>" name = "prod_id" hidden>
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
                                            <input type="text" class="form-control border-primary border-2"  value="<?php echo $row5['mobile'] ?>" required name="mobile">
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
                          </div>
                        </div>
                      </div>
                    </div>
            <?php
                }
              }else{
                echo "<h4 class='p-3'>NO RESULT FOUND</h4>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
<?php
  require 'inc/footer.php';
?>