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
   <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Shop</a>
            </div>
         </div>
      </div>
   </section>

   <section class="product-items-slider section-padding bg-white border-top">
      <div class="container">
         <div class="section-header">
            <h5 class="heading-design-h5">Best Offers View <span class="badge badge-primary">20% OFF</span>
               <a class="float-right text-secondary" href="shop.php">View All</a>
            </h5>
         </div>
         <div class="owl-carousel owl-carousel-featured">
            <?php
            $sub_category_name = $_GET["subcategory"];
            $query = $conn->prepare("SELECT * FROM subcategory where name='$sub_category_name'");
            $query->execute();
            $subid = $query->fetchAll();
            $subidd = $subid[0]["id"];

            $query = $conn->prepare("SELECT * FROM products where subcategory=$subidd");
            $query->execute();
            $pro = $query->fetchAll();
            $count = 0;

            foreach ($pro as $p) {
               $count++;
               echo '
                <div class="item">
                    <div class="product">
                        <a href="single.php?product=' . $p["id"] . '">
                            <div class="product-header">
                                <span class="badge badge-success">50% OFF</span>
                                <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/products/' . htmlspecialchars($p["product_image"]) . '" alt="' . htmlspecialchars($p["product_name"]) . '">
                                <span class="veg text-success mdi mdi-circle"></span>
                            </div>
                            <div class="product-body">
                                <h5>' . htmlspecialchars($p["product_name"]) . '</h5>
                                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - ' . htmlspecialchars($p["variant_name"]) . '</h6>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right">
                                    <i class="mdi mdi-cart-outline"></i> Add To Cart
                                </button>
                                <p class="offer-price mb-0">₹' . number_format($p["retailer_price"], 2) . ' <i class="mdi mdi-tag-outline"></i><br>
                                    <span class="regular-price">₹' . number_format($p["mrp"], 2) . '</span>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>';
            }


            ?>

         </div>
         <?php

         // Show a message if no products are found
         if ($count === 0) {
            echo '<div class="text-center my-5">
               <h4 class="text-danger"><i class="mdi mdi-alert-circle-outline"></i> No Products Available</h4>
               <p class="text-muted" style="font-size: 16px; max-width: 600px; margin: 0 auto;">
                   Oops! No products found in this category. Please check back later.
               </p>
             </div>';
         } ?>
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