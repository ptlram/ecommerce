<?php
include "./connection.php";

$query = $conn->prepare("SELECT * FROM banners");
$query->execute();
$banner = $query->fetchAll();

$query = $conn->prepare("SELECT * FROM subcategory");
$query->execute();
$ssubcategory = $query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>Groci - Organic Food & Grocery Market </title>
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
    <section class="carousel-slider-main text-center border-top border-bottom bg-white">
        <div class="owl-carousel owl-carousel-slider">
            <!-- <div class="item">
                <a href="shop.php"><img class="img-fluid" src="img/slider/slider2.jpg" alt="First slide"></a>
            </div> -->
            <?php
            foreach ($banner as $ban) {
                if ($ban["is_in_banner"] == "Yes") {
                    echo '<div class="item">
                    <a href="single.php?offer=' . $ban["id"] . '">
                    <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/banners/' . $ban["web_banner"] . '" style="height: 500px;">
                     </a>
                    </div>';
                }
            }
            ?>


        </div>
    </section>
    <section class="top-category section-padding">
        <div class="container">
            <div class="owl-carousel owl-carousel-category">
                <?php
                foreach ($ssubcategory as $scate) {
                    echo '<div class="item">
                            <div class="category-item">
                             <a href="shop.php?subcategory=' . urlencode($scate["id"]) . '">
                            <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/subcategory/' . $scate["image"] . '">
                                <h6>' . $scate["name"] . '</h6>
                            </a>
                            </div>
                        </div>';
                }
                ?>

            </div>
        </div>
    </section>

    <section class="top-category section-padding">
        <div class="container">
            <h5 class="heading-design-h5">Shop by Brand</h5>


            <div class="owl-carousel owl-carousel-category">
                <?php
                // $query = $conn->prepare("SELECT * FROM brand");
                // $query->execute();
                // $brand = $query->fetchAll();
                $url = "http://localhost/project/ecommerce/ecommerce-frontend/template/fetch_api_brand.php";
                // Initialize a cURL session
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $brand = json_decode($response, true);

                foreach ($brand as $b) {
                    echo '<div class="item">
                            <div class="category-item">
                             <a href="shop.php?brand=' . urlencode($b["name"]) . '">
                            <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/brand/' . $b["image"] . '">
                                <h6>' . $b["name"] . '</h6>
                            </a>
                            </div>
                        </div>';
                }

                ?>

            </div>
        </div>
    </section>

    <section class="product-items-slider section-padding">
        <?php foreach ($banner as $bann) { ?>
            <div class="container" style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.19); ">
                <br>
                <div class="section-header">
                    <h5 class="heading-design-h5"><?= $bann['name'] ?>
                        <a class="float-right text-secondary" href="viewall.php?offer=<?= $bann["id"] ?>">View All</a>
                    </h5>
                </div>
                <div class="owl-carousel owl-carousel-featured">
                    <?php
                    $product_ids = $bann["product_id"];
                    $product_id = explode(",", $product_ids);

                    foreach ($product_id as $p_id) {
                        $q = $conn->prepare("SELECT * FROM products WHERE id=$p_id");
                        $q->execute();
                        $products = $q->fetchAll();

                        foreach ($products as $product) { ?>
                            <div class="item">
                                <div class="product">
                                    <a href="single.php?product=<?= $product['id'] ?>&offer=<?= $bann['id'] ?>">
                                        <div class="product-header">
                                            <?php
                                            $mrp = $product["mrp"];
                                            $retailer_price = $product["retailer_price"];
                                            $discount = (($mrp - $retailer_price) / $mrp) * 100;
                                            if ($discount > 0) {
                                                echo '<span class="badge badge-success">' . number_format($discount, 2) . '% OFF</span>';
                                            }
                                            ?>
                                            <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/products/<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>">
                                        </div>
                                        <div class="product-body">
                                            <h5><?= htmlspecialchars($product['product_name']) ?></h5>
                                            <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?= htmlspecialchars($product['variant_name']) ?></h6>
                                        </div>
                                        <div class="product-footer">
                                            <!-- Add to Cart Button -->
                                            <button type="button" class="btn btn-secondary btn-sm float-right add-to-cart" data-product-id="<?= $product['id'] ?>">
                                                <i class="mdi mdi-cart-outline"></i> Add To Cart
                                            </button>

                                            <!-- Quantity Selector -->
                                            <div class="qty-selector d-none">
                                                <button type="button" class="btn btn-outline-secondary decrease-qty" data-product-id="<?= $product['id'] ?>">-</button>
                                                <span class="quantity">1</span>
                                                <button type="button" class="btn btn-outline-secondary increase-qty" data-product-id="<?= $product['id'] ?>">+</button>
                                            </div>

                                            <p class="offer-price mb-0">₹<?= number_format($product['retailer_price'], 2) ?> <br>
                                                <?php if ($product['retailer_price'] !== $product['mrp']) {
                                                    echo '<span class="regular-price">₹' . number_format($product['mrp'], 2) . '</span>';
                                                } ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <br><br>
        <?php } ?>
    </section>

    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function(event) {
                event.preventDefault();
                event.stopPropagation();

                var parentContainer = $(this).closest(".product-footer");
                parentContainer.find(".add-to-cart").addClass("d-none");
                parentContainer.find(".qty-selector").removeClass("d-none");

                var productId = $(this).data("product-id");
                updateCart(productId, 1);
            });

            $(".increase-qty, .decrease-qty").click(function(event) {
                event.preventDefault();
                event.stopPropagation();

                var quantityElem = $(this).siblings(".quantity");
                var quantity = parseInt(quantityElem.text());
                var productId = $(this).data("product-id");
                var customerId = <?= isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 'null' ?>;

                if (!customerId) {
                    alert("Please log in to add items to your cart.");
                    return;
                }

                if ($(this).hasClass("increase-qty")) {
                    quantity += 1;
                } else {
                    if (quantity > 1) {
                        quantity -= 1;
                    } else {
                        removeFromCart(productId, customerId, $(this));
                        return;
                    }
                }

                quantityElem.text(quantity);
                updateCart(productId, quantity);
            });

            function updateCart(productId, quantity) {
                $.ajax({
                    url: "./update_cart.php",
                    type: "POST",
                    data: {
                        product_id: productId,
                        customer_id: <?= isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 'null' ?>,
                        quantity: quantity
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function() {
                        alert("Error updating cart.");
                    }
                });
            }

            function removeFromCart(productId, customerId, btnElement) {
                $.ajax({
                    url: "./remove_from_cart.php",
                    type: "POST",
                    data: {
                        product_id: productId,
                        customer_id: customerId
                    },
                    success: function(response) {
                        console.log(response);

                        // Reset UI when the item is removed
                        var parentContainer = btnElement.closest(".product-footer");
                        parentContainer.find(".add-to-cart").removeClass("d-none");
                        parentContainer.find(".qty-selector").addClass("d-none");
                    },
                    error: function() {
                        alert("Error removing product from cart.");
                    }
                });
            }

            $(".product-footer").on("click", function(event) {
                event.preventDefault();
                event.stopPropagation();
            });

            $(".product-footer button").on("click", function(event) {
                event.preventDefault();
                event.stopPropagation();
            });
        });
    </script>




    <!-- Footer -->
    <?php
    include "./footer.php";
    ?>
    <!-- End Footer -->

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