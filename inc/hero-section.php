<!-- ==========================Home========================== -->
<section class="home">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators ">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/Banner1.jpg" class="d-block w-100" alt="..."  >
          </div>
          <div class="carousel-item">
            <img src="img/Banner2.jpg" class="d-block w-100 " alt="..." >
          </div>
          <div class="carousel-item">
            <img src="img/Banner3.jpg" class="d-block w-100" alt="..." >
          </div>
          <div class="carousel-item">
            <img src="img/Banner4.jpg" class="d-block w-100" alt="..." >
          </div>
          <div class="carousel-item">
            <img src="img/banner5.jpg" class="d-block w-100" alt="..." >
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
          <div class="slider-icon-prev">
            <i class="far fa-chevron-left"></i>
            <span class="visually-hidden ">Previous</span>
          </div>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
          <div class="slider-icon-next">
            <i class="far fa-chevron-right"></i>
            <span class="visually-hidden">Next</span>
          </div>
        </button>
      </div>
    </section>

    <!-- =========================Brands========================= -->
    <section class="brand-wrapper py-4">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-md-center flex-nowrap">
          <?php
            $sql = "SELECT DISTINCT(name) From categories WHERE status = 1;";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
            ?>
                <div class="col-2 d-flex align-items-center justify-content-center">
                  <a href="categories.php?catg=<?php echo $row['name'] ?>" class="brand d-flex align-items-center justify-content-center">
                    <span class="catg-font font-16 text-dark text-dark fw-bold" style="letter-spacing:2px;"><?php echo $row['name'] ?></span>
                  </a>
                </div>
            <?php
              }
            }
          ?>
          
        </div>
      </div>
    </section>