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
        if(isset($_POST['delete-ord'])){
          $id = mysqli_real_escape_string($conn, $_POST['id']);
          $qty = mysqli_real_escape_string($conn, $_POST['quantity']);
          if($qty > 1){
            $sql1 = "UPDATE orders SET qty = qty - 1  WHERE id = {$id}";
            if(!mysqli_query($conn, $sql1)){ 
              echo("<script>location.href = '".$BASE_URL."/order.php?msg=Error';</script>");
            }else{
              echo("<script>location.href = '".$BASE_URL."/order.php?msg=Deleted';</script>");
            }
          }else{
            $sql1 = "delete from orders where id = {$id}";
            if(!mysqli_query($conn, $sql1)){ 
              echo("<script>location.href = '".$BASE_URL."/order.php?msg=Error';</script>");
            }else{
              echo("<script>location.href = '".$BASE_URL."/order.php?msg=Deleted';</script>");
            }
          }
          
          
      }
      ?>
    </header>

    <!-- Shopping Cart -->
    <div class="cart-wrapper mb-5">
    <?php
      $sql = "SELECT
        ord.id,
        b.id AS brand_id,
        c.id AS catg_id,
        p.id AS prod_id,
        b.name AS brand_name,
        c.name AS catg_name,
        p.name, p.status,p.img,p.trending,
        p.color, p.mrp, p.description, 
        p.deal_price,p.highlights,
        ord.qty, ord.date, ord.status
      FROM
        orders ord
      INNER JOIN products p ON
        ord.prod_id = p.id
      INNER JOIN categories c ON
        p.catg_id = c.id
      INNER JOIN brands b ON
        c.brand_id = b.id
      WHERE ord.user_id = {$_SESSION['user_id']}
      ORDER BY ord.STATUS DESC";
      $result = mysqli_query($conn, $sql) or die( "Unsuccessfull Query " . $sql);
    ?>
      <h4 class="pt-3 ps-5">Orders</h4>
      <hr>
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-11 cart order-2 order-lg-1" style="box-shadow: 0px 8px 17px rgb(0 0 0 / 19%);border-radius:30px;display: flex;flex-direction: column;align-items: center;justify-content: center;">
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
                          <p class="mb-1">M.R.P : <s class="font-14">$<?php echo $row['mrp'] ?></s></p>
                          <p class="mb-1 text-primary font-18">Deal price : ₹<span><?php echo $row['deal_price'] ?></span></p>
                          <p class="mb-1 font-14">You save : ₹<?php echo $row['mrp'] - $row['deal_price'] . "(" . round(100 * ($row['mrp'] - $row['deal_price']) / $row['mrp'],1) ."%)"?></p>
                          <div class="addtocart-btn d-flex  flex-wrap flex-column">
                            <div class="cart-qty me-2 mb-2 mb-md-0 w-100 mw-100">
                                <label for="">Quantity : </label>
                                <input id="qty<?php echo $row['id'] ?>" type="text" value="<?php echo $row['qty']?>" id="qty" readonly>
                                <?php 
                                if($row['status'] != 'shipped'){
                                  ?>
                                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="d-inline-block">
                                    <input type="text" name="quantity" value="<?php echo $row['qty']?>" hidden>
                                    <input type="text" hidden class="fw-bold" name="id" value="<?php echo $row['id'] ?>">
                                    <button class="btn ms-2" type="submit" name="delete-ord"><i class="text-danger text-center font-25 fad fa-trash-alt"></i></button>
                                  </form>
                                  <?php
                                }
                                ?>
                            </div>
                            <div>Status : <span><?php if($row['status'] == 1) echo '<span class="text-danger">Order Placed <i class="fad fa-map-pin"></i></span>'; else echo '<span class="text-primary">Order Delivered <i class="fad fa-check-circle"></i></span>'?></span></div>
                            <div>Ordered On : <span><?php echo $row['date']?></span></div>
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