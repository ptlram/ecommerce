<?php
include "../connection.php";

$query = $conn->prepare("SELECT * FROM banners");
$query->execute();
$banner = $query->fetchAll();

$query = $conn->prepare("SELECT * FROM category");
$query->execute();
$category = $query->fetchAll();

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
    <?php include "../header.php" ?>
    <section class="carousel-slider-main text-center border-top border-bottom bg-white">
        <div class="owl-carousel owl-carousel-slider">
            <!-- <div class="item">
                <a href="shop.html"><img class="img-fluid" src="img/slider/slider2.jpg" alt="First slide"></a>
            </div> -->
            <?php
            foreach ($banner as $ban) {
                if ($ban["is_in_banner"] == "Yes") {
                    echo '<div class="item">
                    <a href="shop.html">
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
                foreach ($category as $cate) {
                    echo '<div class="item">
                            <div class="category-item">
                            <a href="shop.html">
                            <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/category/' . $cate["image"] . '">
                                <h6>' . $cate["name"] . '</h6>
                            </a>
                            </div>
                        </div>';
                }
                ?>
                <?php
                foreach ($category as $cate) {
                    echo '<div class="item">
                            <div class="category-item">
                            <a href="shop.html">
                            <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/category/' . $cate["image"] . '">
                                <h6>' . $cate["name"] . '</h6>
                            </a>
                            </div>
                        </div>';
                }
                ?>
                <div class="item">
                    <div class="category-item">
                        <a href="shop.html">
                            <img class="img-fluid" src="img/small/1.jpg" alt="">
                            <h6>Fruits & Vegetables</h6>
                            <p>150 Items</p>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">Top Savers Today <span class="badge badge-primary">20% OFF</span>
                    <a class="float-right text-secondary" href="shop.html">View All</a>
                </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/1.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/2.jpg" alt="">
                                <span class="non-veg text-danger mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/3.jpg" alt="">
                                <span class="non-veg text-danger mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/4.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/5.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/6.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="offer-product">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <a href="#"><img class="img-fluid" src="img/ad/1.jpg" alt=""></a>
                </div>
                <div class="col-md-6">
                    <a href="#"><img class="img-fluid" src="img/ad/2.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">Best Offers View <span class="badge badge-info">20% OFF</span>
                    <a class="float-right text-secondary" href="shop.html">View All</a>
                </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/7.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/8.jpg" alt="">
                                <span class="non-veg text-danger mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/9.jpg" alt="">
                                <span class="non-veg text-danger mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/10.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/11.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="product">
                        <a href="single.html">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="img/item/12.jpg" alt="">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>Product Title Here</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding bg-white border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-truck-fast"></i>
                        <h6>Free & Next Day Delivery</h6>
                        <p>Lorem ipsum dolor sit amet, cons...</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-basket"></i>
                        <h6>100% Satisfaction Guarantee</h6>
                        <p>Rorem Ipsum Dolor sit amet, cons...</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-tag-heart"></i>
                        <h6>Great Daily Deals Discount</h6>
                        <p>Sorem Ipsum Dolor sit amet, Cons...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php
    include "../footer.php";
    ?>
    <!-- End Footer -->
    <!-- Copyright -->
    <section class="pt-4 pb-4 footer-bottom">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6 col-sm-6">
                    <p class="mt-1 mb-0">&copy; Copyright 2018 <strong class="text-dark">Groci</strong>. All Rights Reserved<br>
                        <small class="mt-0 mb-0">Made with <i class="mdi mdi-heart text-danger"></i> by <a href="https://askbootstrap.com/" target="_blank" class="text-primary">Ask Bootstrap</a>
                        </small>
                    </p>
                </div>
                <div class="col-lg-6 col-sm-6 text-right">
                    <img alt="osahan logo" src="img/payment_methods.png">
                </div>
            </div>
        </div>
    </section>
    <!-- End Copyright -->
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
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/7.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/9.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/1.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/2.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-store-details">
                <p>Sub Total <strong class="float-right">$900.69</strong></p>
                <p>Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p>
                <h6>Your total savings <strong class="float-right text-danger">$55 (42.31%)</strong></h6>
            </div>
            <a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>$1200.69</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
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