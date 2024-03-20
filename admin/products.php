<?php
    require 'inc/head.php';
?>
<body>
    <?php
        require 'inc/slider-nav.php';

        // Delete Category
        if(isset($_POST['delete_catg'])){
            $catg_id = mysqli_real_escape_string($conn, $_POST['catg-id']);
            $sql1 = "delete from categories where id = {$catg_id}";
            if(!mysqli_query($conn, $sql1)){ 
                header("Location: products.php");
            }else{
                    header("Location: products.php");
            }
            
        }
        
    // <!-- Message -->
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
    <!-- Modal -->
    <div class="modal fade" id="displayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close text-danger" style="filter:invert(0)" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <section class="dash-brands-devices-wrapper d-flex align-center-center justify-content-center">
        <div class="container-fluid d-flex align-items-center justify-content-center mt-5 flex-column">
            <div class="row align-items-center justify-content-center w-100 font-18 mt-lg-0  mt-5">
                <!-- For Products -->
                <div class="col-lg-10 my-lg-0 my-5">
            <!-- For Products -->
            <h4>Products</h4>
            <!-- Create Category Button -->
            <a href="operation_files/add-product.php"><i class="fad fa-plus-circle mb-3 text-primary" style="cursor: pointer;font-size: 1.8rem;"></i></a>
            <div style="overflow-x:auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Sr no.</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Mrp</th>
                            <th>Deal Price</th>
                            <th>highlights</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Trending</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                if(isset($_GET['page'])){
                                    $page1 = $_GET['page'];
                                }else{
                                    $page1 = 1;
                                }
                                $limit1 = 3;
                                $offset1 = ($page1 - 1) * $limit1;
                                $sql2 = "SELECT
                                            p.id,
                                            b.id AS brand_id,
                                            c.id AS catg_id,
                                            b.name AS brand_name,
                                            c.name AS catg_name,
                                            p.name, p.status,p.img,p.trending,
                                            p.color, p.mrp, p.description, 
                                            p.deal_price,p.highlights
                                        FROM
                                            products p
                                        INNER JOIN categories c ON 
                                            p.catg_id = c.id 
                                        INNER JOIN brands b ON
                                            c.brand_id = b.id
                                        LIMIT {$offset1},{$limit1}
                                        ";
                                $result2 = mysqli_query($conn, $sql2) or die( "Unsuccessfull Query " . $sql2);
                                if(mysqli_num_rows($result2) > 0){
                                    $count1 = 0;
                                    while($row2 = mysqli_fetch_assoc($result2)){
                            ?>
                                        <tr>
                                            <td><?php echo ++$count1.'.' ?></td>
                                            <td><?php echo $row2['brand_name'] ?></td>
                                            <td><?php echo $row2['catg_name'] ?></td>
                                            <td> <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#displayModal" onclick="loadHighlights(<?php echo $row2['id'] ?>, 'name', 'products')"><?php echo substr(htmlspecialchars($row2['name']), 0, 25)."...." ?></button></td>
                                            <td><?php echo $row2['color'] ?></td>
                                            <td><?php echo $row2['mrp'] ?></td>
                                            <td><?php echo $row2['deal_price'] ?></td>
                                            <td> <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#displayModal" onclick="loadHighlights(<?php echo $row2['id'] ?>, 'highlights', 'products')"><?php echo substr(htmlspecialchars($row2['highlights']), 0, 25)."...." ?></button></td>
                                            <td> <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#displayModal" onclick="loadHighlights(<?php echo $row2['id'] ?>, 'description', 'products')"><?php echo substr(htmlspecialchars($row2['description']), 0, 25)."...." ?></button></td>
                                            <td>
                                                <a target="_blank" href="<?php echo 'uploads/'.$row2['img'] ?>"><img src="<?php echo 'uploads/'.$row2['img'] ?>" style="width:50px"></img></a>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($row2['trending'] == '1') echo 'checked' ?> onclick="updatestatus('products','trending',<?php echo $row2['id']?>, <?php echo $row2['trending'] ?>)">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($row2['status'] == '1') echo 'checked' ?> onclick="updatestatus('products','status',<?php echo $row2['id']?>, <?php echo $row2['status'] ?>)">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Edit Product button -->
                                                <a href="operation_files/edit-product.php?id=<?php echo $row2['id'] ?>"><i class="text-primary font-25 fad fa-edit"></i></a>
                                            </td>
                                            <td>
                                            <!-- Delete Product -->
                                            <button type="button" class="btn">
                                                <form action="operation_files/crud-prod-opera.php" method="post">
                                                    <input type="hidden" name="product-id" value="<?php echo $row2['id'] ?>"></input>
                                                    <input type="hidden" name="img" value="<?php echo $row2['img'] ?>"></input>
                                                    <button type="submit" name="delete" class="border-0"><i class="text-danger text-center font-25 fad fa-trash-alt"></i></button>
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
            </div>

            <!-- ======================== Pagination ========================= -->
            <?php
                $sql3 = "SELECT * FROM products;";
                $result3 = mysqli_query($conn,$sql3) or die("Query Unsuccessfull");
                if(mysqli_num_rows($result3) > 0){
                    $totalrecords1 = mysqli_num_rows($result3);
                    $totalpages1 = ceil($totalrecords1 / $limit1);
                    echo'<nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">';
                    if($page1 > 1){
                        echo '<li class="page-item active"><a class="page-link" href="products.php?page='.($page1 - 1).'"><i class="fad fa-angle-double-left"></i></a></li>';
                    }else{
                        echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-angle-double-left"></i></a></li>';
                    }
                    for($i = 1; $i <= $totalpages1; $i++){
                        if($page1 == $i){
                            $active1 = 'active';
                        }else{
                            $active1 = '';
                        }
                        echo '<li class="page-item '.$active1.'"><a class="page-link" href="products.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($page1 < $totalpages1){
                        echo '<li class="page-item active"><a class="page-link" href="products.php?page='.($page1 + 1).'"><i class="fad fa-chevron-double-right"></i></a></li>';
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

 
    