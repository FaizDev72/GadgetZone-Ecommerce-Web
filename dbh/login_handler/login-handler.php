<?php
if(isset($_POST['submit'])){
    require '../conn.php';
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $pwd =  mysqli_real_escape_string($conn, $_POST['pwd']);

    if(empty($email) || empty($pwd)){
        header("Location: ".$BASE_URL."/login.php?error=Empty Fields!");
    }else{
        $pwd = ENC($pwd);
        $sql = "SELECT * FROM user WHERE email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                if($pwd == $row['pwd']){
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    header("Location: ".$BASE_URL."/index.php?success=login");
                }else{
                    header("Location: ".$BASE_URL."/login.php?error=Incorrect Password!");
                }
            }
        }else{
            header("Location: ".$BASE_URL."/login.php?error=Incorrect Email Address!");
        }
    }
}