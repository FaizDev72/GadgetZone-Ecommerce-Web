<?php
  require 'inc/head.php';
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: {$BASE_URL}/login.php");
  }
?>
<body>
  <!-- =========================Header========================= -->
  <header class="header-wrapper" id="header-wrapper">
    <!-- Nav 1 -->
    <?php
      require 'inc/main-nav.php';

    // Update Profile
    if(isset($_POST['submit'])){
      $id = mysqli_real_escape_string($conn, $_POST['id']);
      $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
      $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $gender = mysqli_real_escape_string($conn, $_POST['gender']);
      $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
      $address = mysqli_real_escape_string($conn, $_POST['address']);

    

    if(empty($_FILES['img']['name'])){
      $sql = "update user set f_name = '{$f_name}', l_name = '{$l_name}',email = '{$email}',gender = '{$gender}',mobile = {$mobile},address = '{$address}' where id = {$id}";
      if(!mysqli_query($conn, $sql)){
        echo("<script>location.href = '".$BASE_URL."/profile.php?error=ERROR';</script>");
      }else{
        echo("<script>location.href = '".$BASE_URL."/profile.php?success=UPDATED';</script>");
      }
    }else{
      $file = $_FILES['img'];
      $fileName = $_FILES['img']['name'];
      $fileTmpName = $_FILES['img']['tmp_name'];
      $fileSize = $_FILES['img']['size'];
      $fileError = $_FILES['img']['error'];
      $fileType = $_FILES['img']['type'];
      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg','jpeg','webp','png','svg','jfif');

      if(in_array($fileActualExt, $allowed)){
          if($fileError === 0){
              if($fileSize < 2000000){
                  $fileNewName = uniqid('',true).".".$fileActualExt;
                  $fileDestination = 'admin/uploads/'.$fileNewName;
                  $sql = "update user set f_name = '{$f_name}', l_name = '{$l_name}',email = '{$email}',gender = '{$gender}',mobile = {$mobile},address = '{$address}',img = '{$fileNewName}' where id = {$id}";
                  if(!mysqli_query($conn, $sql)){ 
                    echo("<script>location.href = '".$BASE_URL."/profile.php?error=ERROR';</script>");;
                  }else{
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo("<script>location.href = '".$BASE_URL."/profile.php?success=INSERTED';</script>");
                  }
              }else{
                  header("Location: ".$BASE_URL."/profile.php?error=File size is too Big!");
                  echo("<script>location.href = '".$BASE_URL."/profile.php?error=File size is too Big!';</script>");

              }
          }else{
            echo("<script>location.href = '".$BASE_URL."/profile.php?error=Error in the file!';</script>");            
          }
      }else{
        echo("<script>location.href = '".$BASE_URL."/profile.php?error=Format not supported!';</script>");         
      }
    } 

      
    }
    ?>
  <!-- </header> -->

    <div class="profile-wrapper">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <h4 class="text-uppercase ps-5 pt-3 m-0">my profile</h4>
        <hr>
        <?php 
        $sql = "select * from user where id = {$_SESSION['user_id']}";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
          while($row = mysqli_fetch_assoc($result)){
          ?>
          <div class="container">
            <div class="row  justify-content-between" style="border-radius:50px;background:#cccccc21;box-shadow: 0px 8px 17px rgba(0, 0, 0, 0.19);">
                <div class="col-lg-3 mb-5 mb-lg-0 p-4">
                    <div class="profile-image mb-3 mx-auto bg-light rounded-circle">
                        <img src="<?php if(empty($row['img'])) echo 'img/profile-pic-male_4811a1.svg'; else echo 'admin/uploads/'.$row['img']  ?>" class="img-fluid rounded-circle">
                    </div>
                    <div class="profile-image-btn">
                        <div class="d-flex align-items-center justify-content-center">
                          <div class="upload-btn-wrapper me-3 rounded-pill" style="box-shadow: 0px 3px 14px rgba(0, 0, 0, 0.25);width:78px;" >
                            <button class="file-btn btn btn-primary rounded-pill w-100" >Edit</button>
                            <input id="file-input" type="file" name="img" />
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 p-4 profile-info">
                  <h4>Personal Infomation</h4>
                  <!-- <div action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="profile-info-form"> -->
                  <div class="profile-info-form">
                      <div class="mb-3">
                          <input type="text" name="id" value="<?php echo $row['id'] ?>" hidden class="me-0 me-md-2 mb-3 mb-md-0" required>
                          <input type="text" name="f_name" value="<?php echo $row['f_name'] ?>" placeholder="first Name" class="me-0 me-md-2 mb-3 " required>
                          <input type="text" name="l_name" value="<?php echo $row['l_name'] ?>" placeholder="last Name" required>
                      </div>
                      <div class="mb-3">
                          <span>Your Gender</span>
                          <br>
                          <input type="radio" name="gender" id="male" <?php if($row['gender'] == 0) echo 'checked'?>  >
                          <label for="male">male</label>
                          <input type="radio" name="gender" id="female" <?php if($row['gender'] == 1) echo 'checked'?>>
                          <label for="female">female</label>
                      </div>
                      <div class="mb-3">
                          <span>Email Address</span>
                          <br>
                          <input type="email" name="email" value="<?php echo $row['email']?>" placeholder="abc@gmail.com"  required>
                      </div>
                      <div class="mb-3">
                          <span>Mobile Number</span>
                          <br>
                          <input type="number" name="mobile" value="<?php echo $row['mobile']?>" placeholder="91+ 1234 5677 899"  required>
                      </div>
                      <div class="mb-3">
                          <span>Address</span>
                          <br>
                          <textarea type="text" name="address" placeholder="213/12 building land mark" col="40" required><?php echo $row['address']?></textarea>
                      </div>
                      <button style="box-shadow: 0px 3px 14px rgba(0, 0, 0, 0.25);" class="btn
                      profile-save-btn btn-primary rounded-pill me-3 mb-sm-0 mb-3" type="submit" name="submit">Save Changes</button>
                      <a href="change-pass.php" style="box-shadow: 0px 3px 14px rgba(0, 0, 0, 0.25);" class="btn
                      profile-save-btn btn-primary rounded-pill me-3">Change Password</a>
                      <?php
                        // Message
                        if(isset($_GET['error'])){
                          $error = $_GET['error'];
                          echo '<div class="alert alert-danger w-auto fw-bold font-14" role="alert" style="display:inline-block;">
                          '.$error.'
                          </div>';
                        }
                        if(isset($_GET['success'])){
                          $success = $_GET['success'];
                          echo '<div class="alert alert-success w-auto fw-bold font-14" role="alert" style="display:inline-block;" >
                          '.$success.'
                          </div>';
                        }
                      ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        }
        ?>
        
          </form>
    </div>

<!-- Footer -->
<?php
  require 'inc/footer.php';
?>