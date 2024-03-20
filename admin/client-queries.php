<?php
    require 'inc/head.php';
?>
<body>
    <?php
        require 'inc/slider-nav.php';
        
        // Delete Query
        if(isset($_POST['delete_query'])){
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $sql = "delete from contact where id = {$id}";
            if(!mysqli_query($conn, $sql)){ 
                header("Location: client-queries.php");
            }else{
                header("Location: client-queries.php");
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
    <!-- Table body -->
    <section class="dash-brands-devices-wrapper d-flex align-center-center justify-content-center">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="row align-items-center justify-content-center w-100 font-18 mt-lg-0  mt-5">
                <!-- For Brands -->
                <div class="col-lg-11 my-lg-0 my-5">
                    <h4 class="mb-3">Client Queries</h4>
                    <!-- Create Brand Button -->
                    <table class="table table-hover table-striped table-responsive">
                        <thead class="table-primary">
                            <tr>
                                <th>Sr no.</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Mobile</th>
                                <th>Query</th>
                                <th>Date</th>
                                <th>Status</th>
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
                                    $sql = "SELECT * FROM contact order BY status DESC LIMIT {$offset},{$limit};";
                                    $result = mysqli_query($conn, $sql) or die( "Unsuccessfull Query" . $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        $count = 0;
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                            <tr>
                                                <td><?php echo ++$count.'.' ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['mobile'] ?></td>
                                                <td> <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#displayModal" onclick="loadHighlights(<?php echo $row['id'] ?>, 'msg', 'contact')"><?php echo substr(htmlspecialchars($row['msg']), 0, 25)."...." ?></button></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if($row['status'] == '1') echo 'checked' ?> onclick="updatestatus('contact','status',<?php echo $row['id']?>, <?php echo $row['status'] ?>)">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                <!-- Delete brand -->
                                                    <button type="button" class="btn">
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <input type="hidden" class="text-danger text-center font-25 fad fa-trash-alt" name="id" value="<?php echo $row['id'] ?>"></input>
                                                            <button type="submit" name="delete_query" class="border-0"><i class="text-danger text-center font-25 fad fa-trash-alt"></i></button>
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
                        $sql1 = "SELECT * FROM contact;";
                        $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result1) > 0){
                            $totalrecords = mysqli_num_rows($result1);
                            $totalpages = ceil($totalrecords / $limit);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">';
                            if($page > 1){
                                echo '<li class="page-item active"><a class="page-link" href="client-queries.php?page='.($page - 1).'"><i class="fad fa-angle-double-left"></i></a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#"><i class="fad fa-angle-double-left"></i></a></li>';
                            }
                            for($i = 1; $i <= $totalpages; $i++){
                                if($page == $i){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="client-queries.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page < $totalpages){
                                echo '<li class="page-item active"><a class="page-link" href="client-queries.php?page='.($page + 1).'"><i class="fad fa-chevron-double-right"></i></a></li>';
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

 
    