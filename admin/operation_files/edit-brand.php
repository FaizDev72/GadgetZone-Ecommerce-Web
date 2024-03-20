<?php
    require 'head.php';
?>
    <body style="position: absolute; width: 100%; height: 100%; z-index:-1">
        <?php
            require 'slider-nav.php';
            if(isset($_POST['submit'])){

                $brand_id = mysqli_real_escape_string($conn, $_POST['brand-id']);
                $brand_name = mysqli_real_escape_string($conn, $_POST['brand-name']);

                $sql = "update brands set name = '{$brand_name}' where id = {$brand_id}";
                
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
                        <h5 class="modal-title"><b>Edit Brand</b></h5>
                    </div>

                    <div class="modal-body border-primary border-2">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3">
                                    <?php
                                        $id = $_GET['id'];
                                        $sql = "select name from brands where id = {$id}";
                                        $result = mysqli_query($conn, $sql) or die( "Unsuccessfull Query" . $sql);
                                        $row = mysqli_fetch_assoc($result);                                    
                                    ?>
                                    <input type="hidden" class="form-control border-primary border-2" required name="brand-id" value="<?php echo $id ?>">
                                    <label for="brand-name" class="form-label font-20">Brand Name</label>
                                    <input type="text" class="form-control border-primary border-2" required name="brand-name" value="<?php echo $row['name'] ?>">
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

