<?php
    require 'head.php';
?>
    <body style="position: absolute; width: 100%; height: 100%; z-index:-1">
        <?php
            require 'slider-nav.php';
        ?>
        <button class="btn rounded-pill font-25 prev-pg-btn" type="button" >
            <a href="../products.php"><i class="fal fa-times"></i></a>
        </button>
        <div class="modal d-block" tabindex="-1" style="z-index:-1;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable border-primary border-2" style="min-width:70%">
                <div class="modal-content border-primary border-2">
                    <div class="modal-header border-primary border-2">
                        <h5 class="modal-title font-18"><b>Add Products</b></h5>
                    </div>

                    <div class="modal-body border-primary border-2">
                        <form action="crud-prod-opera.php" method="POST" enctype="multipart/form-data">
                            <label for="brand-select" class="form-label font-20">Select Brand</label>
                            <select class="form-select border-primary border-2 mb-3" id="brand" required onchange="updateList()" name="brand-select" aria-label=".form-select-lg example">
                                <option selected disabled>Select brand</option>
                                <?php
                                    $sql1 = "select * from brands";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if(mysqli_num_rows($result1) > 0){
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                            echo "<option value=".$row1['id'].">".$row1['name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <label for="catg-select" class="form-label font-20">Select Category</label>
                            <select class="form-select border-primary border-2 mb-3" id = "catg" name="catg-select" required aria-label=".form-select-lg example">
                                <option disabled selected>Select Category</option>
                               
                            </select>
                            <div class="mb-3">
                                <label for="catg-name" class="form-label font-20">Name</label>
                                <input name="name" class="form-control border-primary border-2" placeholder="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="catg-name" class="form-label font-20">Color</label>
                                <input name="color" class="form-control border-primary border-2" placeholder="color" required>
                            </div>
                            <div class="mb-3">
                                <label for="catg-name" class="form-label font-20">M.R.P</label>
                                <input name="mrp" class="form-control border-primary border-2" placeholder="m.r.p" required>
                            </div>
                            <div class="mb-3">
                                <label for="catg-name" class="form-label font-20">Deal Price</label>
                                <input name="deal-price" class="form-control border-primary border-2" placeholder="deal price" required>
                            </div>
                            <div class="mb-3">
                                <label for="img" class=" col-form-label font-20">Upload Image</label>
                                <input  class="form-control border-primary border-2" type="file" name="img" required>
                            </div>
                            <div class="mb-3">
                                <label for="catg-name" class="form-label font-20">Highlights</label>
                                <textarea id="editor" name="highlights" class="form-control border-primary border-2" placeholder="name" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="catg-name" class="form-label font-20">Description</label>
                                <textarea id="editor1" name="description" class="form-control border-primary border-2" placeholder="name" required></textarea>
                            </div>
                            </div>
                            <div class="modal-footer border-primary border-2">
                                <button type="submit" name="create" class="btn btn-outline-primary rounded-pill border-2 fw-bold">Create</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        
<!-- JQuery script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Custom Script -->
<script src="../js/main.js"></script>
<!-- Editor -->
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
</script>
<?php
    require '../inc/footer.php';
?>

