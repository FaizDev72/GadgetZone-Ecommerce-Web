<section class="product-gallery-wrapper" id="product-gallery">
      <div class="container">
        <h3 class="text-left">Products Gallery</h3>
        <hr>
        <div class="row">
          <div id="filters" class="col-12 button-group d-flex align-items-center justify-content-evenly flex-wrap" >
            <button type="button" class="btn rect-btn my-xl-0 my-2 is-checked active-btn" data-filter="*">All Brands</button>
            
            <?php
              $sql = "SELECT DISTINCT(name) From categories WHERE status = 1 LIMIT 0, 6;";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
              ?>
                  <button type="button" class="btn rect-btn my-xl-0 my-2" data-filter=".<?php echo $row['name'] ?>"><?php echo $row['name'] ?></button>
              <?php
                }
              }
            ?>
          </div>
        </div>
        <div class="mt-5 d-flex align-items-center justify-content-center">
          <div class="grid gallery">
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
                        WHERE p.status = 1";
                $result1 = mysqli_query($conn, $sql1);
                if(mysqli_num_rows($result1) > 0){
                  while($row1 = mysqli_fetch_assoc($result1)){
                ?>
                    <div class="grid-item <?php echo $row1['catg_name'] ?>">
                      <div class="item p-2 " style="width: 250px;height: auto;">
                        <a href="product.php?id=<?php echo $row1['id'] ?>">
                          <div class="mb-2"><img src="admin/uploads/<?php echo $row1['img'] ?>" class="img-fluid h-100 w-auto" alt="Faiz"></div>
                        </a>
                        <div class="text-left trend-content">
                          <h5><?php echo substr($row1['name'], 0,40).'...' ?></h5>
                          <p class="mb-1">M.R.P : <s>₹<?php echo $row1['mrp'] ?></s></p>
                          <p class="mb-1">Deal price : <span class="h5">₹<?php echo $row1['deal_price'] ?></span></p>
                          <p class="mb-2">You save : <?php echo $row1['mrp'] - $row1['deal_price'] . "(" . round(100 * ($row1['mrp'] - $row1['deal_price']) / $row1['mrp'],1) ."%)" ?></p>
                          <?php 
                          if(isset($_SESSION['user_id']) and isset($_SESSION['email'])){
                          ?>
                          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="text" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                            <input type="text" name="prod_id" value="<?php echo $row1['id'] ?>" hidden>
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
                    </div>
                <?php
                  }
                }
              ?>
          </div>
        </div>
      </div>
    </div>
</section>