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
    </header>
    <section id="signup" class="mt-4">
        <div class="container">
            <div class="row" style="background-color: #f3f0f036;box-shadow: 0px 8px 17px rgb(0 0 0 / 19%);border-radius:50px;">
                <div class=" col-md-6 d-none d-md-block">
                    <img src="img/signup.svg" class="img-fluid" style="border-radius:50px">
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center flex-column py-5 py-md-3 py-xl-0">
                <h2>SIGN UP</h2>
                <p class="font-18 text-primary">Looks like you're new here!</p>
                <form class="mt-3" action="dbh/signup_handler/signup-handler.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="form-label">First Name*</label><br>
                            <input type="text" name="fname" class="form-control border-primary border-2" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Last Name*</label><br>
                            <input type="text" name="lname" class="form-control border-primary border-2" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email address*</label>
                        <input type="email" name="email" class="form-control border-primary border-2"  required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password*</label>
                        <input type="password" id="password1" name="pwd" class="form-control border-primary border-2"  required>
                        <div style="cursor:pointer;user-select: none;"><i class="fas fa-eye" id="togglePassword1"><p style="font-family: 'Poppins', sans-serif;font-weight:initial;display:inline;">&nbsp;show password</p></i> &nbsp;*[0-8,A-Z,a-z,^\w]</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password*</label>
                        <input type="password" id="password2" name="confirmpwd" class="form-control border-primary border-2"  required>
                        <div style="cursor:pointer;user-select: none;"><i class="fas fa-eye" id="togglePassword2"><p style="font-family: 'Poppins', sans-serif;font-weight:initial;display:inline;">&nbsp;show password</p></i></div>
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
                    
                    <p class="text-center mt-2"><a href="login.php ">Have an account?Login in</a></p>
                </form>
                </div>
            </div>
        </div>
    </section>

<?php
  require 'inc/footer.php';
?>
