<?php
if(isset($_POST['submit'])){
    require '../conn.php';
    $fName =  mysqli_real_escape_string($conn, $_POST['fname']);
    $lName =  mysqli_real_escape_string($conn, $_POST['lname']);
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $pwd =  mysqli_real_escape_string($conn, $_POST['pwd']);
    $confirmPwd =  mysqli_real_escape_string($conn, $_POST['confirmpwd']);

    $number = preg_match('@[0-9]@', $pwd);
    $uppercase = preg_match('@[A-Z]@', $pwd);
    $lowercase = preg_match('@[a-z]@', $pwd);
    $specialChars = preg_match('@[^\w]@', $pwd);

    if(empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($confirmPwd)){
        header("Location: ../../signup.php?error=Empty Fields!");
    }else if(strlen($pwd) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars){
        header("Location: ../../signup.php?error=Weak Password!");
    }else if($pwd !== $confirmPwd){
        header("Location: ../../signup.php?error=Password Does't Match!");
    }else{
        $pwd = ENC($pwd);
        $sql = "INSERT INTO user(f_name,l_name,email,pwd) values('{$fName}','{$lName}','{$email}','{$pwd}')";
        if(!mysqli_query($conn,$sql)){
            header("Location: ../../signup.php?error=Query Failed!");
        }else{
            header("Location: ../../login.php?success=Account Created!");
        }
    }
}