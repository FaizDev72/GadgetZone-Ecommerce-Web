<!-- Trending  Products --> 
<section class="trending-product-wrapper">
  <div class="container">
    <h3 class="text-left">Trending Products</h3>
    <hr>
    <div class="owl-carousel">
      <?php
      $sql = "SELECT 
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
              WHERE p.status = 1 and trending = 1";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
      ?>
          <div class="item p-2">
            <a href="product.php?id=<?php echo $row['id'] ?>">
              <div class="mb-2"><img src="<?php echo 'admin/uploads/'.$row['img'] ?>" class="img-fluid h-100 w-auto" alt=""></div>
            </a>
            <div class="text-left trend-content">
              <h5><?php echo substr($row['name'], 0,40).'...' ?></h5>
              <p class="mb-1">M.R.P : <s>₹<?php echo $row['mrp'] ?></s></p>
              <p class="mb-1">Deal price : <span class="h5">₹<?php echo $row['deal_price'] ?></span></p>
              <p class="mb-2">You save : <?php echo $row['mrp'] - $row['deal_price'] . "(" . round(100 * ($row['mrp'] - $row['deal_price']) / $row['mrp'],1) ."%)"?></p>
              <?php 
              if(isset($_SESSION['user_id']) and isset($_SESSION['email'])){
              ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                <input type="text" name="prod_id" value="<?php echo $row['id'] ?>" hidden>
                <button class="btn btn-outline-primary rounded-pill font-14 fw-bold cart-global-btn" type="submit" name="add-to-cart">Add to Cart</button>
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
      <?php
        }
      }
      ?>
      
    </div>
  </div>
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
</section>