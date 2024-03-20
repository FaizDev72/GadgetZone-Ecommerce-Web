<!-- Back To Top -->
    <a href="#" class="back-to-top">
      <i class="far fa-long-arrow-up"></i>
    </a>

<!-- Footer -->
<section class="footer bg-dark text-light mt-5 p-3 p-md-5">
    <div class="container m-3 mx-auto ">
      <div class="row justify-content-between justify-content-sm-start justify-content-md-between">
        <div class="col-11 mb-5 mb-md-0 col-md-6 col-lg-4 border-lg-end border-lg-3">
          <div>
            <h3 class="text-uppercase">Gzone</h3>
            <p class="mb-4">Gadget zone is the project made by Faiz, Saqlain, Mithilesh, Abira the students of KVMIT from TYCO</p>
            <div class="social-media ms-3">
              <a href="https://www.facebook.com/kvmitpolytechnic/" target="_blank"><span class="media-icon me-5 me-md-5 h4"><i class="fab fa-facebook-f"></i></span></a>
              <a href="https://www.kvmt.co.in" target="_blank"><span class="media-icon me-5 me-md-5 h4"><i class="fad fa-browser"></i></span></a>
              <a href="https://www.youtube.com/user/kvmitpolytechnic" target="_blank"><span class="media-icon me-5 me-md-5 h4"><i class="fab fa-youtube"></i></i></span></a>
            </div>
          </div>
        </div>
        <div class="col-3 col-md-2 col-lg-1 ms-lg-3">
          <ul class="nav flex-column">
            <li><h4 class="text-uppercase text-secondary">Categories</h4></li>
          <?php
              $sql = "SELECT distinct(name) FROM categories WHERE status = 1 ORDER BY name LIMIT 0, 4";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
          ?>
                  <li class="nav-item pb-2 text-left"><a href="categories.php?catg=<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a></li>
          <?php
            }
          }
          ?>
          </ul>
        </div>
        <div class="col-3 col-md-2 col-lg-1">
          <ul class="nav flex-column">
            <li><h4 class="text-uppercase text-secondary">menu</h4></li>
            <li class="nav-item pb-2"><a href="<?php echo $BASE_URL ?>">Home</a></li>
            <li class="nav-item pb-2"><a href="<?php echo $BASE_URL.'/#product-gallery' ?>">Gallery</a></li>
            <li class="nav-item pb-2"><a href="<?php echo $BASE_URL.'/contact.php' ?>">Contact</a></li>
          </ul>
        </div>
        <div class="col-11 col-lg-4 pt-5 pt-lg-0">
          <a href="https://g.page/KVMIT?share" target="_blank" class="d-flex align-items-center justify-content-between mb-2">
            <span class="media-icon h4 me-5"><i class="fas fa-map-marker-alt"></i></span>
            <p class="text-start font-14 text-break text-white">Plot No. M-3,, Kala Vidyalaya Rd, Malad, Gaikwad Nagar, Malvani, Malad West, Mumbai, Maharashtra 400095</p>
          </a>
          <a href="tel:022 2844 0012" class="d-flex align-items-center mb-4 mb-sm-3 mb-lg-4">
            <span class="media-icon h4 me-5"><i class="fas fa-phone-alt"></i></span>
            <p class="text-start font-18 text-white">022 2844 0012</p>
          </a>
          <a href="mailto:kvmitpolytechnic@gmail.com" class="d-flex align-items-center">
            <span class="media-icon h4 me-5"><i class="fas fa-envelope"></i></span>
            <p class="text-start font-18 text-break text-white">kvmitpolytechnic@gmail.com</p>
          </a>
        </div>
      </div>
    </div>
</section>


    <!-- JQuery script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 

    <!-- Bootstrap css -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- Owl carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- ISO Top script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <!-- Custom script -->
    <script src="js/main.js"></script>

  </body>
</html>