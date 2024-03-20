<?php
  require 'inc/head.php';
?>
<body>
  <!-- =========================Header========================= -->
  <header class="header-wrapper" id="header-wrapper">
      <!-- Nav 1 -->
      <?php
      require 'inc/main-nav.php';

      // Insert Query
      if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $msg = mysqli_real_escape_string($conn, $_POST['msg']);

        $sql1 = "INSERT into contact(name, email, mobile, msg, status, date) VALUES('{$name}', '{$email}', '$mobile', '$msg', 1, Now());";
        if(!mysqli_query($conn, $sql1)){ 
            header("Location: ".$BASE_URL."/contact.php?error=Query Failed!");
        }else{
                header("Location: ".$BASE_URL."/contact.php?success=Message Sent!");
        }
        
    }
    ?>
  </header>

  <!-- Contact -->
  <div class="contact-wrapper mt-5">
    <div class="container">
      <h4 class="text-center fw-bolder">Get in touch</h4>
      <p class="text-center" style="color:#0d6efdbf;font-weight: 600;">Contact us for a quote</p>
      <div class="row justify-content-center align-items-center p-2 ">
        <a href="#map" class="col-xl-2 col-sm-5  contact-box d-flex align-items-center justify-content-around flex-column">
          <i class="mb-3 fas fa-map-marker-alt"></i>
          <span class="" >Malad(W), Mumbai-95</span>
        </a>
        <a href="tel:022 2844 0012" class="col-xl-2 col-sm-5  contact-box d-flex align-items-center justify-content-around flex-column">
          <i class="mb-3 fas fa-phone-alt"></i>
          <span class="" >022 2844 0012</span>
        </a>
        <a href="mailto:kvmitpolytechnic@gmail.com" class="col-xl-2 col-sm-5  contact-box d-flex align-items-center justify-content-around flex-column">
          <i class="mb-3 fas fa-envelope"></i>
          <span class="" >kvmitpolytechnic@gmail.com</span>
        </a>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="row p-4 contact-form  border border-2 border-primary">
          <div class="col-xl-6">
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <div style="position: relative;" class="input-box">
                <span><i class="far fa-circle border-2 border-dark border-bottom"></i></span>
                <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="mail" class="form-label">Mail</label>
              <div style="position: relative;" class="input-box">
                <span><i class="far fa-envelope"></i></span>
                <input type="email" class="form-control" id="mail" name="email" placeholder="name@example.com" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone no.</label>
              <div style="position: relative;" class="input-box">
                <span><i class="far fa-mobile"></i></span>
                <input type="number" class="form-control" id="phone" name="mobile " placeholder="123455666s" required>
              </div>
            </div>
          </div>
          <div class="col-xl-6 input-textarea">
            <div class="mb-3">
              <label for="message" class="form-label">Messsage</label>
              <textarea class="form-control" required id="message" rows="8" name="msg" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto laborum nam quo. Nisi sit, consequatur iure expedita labore libero architecto.
              "></textarea>
            </div>
          </div>
          <button class="btn btn-primary contact-send-btn m-auto mt-3" name="submit">Send Message</button>
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
    </form>
      <div class="row my-5 contact-map" id="map">
        <div class="col-12">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.2912303005173!2d72.81091231473141!3d19.18247818702691!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b69ad57f6db5%3A0xc4cf9f5fd372155b!2sKala%20Vidya%20Mandir%20Institiute%20of%20Technology%20(Polytechnic)!5e0!3m2!1sen!2sin!4v1641013989166!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>

<?php
  require 'inc/footer.php';