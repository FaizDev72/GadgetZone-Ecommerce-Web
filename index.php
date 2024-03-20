<?php
  require 'inc/head.php';
?>
<body>
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
        $sql6 = "select * from cart where prod_id = {$prod_id} and user_id = {$user_id}";
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
            echo("<script>location.href = '".$BASE_URL."/cart.php?msg=INSERTED';</script>");
          }
        }
        
      }
    ?>
  </header>

  <!-- ==========================Home========================== -->
  <!-- =========================Brands========================= -->
  <?php
  require 'inc/hero-section.php';
  ?>


  <!-- Trending  Products --> 
  <?php
  require 'inc/trending-prod.php';
  ?>


  <!-- Product Gallery -->
  <?php
  require 'inc/product-gallery.php';
  ?>
    
    
<!-- Footer -->
<?php
  require 'inc/footer.php';
?>