<?php
    require 'head.php';
?>
    <body style="position: absolute; width: 100%; height: 100%; z-index:-1">
        <?php
            require 'slider-nav.php';
            if(isset($_POST['submit'])){

                $brand_id = mysqli_real_escape_string($conn, $_POST['brand-select']);
                $catg_id = mysqli_real_escape_string($conn, $_POST['catg-id']);
                $catg_name = mysqli_real_escape_string($conn, $_POST['catg-name']);

                $sql = "update categories set name = '{$catg_name}', brand_id = {$brand_id} where id = {$catg_id}";
                
                if(!mysqli_query($conn, $sql)){ 
                        header("Location: ../brand.php?error=Query Failed!");
                }else{
                        header("Location: ../brand.php?success=Updated!");
                }
            }
        ?>
        <button class="btn rounded-pill font-25 prev-pg-btn" type="button" >
            <a href="../brand.php"><i class="fal fa-times"></i></a>
        </button>
        <div class="modal d-block" tabindex="-1" style="z-index:-1;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable border-primary border-2">
                <div class="modal-content border-primary border-2">
                    <div class="modal-header border-primary border-2">
                        <h5 class="modal-title"><b>Edit Category</b></h5>
                    </div>

                    <div class="modal-body border-primary border-2">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3">
                                <?php
                                    $id = $_GET['id'];
                                    $sql1 = "select * from categories where id = {$id}";
                                    $result1 = mysqli_query($conn, $sql1) or die( "Unsuccessfull Query" . $sql1);
                                    if(mysqli_num_rows($result1) > 0){
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                ?>
                                            <label for="brand-select" class="form-label font-20">Select Brand Name</label>
                                            <select class="form-select border-primary border-2 mb-3" name="brand-select" aria-label=".form-select-lg example">
                                                <option disabled>Select brand</option>
                                                <?php
                                                $sql2 = "SELECT * FROM  brands;";
                                                $result2 = mysqli_query($conn, $sql2);
                                                
                                                if(mysqli_num_rows($result2) > 0){
                                                    while($row2 = mysqli_fetch_assoc($result2)){
                                                        if($row1['brand_id'] == $row2['id']){
                                                            $selected = 'selected';
                                                        }else{
                                                            $selected = '';
                                                        }
                                                        echo "<option ".$selected." value='".$row2['id']."'>".$row2['name']."</option>";
                                                    }
                                                    echo '<input type="hidden" name="old_brand_id" value="'. $row1['brand_id'].'">';
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" class="form-control border-primary border-2" required name="catg-id" value="<?php echo $id ?>">
                                            <label for="catg-name" class="form-label font-20">Category Name</label>
                                            <input type="text" class="form-control border-primary border-2" required name="catg-name" value="<?php echo $row1['name'] ?>">
                                <?php     
                                        }
                                    }
                                                                        
                                ?>
                                    
                            </div>
                                    </div>
                            <div class="modal-footer border-primary border-2">
                                <button type="submit" name="submit" class="btn btn-outline-primary rounded-pill border-2 fw-bold">Save</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>

<!-- JQuery script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php
    require '../inc/footer.php';
?>

