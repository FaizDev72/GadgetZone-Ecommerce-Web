<!-- Nav 1 -->
<nav class="navbar bg-primary nav-1" id="nav-1">
  <div class="container-fluid">
    <!-- Navbar Brand -->
    <a class="navbar-brand text-light order-lg-1" href="index.php"><h1 class="h2 px-lg-5">Gzone</h1></a>
    <!-- Search bar -->
    <form class="d-flex border border-2 rounded-pill border-dark bg-white order-3 order-md-2 overflow-hidden" action="search.php" method="GET"> 
      <input class="form-control me-2 ps-lg-4  border-0 border search rounded-pill" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn  rounded-circle m-1 border-0 search_btn" type="submit"><i class="fas text-dark fa-search"></i></button>
    </form>
    <!-- My Account Web -->
    <ul class="nav-1-ul m-0 me-4 p-0 d-none d-lg-flex order-3">
      <?php
        if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
      ?> 
          <li class="nav-item">
            <a href="cart.php" class="position-relative nav-link">
              <i class="fad fa-shopping-cart"></i> Cart
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
              <?php $result =  mysqli_query($conn, "select * from cart where user_id = {$_SESSION['user_id']}"); echo mysqli_num_rows($result) ?>              
              <span class="visually-hidden">New alerts</span>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="order.php" class="position-relative nav-link">
              <i class="fad fa-bags-shopping"></i> Order
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
              <?php $result =  mysqli_query($conn, "select * from orders where user_id = {$_SESSION['user_id']} and status =! 'placed'"); echo mysqli_num_rows($result) ?>              
              <span class="visually-hidden">New alerts</span>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link"><i class="fad fa-user"></i> Profile</a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link"><i class="fad fa-sign-out-alt"></i> Logout</a>
          </li>
      <?php
        }else{
      ?>
          <li class="nav-item">
            <a href="signup.php" class="nav-link"><i class="fad fa-sign-in-alt"></i> Signup</a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link"><i class="fad fa-sign-in-alt"></i> Login</a>
          </li>
      <?php
        }
      ?>
    </ul>
    <!-- My Account Mobile -->
      <?php
      if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
      ?>
      
      <div class="dropdown order-2 my-account d-lg-none order-md-3">
        <a class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fad fa-user-circle"></i> My Account
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li>
            <a class="dropdown-item" href="cart.php"><i class="fad fa-shopping-cart"></i> Cart</a>
          </li>
          <li>
            <a class="dropdown-item" href="order.php"><i class="fad fa-bags-shopping"></i> Order</a>
          </li>
          <li>
            <a class="dropdown-item" href="profile.php"><i class="fad fa-user"></i> Profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="logout.php"><i class="fad fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
    </div>
    <?php
      }else{
      ?>
        <ul class="nav-1-ul d-lg-none order-md-3">
          <li class="nav-item border-0">
            <a href="signup.php" class="nav-link" style="padding-top:0px !important;"></i> Signup / </a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link" style="padding-top:0px !important;">&nbsp; Login </a>
          </li>
        </ul>
      <?php
      }
      ?>
  </div>
</nav>