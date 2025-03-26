<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>Groci - Organic Food & Grocery Market Template</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Select2 CSS -->
    <link href="vendor/select2/css/select2-bootstrap.css" />
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/osahan.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
</head>

<body>
    <?php include "./header.php" ?>

    <!-- <section class="shop-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3" style="padding: 0; background-color: white; border-radius: 5px; overflow-x: auto;">
                        <div class="scrollmenu" style="display: flex; align-items: center; gap: 15px; padding: 10px; white-space: nowrap; border-bottom: 2px solid #e0e0e0;">
                            <?php
                            if (isset($_GET["brand"])) {
                                $bname = $_GET["brand"];
                                $query = $conn->prepare("SELECT * FROM products where brand='$bname'");
                                $query->execute();
                                $subcatlist = $query->fetchAll();
                                foreach ($subcatlist as $scl) {
                                    echo '<div class="subcategory-item active" onclick="getSubcategoryBasedProduct(this,19)" 
                                            style="padding: 10px 15px; font-size: 16px; font-weight: 500; color: #333; border-radius: 5px; cursor: pointer; transition: background 0.3s, color 0.3s;">
                                            <a href="javascript:void(0)" style="text-decoration: none; color: inherit;">' . $scl["name"] . '</a>
                                            </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="product-items-slider section-padding bg-white border-top">
        <div class="container">

            <div class="owl-carousel owl-carousel-featured">
                <?php
                if (isset($_GET["brand"])) {
                    $bname = $_GET["brand"];
                    $query = $conn->prepare("SELECT * FROM products WHERE brand = ?");
                    $query->execute([$bname]);
                    $pro = $query->fetchAll();
                    $count = count($pro);

                    foreach ($pro as $p) {
                        $mrp = $p["mrp"];
                        $retailer_price = $p["retailer_price"];
                        $discount = (($mrp - $retailer_price) / $mrp) * 100;
                ?>
                        <div class="item">
                            <div class="product">
                                <a href="single.php?product=<?= $p['id'] ?>">
                                    <div class="product-header">
                                        <?php if ($discount > 0) { ?>
                                            <span class="badge badge-success"><?= number_format($discount, 2) ?>% OFF</span>
                                        <?php } ?>
                                        <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/products/<?= htmlspecialchars($p['product_image']) ?>"
                                            alt="<?= htmlspecialchars($p['product_name']) ?>">
                                        <span class="veg text-success mdi mdi-circle"></span>
                                    </div>
                                    <div class="product-body">
                                        <h5><?= htmlspecialchars($p['product_name']) ?></h5>
                                        <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?= htmlspecialchars($p['variant_name']) ?></h6>
                                    </div>
                                    <div class="product-footer">
                                        <button type="button" class="btn btn-secondary btn-sm float-right">
                                            <i class="mdi mdi-cart-outline"></i> Add To Cart
                                        </button>
                                        <p class="offer-price mb-0">₹<?= number_format($p['retailer_price'], 2) ?> <br>
                                            <?php
                                            if ($p['retailer_price'] !== $p['mrp']) {
                                                echo '<span class="regular-price">₹' . number_format($p['mrp'], 2) . '</span>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    }

                    // Show a message if no products are found
                    if ($count === 0) {
                        echo '<div class="text-center my-5">
                        <h4 class="text-danger"><i class="mdi mdi-alert-circle-outline"></i> No Products Available</h4>
                        <p class="text-muted" style="font-size: 16px; max-width: 600px; margin: 0 auto;">
                            Oops! No products found in this category. Please check back later.
                        </p>
                    </div>';
                    }
                } else {
                    echo '<div class="text-center my-5">
                    <h4 class="text-danger"><i class="mdi mdi-alert-circle-outline"></i> No Brand Selected</h4>
                    <p class="text-muted">Please select a brand to view products.</p>
                </div>';
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php include "./footer.php" ?>
    <!-- End Footer -->

    <div class="cart-sidebar">
        <div class="cart-sidebar-header">
            <h5>
                My Cart <span class="text-success">(5 item)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
                </a>
            </h5>
        </div>
        <div class="cart-sidebar-body">
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/11.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/7.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/9.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/1.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/2.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
            </div>
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-store-details">
                <p>Sub Total <strong class="float-right">₹900.69</strong></p>
                <p>Delivery Charges <strong class="float-right text-danger">+ ₹29.69</strong></p>
                <h6>Your total savings <strong class="float-right text-danger">₹55 (42.31%)</strong></h6>
            </div>
            <a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>₹1200.69</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- select2 Js -->
    <script src="vendor/select2/js/select2.min.js"></script>
    <!-- Owl Carousel -->
    <script src="vendor/owl-carousel/owl.carousel.js"></script>
    <!-- Custom -->
    <script src="js/custom.js"></script>
</body>

</html>