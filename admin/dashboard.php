<?php
    require 'inc/head.php';
?>
<body>
    <?php
        require 'inc/slider-nav.php';
    ?>

    <!-- Dashboard -->
      <section class="dashboard-wrapper">
        <div class="container text-light ">
          <h4 class="mb-5">Dashboard</h4>
          <div class="row align-items-center justify-content-between">
            <div class="col-xl-8 mb-4">
              <div class="row align-items-center justify-content-around mx-auto gap-4">
                <div style="background-color: #b658f6;" class="dash-analysis-box col-lg-3 col-md-5 col-sm-5 px-4 py-3 d-flex flex-column">
                  <div class="dash-content d-flex align-items-center justify-content-between">
                    <span>
                      <h5>Products</h5>
                      <h3>34534</h3>
                      <!-- #e2e2e2 -->
                    </span>
                    <div class="dash-symbol"><i class="fas fa-shopping-bag font-25"></i></div>
                  </div>
                  <span class="dash-graph  align-self-center mt-2"><i class="fad fa-analytics"></i></span>
                </div>
                <div style="background-color: #FEC400;" class="dash-analysis-box col-lg-3 col-md-5 col-sm-5 px-4 py-3 d-flex flex-column">
                  <div class="dash-content d-flex align-items-center justify-content-between">
                    <span>
                      <h5>Users</h5>
                      <h3>34534</h3>
                      <!-- #e2e2e2 -->
                    </span>
                    <div class="dash-symbol"><i class="fas fa-shopping-bag font-25"></i></div>
                  </div>
                  <span class="dash-graph align-self-center mt-2"><i class="fal fa-chart-network"></i></span>
                </div>
                <div style="background: rgb(64, 115, 241);background: linear-gradient(3deg,rgba(64, 115, 241, 1) 0%,rgba(93, 146, 245, 1) 100%);" class="dash-analysis-box col-lg-3 col-md-5 col-sm-5 px-4 py-3 d-flex flex-column">
                  <div class="dash-content d-flex align-items-center justify-content-between">
                    <span>
                      <h5>Sales</h5>
                      <h3>34534</h3>
                      <!-- #e2e2e2 -->
                    </span>
                    <div class="dash-symbol"><i class="fas fa-shopping-bag font-25"></i></div>
                  </div>
                  <span class="dash-graph align-self-center mt-2"><i class="fad fa-chart-bar"></i></span>
                </div>
                <div style="background-color:#f63858;" class="dash-analysis-box col-lg-3 col-md-5 col-sm-5 px-4 py-3 d-flex flex-column">
                  <div class="dash-content d-flex align-items-center justify-content-between">
                    <span>
                      <h5>Total Orders</h5>
                      <h3>34534</h3>
                      <!-- #e2e2e2 -->
                    </span>
                    <div class="dash-symbol"><i class="fas fa-shopping-bag font-25"></i></div>
                  </div>
                  <span class="dash-graph  align-self-center mt-2"><i class="fal fa-chart-area"></i></span>
                </div>
                <div style="background-color:#a1266c;" class="dash-analysis-box col-lg-3 col-md-5 col-sm-5 px-4 py-3 d-flex flex-column">
                  <div class="dash-content d-flex align-items-center justify-content-between">
                    <span>
                      <h5>Pending Orders</h5>
                      <h3>34534</h3>
                      <!-- #e2e2e2 -->
                    </span>
                    <div class="dash-symbol"><i class="fas fa-shopping-bag font-25"></i></div>
                  </div>
                  <span class="dash-graph align-self-center mt-2"><i class="fal fa-chart-scatter"></i></span>
                </div>
                <div style="background-color:#8dc700;" class="dash-analysis-box col-lg-3 col-md-5 col-sm-5 px-4 py-3 d-flex flex-column">
                  <div class="dash-content d-flex align-items-center justify-content-between">
                    <span>
                      <h5>Pending Queries</h5>
                      <h3>34534</h3>
                      <!-- #e2e2e2 -->
                    </span>
                    <div class="dash-symbol"><i class="fas fa-shopping-bag font-25"></i></div>
                  </div>
                  <span class="dash-graph align-self-center mt-2"><i class="far fa-chart-line-down"></i></span>
                </div>
              </div>
              <!-- <div class="row align-items-center justify-content-around mx-auto mt-4">
              
              </div> -->
            </div>
            <div class="col-xl-4 dash-top-selling bg-light text-black px-3">
              <h4>Top Selling products</h4>
              <div class="dash-product-list mt-3">
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
                <div class="dash-item d-flex align-items-center mb-3 p-2 border-bottom border-secondary">
                  <img src="../img/vivomob3.jpg" alt="" class="img-fluid me-5">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="">Redmi note 8</span>
                    <span>Sales <br>43434</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </div>
      </section>

<?php
  require 'inc/footer.php';
?>