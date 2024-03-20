<?php
  require 'inc/head.php';
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: {$BASE_URL}/login.php");
  }
?>
<body>
    <!-- ========================= Header ========================= -->
    <header class="header-wrapper" id="header-wrapper">
       <!-- Nav 1 -->
       <?php
        require 'inc/main-nav.php';

        if(isset($_POST['submit'])){
            $old_pwd =  mysqli_real_escape_string($conn, $_POST['old-pwd']);
            $new_pwd =  mysqli_real_escape_string($conn, $_POST['new-pwd']);
            $user_id =  mysqli_real_escape_string($conn, $_POST['user_id']);

            $number = preg_match('@[0-9]@', $new_pwd);
            $uppercase = preg_match('@[A-Z]@', $new_pwd);
            $lowercase = preg_match('@[a-z]@', $new_pwd);
            $specialChars = preg_match('@[^\w]@', $new_pwd);
        
            if(empty($old_pwd) || empty($new_pwd)|| empty($user_id)){
                echo("<script>location.href = '".$BASE_URL."//change-pass.php?error=Empty Fields!';</script>");
            }else if(strlen($new_pwd) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars){
                echo("<script>location.href = '".$BASE_URL."/change-pass.php?error=Weak Password!';</script>");

            }else if($new_pwd == $old_pwd){
                echo("<script>location.href = '".$BASE_URL."/change-pass.php?error=Same Password!';</script>");
            }else{
                $old_pwd = ENC($old_pwd);
                $sql = "select * from user WHERE id = {$user_id} and pwd = '{$old_pwd}'";
                $result = mysqli_query($conn, $sql) or die($sql);
                if(mysqli_num_rows($result) > 0){
                    $new_pwd = ENC($new_pwd);
                    $sql1 = "Update user set pwd = '{$new_pwd}' WHERE id = {$user_id}";
                    if(mysqli_query($conn, $sql1)){
                         echo("<script>location.href = '".$BASE_URL."/profile.php?success=Password Changed!';</script>");
                    }else{
                        echo("<script>location.href = '".$BASE_URL."/change-pass.php?error=Error!';</script>");
                    }
                }else{
                    echo("<script>location.href = '".$BASE_URL."/change-pass.php?error=Incorrect Password!';</script>");
                }
                
            }
        }

      ?>
    </header>
    <section id="signup" class="mt-4">
        <div class="container">
            <div class="row" style="background-color: #f3f0f036;box-shadow: 0px 8px 17px rgb(0 0 0 / 19%);border-radius:50px;">
                <div class=" col-md-6 d-none d-md-block">
                    <img src="img/forgot.svg" class="img-fluid" style="border-radius:50px">
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center flex-column py-5 py-md-3 py-xl-0">
                <h2>Change Password</h2>
                <p class="font-18 text-primary">Set a strong password so hackers can't hack</p>
                <form class="mt-3" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Old Password</label>
                        <input type="password" name="old-pwd" id="password1" class="form-control border-primary border-2" required>
                        <input type="text" hidden name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                        <div style="cursor:pointer;user-select: none;"><i class="fas fa-eye" id="togglePassword1"><p style="font-family: 'Poppins', sans-serif;font-weight:initial;display:inline;">&nbsp;show password</p></i></div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" name="new-pwd" id="password2" class="form-control border-primary border-2" required>
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
                </form>
                </div>
            </div>
        </div>
    </section>

<?php
  require 'inc/footer.php';
?>
