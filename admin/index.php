<?php
    include_once '../dbh/conn.php';
    session_start();
    if(isset($_SESSION['admin_id'])) {
        header("Location: {$BASE_URL}/admin/brand.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/mi-redmi-9-lpddr4x-original-imafv5kyeqsgxgzz.jpeg" type="image/x-icon">

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Fontawesome script -->
    <script src="js/fontawsome.js"></script>

    
</head>
<body style="height:100vh;" class="d-flex align-items-center justify-content-center">
    <section id="signup" class="mx-auto">
        <div class="container">
            <div class="row" style="background-color: #f3f0f036;box-shadow: 0px 8px 17px rgb(0 0 0 / 19%);border-radius:50px;">
                <div class=" col-md-6 d-none d-md-block" >
                    <img src="img/admin_login.svg" class="img-fluid" style="border-radius:50px">
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center flex-column py-5 py-md-3 py-xl-0">
                <h2>ADMIN LOGIN</h2>
                <p class="font-18 text-primary">Get access to Admin Panel, Dashboard and Admin control</p>
                <form class="mt-3" action="dbh/login_handler/login-handler.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">User name</label>
                        <input type="text" name="email" class="form-control border-primary border-2"  aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="pwd" id="password1" class="form-control border-primary border-2"  aria-describedby="emailHelp">
                        <div style="cursor:pointer;user-select: none;"><i class="fas fa-eye" id="togglePassword1"><p style="font-family: 'Poppins', sans-serif;font-weight:initial;display:inline;">&nbsp;show password</p></i></div>
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

    <!-- Custom Script -->
    <script src="js/main.js"></script>
<?php
  require 'inc/footer.php';
?>
