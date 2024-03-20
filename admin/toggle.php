<?php
    require 'dbh/conn.php';
    if(isset($_POST['tableName']) && isset($_POST['colName']) && isset($_POST['id']) && isset($_POST['status'])){
        $id = $_POST['id'];
        $tablename = $_POST['tableName'];
        $colname = $_POST['colName'];
        $status = $_POST['status'];

        if($status == 1){
            $sql = "UPDATE {$tablename} SET {$colname} = 0 WHERE id = {$id}";
            mysqli_query($conn, $sql) or die("Unsuccessfull Query". $sql);
        }else{
            $sql = "UPDATE {$tablename} SET {$colname} = 1 WHERE id = {$id}";
            mysqli_query($conn, $sql) or die("Unsuccessfull Query". $sql);
        }
        echo '1';
    }
    if(isset($_POST['selectedBrand'])){
        $brand_id = $_POST['selectedBrand'];
        $sql = "select * from categories where brand_id = {$brand_id}";
        $result = mysqli_query($conn, $sql);
        echo '<option selected disabled>Select</option>';
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value=".$row['id'].">".$row['name']."</option>";
            }
        }
        

    }
    if(isset($_POST['id'])  && isset($_POST['colName']) && isset($_POST['tableName']) && isset($_POST['action'])){
        $id = $_POST['id'];
        $colname = $_POST['colName'];
        $tablename = $_POST['tableName'];
        $sql = "select * from {$tablename} where id = {$id}";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<p>".$row[$colname]."</p>";
            }
        }
        

    }
    ?>