<?php
require '../dbh/conn.php';
if(!isset($_SESSION['admin_id'])) {
    header("location:{$BASE_URL}/admin");
}
if(isset($_POST['create'])){
    $catg_id = mysqli_real_escape_string($conn, $_POST['catg-select']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $mrp = mysqli_real_escape_string($conn, $_POST['mrp']);
    $deal_price = mysqli_real_escape_string($conn, $_POST['deal-price']);
    $highlights = mysqli_real_escape_string($conn, $_POST['highlights']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // if(empty($catg_id) || empty($product_name) || empty($highlights) || empty($description)){
    //     header("Location: ../products.php?error=Empty Fields!");
    // }

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
                $fileDestination = '../uploads/'.$fileNewName;
                $sql = "INSERT INTO products(catg_id, name, color, mrp, deal_price, highlights, description, img, status) values({$catg_id}, '{$name}', '{$color}','{$mrp}','{$deal_price}','{$highlights}','{$description}','{$fileNewName}', 1);";
                if(mysqli_query($conn, $sql)){
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../products.php?success=Inserted!");
                }else{
                    header("Location: ../products.php?error=Error in query!");
                }
            }else{
                header("Location: ../products.php?error=File size is too Big!");
            }
        }else{
            header("Location: ../products.php?error=Error in the file!");              
        }
    }else{
        header("Location: ../products.php?error=Format not supported!");          
    }
}

// For edit
if(isset($_POST['edit'])){
    if(isset($_POST['catg-select'])){
        $catg_id = mysqli_real_escape_string($conn, $_POST['catg-select']);
        
    }else{
        $catg_id = mysqli_real_escape_string($conn, $_POST['old-catg-id']);
    }
    $prod_id = mysqli_real_escape_string($conn, $_POST['product-id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $mrp = mysqli_real_escape_string($conn, $_POST['mrp']);
    $deal_price = mysqli_real_escape_string($conn, $_POST['deal-price']);
    $highlights = mysqli_real_escape_string($conn, $_POST['highlights']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    
    if(empty($_FILES['img']['name'])){
        $sql = "UPDATE products SET name = '{$name}', catg_id = {$catg_id}, color = '{$color}', mrp = {$mrp}, deal_price = {$deal_price}, highlights = '{$highlights}', description = '{$description}' WHERE id = {$prod_id}";
            if(mysqli_query($conn, $sql)){
                header("Location: ../products.php?success=Updated!");
            }else{
                header("Location: ../products.php?error=Error in query!");
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
                    $fileDestination = '../uploads/'.$fileNewName;
                    $sql1 = "select * from products where id = {$prod_id}";
                        $result1 = mysqli_query($conn, $sql1);
                        while($row1 = mysqli_fetch_assoc($result1)){
                            if(unlink('../uploads/'.$row1['img'])){
                                $sql = "UPDATE products SET name = '{$name}', catg_id = {$catg_id}, color = '{$color}', mrp = {$mrp}, deal_price = {$deal_price}, highlights = '{$highlights}', description = '{$description}', img = '{$fileNewName}' WHERE id = {$prod_id}";
                                if(mysqli_query($conn, $sql)){
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                    header("Location: ../products.php?success=Updated!");
                                }else{
                                    header("Location: ../products.php?error=Error in query!");
                                }
                            }else{
                                header("Location: ../products.php?error=Failed!");          
                            } 
                        }
                    
                }else{
                    header("Location: ../products.php?error=File size is too Big!");
                }
            }else{
                header("Location: ../products.php?error=Error in the file!");              
            }
        }else{
            header("Location: ../products.php?error=Format not supported!");          
        }
    } 
}
// Delete Product
if(isset($_POST['delete'])){
    $prod_id = mysqli_real_escape_string($conn, $_POST['product-id']);
    $img = mysqli_real_escape_string($conn, $_POST['img']);
    $sql = "delete from products where id = {$prod_id}";
    if(!mysqli_query($conn, $sql)){ 
        header("Location: ../products.php?error=Query Failed!");          
    }else{
        if(unlink('../uploads/'.$img)){
            header("Location: ../products.php?success=Deleted!");
        }else{
            header("Location: ../products.php?error=Failed to Delete Img!");          
        }     
    }
    
}

        