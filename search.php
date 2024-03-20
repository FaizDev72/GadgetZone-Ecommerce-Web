<?php
require 'inc/head.php';
$search = mysqli_real_escape_string($conn, $_GET['search']);
?>

<body>
    <!-- =========================Header========================= -->
    <header class="header-wrapper" id="header-wrapper">
        <!-- Nav 1 -->
        <?php
        require 'inc/main-nav.php';
        ?>

        <!-- Nav 2 -->
        <?php
        require 'inc/nav-link.php';
        ?>
    </header>

    <section class="mt-5">
        <div class="container">
            <?php
            $sql = "SELECT
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
                WHERE
                    b.name LIKE '%{$search}%' OR c.name LIKE '%{$search}%' OR p.name LIKE '%{$search}%'";
            $result = mysqli_query($conn, $sql) or die("Unsuccessfull Query " . $sql);
            ?>
            <h4 class="d-inline-block">Search result for &nbsp;</h4><?php echo "<p class='d-inline-block' style='font-weight:600'>" . strtoupper($search) . "<span class='font-16'> (total : " . mysqli_num_rows($result) . " result)</span></p>" ?>
            <hr>
            <div class="row">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="cart-item row border-bottom py-2">
                            <div class="col-lg-3 col-12 card-item-imgbox d-flex  align-items-center justify-content-center border-end cart-img-box">
                                <a href="product.php?id=<?php echo $row['id'] ?>">
                                    <img class="img-fluid" src="<?php echo 'admin/uploads/' . $row['img'] ?>" alt="">
                                </a>
                            </div>
                            <div class="col-lg-7 col-12">
                                <h5 class="cart-item-name"><?php echo $row['name'] ?></h5>
                                <p class="mb-1">M.R.P : <s class="font-12">₹<?php echo $row['mrp'] ?></s></p>
                                <p class="mb-1 font-18 text-primary">Deal price : ₹<?php echo $row['deal_price'] ?></p>
                                <p class="mb-1">You save : ₹<?php echo $row['mrp'] - $row['deal_price'] . "(" . round(100 * ($row['mrp'] - $row['deal_price']) / $row['mrp'], 1) . "%)" ?></p>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<h4>NO RESULT FOUND</h4>";
                }
                ?>
            </div>
        </div>
    </section>
</body>

<!-- Footer -->
<?php
require 'inc/footer.php';
?>