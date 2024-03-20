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
                        <h5 class="modal-title"><b>Edit Product</b></h5>
                    </div>

                    <div class="modal-body border-primary border-2">
                        <form action="crud-prod-opera.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <?php
                                    $id = $_GET['id'];
                                    $sql1 = "select * from products where id = {$id}";
                                    $result1 = mysqli_query($conn, $sql1) or die( "Unsuccessfull Query" . $sql1);
                                    if(mysqli_num_rows($result1) > 0){
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                ?>
                                            <label for="brand-select" class="form-label font-20">Select Brand Name</label>
                                            <select class="form-select border-primary border-2 mb-3" id="brand" onClick = "updateList()" name="brand-select" aria-label=".form-select-lg example">
                                                <option disabled>Select brand</option>
                                                <?php
                                                $sql3 = "SELECT * FROM categories WHERE id = {$row1['catg_id']}";
                                                $result3 = mysqli_query($conn, $sql3);
                                                if(mysqli_num_rows($result3) > 0){
                                                    while($row3 = mysqli_fetch_assoc($result3)){
                                                        $sql2 = "SELECT * FROM brands";
                                                        $result2 = mysqli_query($conn, $sql2);
                                                        
                                                        if(mysqli_num_rows($result2) > 0){
                                                            while($row2 = mysqli_fetch_assoc($result2)){
                                                                if($row3['brand_id'] == $row2['id']){
                                                                    $selected = 'selected';
                                                                }else{
                                                                    $selected = '';
                                                                }
                                                                echo "<option ".$selected." value='".$row2['id']."'>".$row2['name']."</option>";
                                                            }
                                                            echo '<input type="hidden" name="old_brand_id" value="'. $row1['brand_id'].'">';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label for="catg-select" class="form-label font-20">Select Category Name</label>
                                            <select class="form-select border-primary border-2 mb-3" id="catg" name="catg-select" aria-label=".form-select-lg example" >
                                                <option disabled selected>Select Category</option>
                                                
                                            </select>
                                            <input type="hidden" class="form-control border-primary border-2" required name="old-catg-id" value="<?php echo $row1['catg_id'] ?>">
                                            <input type="hidden" class="form-control border-primary border-2" required name="product-id" value="<?php echo $id ?>">
                                            <label for="product-name" class="form-label font-20">Name</label>
                                            <input type="text" class="form-control border-primary border-2" required name="name" value="<?php echo $row1['name'] ?>">
                                            <div class="mb-3">
                                                <label for="catg-name" class="form-label font-20">Color</label>
                                                <input name="color" class="form-control border-primary border-2" placeholder="color" required value="<?php echo $row1['color'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="catg-name" class="form-label font-20">M.R.P</label>
                                                <input name="mrp" class="form-control border-primary border-2" placeholder="m.r.p" required value="<?php echo $row1['mrp'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="catg-name" class="form-label font-20">Deal Price</label>
                                                <input name="deal-price" class="form-control border-primary border-2" placeholder="deal price" required value="<?php echo $row1['deal_price'] ?>">
                                            </div>
                                            <div class="mb-3 row mt-2">
                                                <div class="col-9">
                                                    <label for="img" class=" col-form-label font-20" >Upload Image</label>
                                                    <input  class="form-control border-primary border-2" type="file" name="img">
                                                </div>
                                                <div class="col-3 d-flex align-items-center justify-content-center">
                                                    <a target="_blank" href="<?php echo '../uploads/'.$row1['img'] ?>"><img src="<?php echo '../uploads/'.$row1['img'] ?>" style="width:65px"></img></a>
                                                </div>
                                            </div>
                                            <input type='text' id='high' value='<?php echo $row1["highlights"] ?>' hidden>
                                            <input type='text' id='desc' value='<?php echo $row1["description"] ?>' hidden>
                                            <div class="mb-3">
                                                <label for="catg-name" class="form-label font-20">Highlights</label>
                                                <textarea id="highlights" name="highlights" class="form-control border-primary border-2" value="<?php echo $row1['highlights'] ?>" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="catg-name" class="form-label font-20">Description</label>
                                                <textarea id="description" name="description" class="form-control border-primary border-2" value="<?php echo $row1['description'] ?>" required></textarea>
                                            </div>
                                <?php     
                                        }
                                    }
                                                                        
                                ?>
                            </div>
                                    </div>
                            <div class="modal-footer border-primary border-2">
                                <button type="submit" name="edit" class="btn btn-outline-primary rounded-pill border-2 fw-bold">Save</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>

<!-- JQuery script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Editor -->
<script>
    CKEDITOR.replace('highlights');
    CKEDITOR.replace('description');
    window.onload = () => {
        highlightsInputEl = document.querySelector('#high').value;
        descriptionInputEl = document.querySelector('#desc').value;

        CKEDITOR.instances['highlights'].setData(highlightsInputEl);
        CKEDITOR.instances['description'].setData(descriptionInputEl);
    }
   
</script>
<?php
    require '../inc/footer.php';
?>

