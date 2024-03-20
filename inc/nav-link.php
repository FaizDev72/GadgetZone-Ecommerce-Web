<!-- Nav 2 -->
<nav class="navbar navbar-expand-lg nav-2 p-0">
        <div class="container-fluid">
          <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fad fa-stream navbar-toggler-icon mt-2"></i>
          </button>
          <div class="collapse navbar-collapse w-100" id="navbarNav">
            <ul class="navbar-nav m-0 m-auto d-lg-flex align-lg-items-center justify-content-lg-evenly w-100 d-block">
              <?php
              $sql = "SELECT * FROM brands WHERE header = 1 ORDER BY name LIMIT 0, 6";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
              ?>
                  <li class="nav-item has-dropdown">
                    <a class="nav-link">
                      <div class="d-flex align-items-center justify-lg-content-center justify-content-between px-2 p-lg-0"><p class="m-0 me-lg-2 text-center"><?php echo $row['name'] ?></p> <i class="text-center fad fa-chevron-down"></i></div>
                    </a>
                    <div class="dropdown-area d-lg-flex  justify-content-center flex-lg-row flex-column ">
                    <?php
                      $sql1 = "SELECT * FROM categories WHERE brand_id = {$row['id']} and status = 1 LIMIT 0, 3;";
                      $result1 = mysqli_query($conn, $sql1);
                      if(mysqli_num_rows($result1) > 0){
                        while($row1 = mysqli_fetch_assoc($result1)){
                    ?>
                      <ul class="dropdown-nav-menu m-lg-4 m-3 px-lg-0 px-3">
                        <h5 class="font-16"><?php echo $row1['name'] ?></h5>
                        <?php
                          $sql2 = "SELECT * FROM products WHERE catg_id = {$row1['id']} and status = 1 LIMIT 0, 4;";
                          $result2 = mysqli_query($conn, $sql2);
                          if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                        ?>
                        <li class="dropdown-nav-item border-bottom" style="font-size:15px"><a class="nav-link text-nowrap" href="product.php?id=<?php echo $row2['id']?>"><?php echo substr($row2['name'], 0,25).'...' ?></a></li>
                        <?php
                            }
                          }
                        ?>
                      </ul>
                      <?php
                        }
                      }
                      ?>
                      <!-- <div class="dropdown-img m-5 d-none d-lg-flex">
                        <a href="">
                          <img src="img/vivo.svg" alt="" class="img-fluid ">
                        </a>
                      </div> -->
                    </div>
                  </li>
              <?php
                }
              }
              ?>
              
              <li class="nav-item">
                <a class="nav-link" href="contact.php">
                  <div class="d-flex align-items-center justify-content-lg-center"><p class="m-0 me-lg-2 text-center ">Contact</p></div></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>