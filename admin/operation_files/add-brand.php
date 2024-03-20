<?php
    require 'head.php';
?>
    <body style="position: absolute; width: 100%; height: 100%; z-index:-1">
        <?php
            require 'slider-nav.php';

            if(isset($_POST['submit'])){
                $brandname = mysqli_real_escape_string($conn, $_POST['brand-name']);

                $sql = "insert into brands(name, header, footer) values('{$brandname}', 1, 1)";
                if(!mysqli_query($conn, $sql)){
                    header("Location: ../brand.php?error=Query Failed!");    
                }else{
                    header("Location: ../brand.php?success=Created!");          
        
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
                        <h5 class="modal-title"><b>Add Brand</b></h5>
                    </div>

                    <div class="modal-body border-primary border-2">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3">
                                    <label for="brand-name" class="form-label font-20">Brand Name</label>
                                    <input type="text" class="form-control border-primary border-2" required name="brand-name" placeholder="name">
                                </div>
                            </div>
                            <div class="modal-footer border-primary border-2">
                                <button type="submit" name="submit" class="btn btn-outline-primary rounded-pill border-2 fw-bold">Create</button>
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

