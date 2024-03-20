<?php
  require 'inc/head.php';
?>
<body>
    <!-- ========================= Header ========================= -->
    <header class="header-wrapper" id="header-wrapper">
       <!-- Nav 1 -->
       <?php
        require 'inc/main-nav.php';
      ?>
    </header>
    <section id="signup" class="mt-4">
        <div class="container">
            <div class="row" style="background-color: #f3f0f036;box-shadow: 0px 8px 17px rgb(0 0 0 / 19%);border-radius:50px;">
                <div class=" col-md-6 d-none d-md-block">
                    <img src="img/login.svg" class="img-fluid" style="border-radius:50px">
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center flex-column py-5 py-md-3 py-xl-0">
                <h2>LOGIN IN</h2>
                <p class="font-18 text-primary">Get access to your Orders, Recommendations and much more</p>
                <form class="mt-3" action="dbh/login_handler/login-handler.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control border-primary border-2" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="pwd" id="password1" class="form-control border-primary border-2" required>
                        <div style="cursor:pointer;o-select: none;"><i class="fas fa-eye" id="togglePassword1"><p style="font-family: 'Poppins', sans-serif;font-weight:initial;display:inline;">&nbsp;show password</p></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-3 me-3 mb-2"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
                        <div class="col-12 col-sm-8">
                            <?php
                             if(isset($_GET['error'])){
                                $error = $_GET['error'];
                                echo '<div class="alert alert-danger w-auto fw-bold font-14 m-0 p-2" role="alert">
                                '.$error.'
                            </div>';
                            }
                            if(isset($_GET['success'])){
                                $success = $_GET['success'];
                                echo '<div class="alert alert-success w-auto fw-bold font-14 m-0 p-2" role="alert">
                                '.$success.'
                            </div>';
                            }
                            ?>
                        </div>
                    </div>
                    <p class="text-center mt-2"><a href="signup.php ">Don't have an account?register now</a></p>
                </form>
                </div>
            </div>
        </div>
    </section>

<?php
  require 'inc/footer.php';
?>
