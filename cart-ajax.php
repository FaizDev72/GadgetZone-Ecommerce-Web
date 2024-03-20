<?php
require 'dbh/conn.php';
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: {$BASE_URL}/login.php");
}
if(isset($_POST['id']) && isset($_POST['action'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);


    if($action == 'decrement'){
        $sql = "UPDATE cart SET qty = qty - 1 WHERE id = {$id}";
        if(mysqli_query($conn, $sql)){
            echo $action;
        }else{
            echo 0 ;
        }
    }else if($action == 'increment'){
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $sql = "UPDATE cart SET qty = qty + 1 WHERE id = {$id}";
        if(mysqli_query($conn, $sql)){
            echo $action;
        }else{
            echo 0 ;
        }
    }else{

    }

    
}