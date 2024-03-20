<?php
    require 'inc/head.php';
?>
<body>
    <?php
        require 'inc/slider-nav.php';

        // Delete Brand
        if(isset($_POST['delete_brand'])){
            $brand_id = mysqli_real_escape_string($conn, $_POST['brand-id']);
            $sql1 = "delete from brands where id = {$brand_id}";
            if(!mysqli_query($conn, $sql1)){ 
                header("Location: brand.php?error=Query Failed!");
            }else{
                    header("Location: brand.php?success=Deleted!");
            }
            
        }

        // Delete Category
        if(isset($_POST['delete_category'])){
            $catg_id = mysqli_real_escape_string($conn, $_POST['catg-id']);
            $sql1 = "delete from categories where id = {$catg_id}";
            if(!mysqli_query($conn, $sql1)){ 
                header("Location: brand.php?error=Query Failed!");
            }else{
                    header("Location: brand.php?success=Deleted!");
            }
            
        }

        // Message
        if(isset($_GET['error'])){
            $error = $_GET['error'];
            echo '<div class="alert alert-danger w-auto fw-bold font-14" role="alert" style="width: auto !important;position:absolute;top:0;right:0">
            '.$error.'
        </div>';
        }
        if(isset($_GET['success'])){
            $success = $_GET['success'];
            echo '<div class="alert alert-success w-auto fw-bold font-14" role="alert" style="width: auto !important;position:absolute;top:0;right:0">
            '.$success.'
        </div>';
        }
    ?>
    <!-- Table body -->
    <section class="dash-brands-devices-wrapper d-flex align-center-center justify-content-center">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="row align-items-center justify-content-center w-100 font-18 mt-lg-0  mt-5">
                <!-- For Brands -->
                <div class="col-lg-6 my-lg-0 my-5">
                    <h4>Brands</h4>
                    <!-- Create Brand Button -->
                    <a href="operation_files/add-brand.php"><i class="fad fa-plus-circle mb-3 text-primary" style="cursor: pointer;font-size: 1.8rem;"></i></a>
                    <table class="table table-hover table-striped table-responsive">
                        <thead class="table-primary">
                            <tr>
                                <th>Sr no.</th>
                                <th>Brand name</th>
                                <th>Header</th>
                                <th>Footer</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    }else{
                                        $page = 1;
                                    }
                                    $limit = 6;
                                    $offset = ($page - 1) * $limit;
                                    $sql = "SELECT * FROM brands ORDER BY name LIMIT {$offset},{$limit};";
                                    $result = mysqli_query($conn, $sql) or die( "Unsuccessfull Query" . $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        $count = 0;
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                            <tr>
                                                <td><?php echo ++$count.'.' ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($row['header'] == '1') echo 'checked' ?> onclick="updatestatus('brands','header',<?php echo $row['id']?>, <?php echo $row['header'] ?>)">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($row['footer'] == '1') echo 'checked' ?> onclick="updatestatus('brands','footer',<?php echo $row['id']?>, <?php echo $row['footer'] ?>)">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- Edit Brand button -->
                                                    <a href="operation_files/edit-brand.php?id=<?php echo $row['id'] ?>"><i class="text-primary font-25 fad fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    <!-- Delete brand -->
                                                <button type="button" class="btn">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                        <input type="hidden" class="text-danger text-center font-25 fad fa-trash-alt" name="brand-id" value="<?php echo $row['id'] ?>"></input>
                                                        <button type="submit" name="delete_brand" class="border-0"><i class="text-danger text-center font-25 fad fa-trash-alt"></i></button>
                                                    </form>
                                                </button>    
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                ?>
                          </tbody>
                      </table>
                      <!-- ======================== Pagination ========================= -->
                      <?php
                        $sql1 = "SELECT * FROM brands;";
                        $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result1) > 0){
                            $totalrecords = mysqli_num_rows($result1);
                            $totalpages = ceil($totalrecords / $limit);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">';
                            if($page > 1){
                                echo '<li class="page-item active"><a class="page-link" href="brand.php?page='.($page - 1).'"><i class="fad fa-angle-double-left"></i></a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-angle-double-left"></i></a></li>';
                            }
                            for($i = 1; $i <= $totalpages; $i++){
                                if($page == $i){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="brand.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page < $totalpages){
                                echo '<li class="page-item active"><a class="page-link" href="brand.php?page='.($page + 1).'"><i class="fad fa-chevron-double-right"></i></a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-chevron-double-right"></i></a></li>';
                            }
                            echo '   </ul>
                            </nav>';
                        }
                        ?>
                </div>
                <!-- For Categories -->
                <div class="col-lg-6">
                    <h4>Categories</h4>
                    <!-- Create Category Button -->
                    <a href="operation_files/add-category.php"><i class="fad fa-plus-circle mb-3 text-primary" style="cursor: pointer;font-size: 1.8rem;"></i></a>
                    <table class="table table-hover table-striped table-responsive">
                        <thead class="table-primary">
                          <tr>
                              <th>Sr no.</th>
                              <th>Brand</th>
                              <th>Category</th>
                              <th>Status</th>
                              <th>Edit</th>
                              <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                              <?php
                                    if(isset($_GET['pageb'])){
                                        $page1 = $_GET['pageb'];
                                    }else{
                                        $page1 = 1;
                                    }
                                    $limit1 = 6;
                                    $offset1 = ($page1 - 1) * $limit1;
                                    $sql2 = "SELECT
                                                c.id,
                                                b.id AS brand_id,
                                                b.name AS brand_name,
                                                c.name, c.status
                                            FROM
                                                categories c
                                            INNER JOIN brands b ON
                                                c.brand_id = b.id 
                                                ORDER BY b.name
                                            LIMIT {$offset1},{$limit1}";
                                    $result2 = mysqli_query($conn, $sql2) or die( "Unsuccessfull Query" . $sql2);
                                    if(mysqli_num_rows($result2) > 0){
                                        $count1 = 0;
                                        while($row2 = mysqli_fetch_assoc($result2)){
                                ?>
                                            <tr>
                                                <td><?php echo ++$count1.'.' ?></td>
                                                <td><?php echo $row2['brand_name'] ?></td>
                                                <td><?php echo $row2['name'] ?></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($row2['status'] == '1') echo 'checked' ?> onclick="updatestatus('categories','status',<?php echo $row2['id']?>, <?php echo $row2['status'] ?>)">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- Edit Category button -->
                                                    <a href="operation_files/edit-category.php?id=<?php echo $row2['id'] ?>"><i class="text-primary font-25 fad fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    <!-- Delete Category -->
                                                <button type="button" class="btn">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                        <input type="hidden" class="text-danger text-center font-25 fad fa-trash-alt" name="catg-id" value="<?php echo $row2['id'] ?>"></input>
                                                        <button type="submit" name="delete_category" class="border-0"><i class="text-danger text-center font-25 fad fa-trash-alt"></i></button>
                                                    </form>
                                                </button>     
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                ?>
                          </tbody>
                      </table>
                      <?php
                        $sql3 = "SELECT * FROM categories;";
                        $result3 = mysqli_query($conn,$sql3) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result3) > 0){
                            $totalrecords1 = mysqli_num_rows($result3);
                            $totalpages1 = ceil($totalrecords1 / $limit1);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">';
                            if($page1 > 1){
                                echo '<li class="page-item active"><a class="page-link" href="brand.php?pageb='.($page1 - 1).'"><i class="fad fa-angle-double-left"></i></a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-angle-double-left"></i></a></li>';
                            }
                            for($i = 1; $i <= $totalpages1; $i++){
                                if($page1 == $i){
                                    $active1 = 'active';
                                }else{
                                    $active1 = '';
                                }
                                echo '<li class="page-item '.$active1.'"><a class="page-link" href="brand.php?pageb='.$i.'">'.$i.'</a></li>';
                            }
                            if($page1 < $totalpages1){
                                echo '<li class="page-item active"><a class="page-link" href="brand.php?pageb='.($page1 + 1).'"><i class="fad fa-chevron-double-right"></i></a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-chevron-double-right"></i></a></li>';
                            }
                            echo '   </ul>
                            </nav>';
                        }
                        ?>
                </div>
                
                
            </div>
        </div>
    </section>
    
<!-- JQuery script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php
    require 'inc/footer.php';
?>

 
    