<?php
include "./connection.php";
?>
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
               <a href="index.php"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Fruits & Vegetables</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Fruits</a>
            </div>
         </div>
      </div>
   </section>
   <section class="shop-single section-padding pt-3">
      <?php
      $product_id = isset($_GET['product']) ? $_GET['product'] : null;
      $banner_id = isset($_GET['offer']) ? $_GET['offer'] : null;

      $q = $conn->prepare("SELECT * FROM products where id=$product_id");
      $q->execute();
      $products = $q->fetchAll();

      $p_images = $products[0]['multiple_images'];
      $p_images = explode(",", $p_images);
      ?>
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <div class="shop-detail-left">
                  <div class="shop-detail-slider">
                     <div class="favourite-icon">
                        <a class="fav-btn" title="" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="59% OFF"><i class="mdi mdi-tag-outline"></i></a>
                     </div>

                     <div id="sync1" class="owl-carousel">
                        <?php foreach ($p_images as $image) { ?>
                           <div class="item"><img src="../../ecommerce-backend/pages/uploads/products/<?= htmlspecialchars($image) ?>" class="img-fluid img-center"></div>
                        <?php } ?>
                     </div>

                     <!-- Thumbnail Carousel -->
                     <div id="sync2" class="owl-carousel">
                        <?php foreach ($p_images as $image) { ?>
                           <div class="item"><img src="../../ecommerce-backend/pages/uploads/products/<?= htmlspecialchars($image) ?>" class="img-fluid img-center"></div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="shop-detail-right">
                  <span class="badge badge-success">50% OFF</span>
                  <h2><?= $products[0]['product_name'] ?></h2>
                  <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?= $products[0]['variant_name'] ?></h6>
                  <p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : <?= $products[0]['mrp'] ?></p>
                  <p class="offer-price mb-0">Discounted price : <span class="text-success"><?= $products[0]['base_price'] ?></span></p>
                  <a href="checkout.html"><button type="button" class="btn btn-secondary btn-lg"><i class="mdi mdi-cart-outline"></i> Add To Cart</button> </a>
                  <div class="short-description">
                     <h5>
                        Quick Overview
                        <p class="float-right">Availability: <span class="badge badge-success">In Stock</span></p>
                     </h5>
                     <p><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b> Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum.
                     </p>
                     <p class="mb-0"> Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hiMenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum.</p>
                  </div>
                  <h6 class="mb-3 mt-4">Why shop from Groci?</h6>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="feature-box">
                           <i class="mdi mdi-truck-fast"></i>
                           <h6 class="text-info">Free Delivery</h6>
                           <p>Lorem ipsum dolor...</p>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="feature-box">
                           <i class="mdi mdi-basket"></i>
                           <h6 class="text-info">100% Guarantee</h6>
                           <p>Rorem Ipsum Dolor sit...</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="product-items-slider section-padding bg-white border-top">
      <div class="container">
         <div class="section-header">
            <h5 class="heading-design-h5">Best Offers View <span class="badge badge-primary">20% OFF</span>
               <a class="float-right text-secondary" href="shop.html">View All</a>
            </h5>
         </div>
         <?php
         if (isset($_GET['offer'])) {
            $banner_id = isset($_GET['offer']) ? $_GET['offer'] : null;

            $q = $conn->prepare("SELECT * FROM banners where id=$banner_id");
            $q->execute();
            $products = $q->fetchAll();

            $p_id = $products[0]['product_id'];
            $p_ids = explode(",", $p_id);
         ?>
            <div class="owl-carousel owl-carousel-featured">
               <?php
               foreach ($p_ids as $p_id) { ?>

                  <?php
                  $q = $conn->prepare("SELECT * FROM products where id=$p_id");
                  $q->execute();
                  $products = $q->fetchAll();

                  foreach ($products as $product) { ?>

                     <div class="item">
                        <div class="product">
                           <a href="single.php?product=<?= $product['id'] ?>&offer=<?= $bann['id'] ?>">
                              <div class="product-header">
                                 <!-- <span class="badge badge-success"><?= $product['discount'] ?>% OFF</span> -->
                                 <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/products/<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>">
                                 <!-- <span class="<?= $product['is_veg'] ? 'veg text-success' : 'non-veg text-danger' ?> mdi mdi-circle"></span> -->
                              </div>
                              <div class="product-body">
                                 <h5><?= htmlspecialchars($product['product_name']) ?></h5>
                                 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?= htmlspecialchars($product['variant_name']) ?></h6>
                              </div>
                              <div class="product-footer">
                                 <button type="button" class="btn btn-secondary btn-sm float-right">
                                    <i class="mdi mdi-cart-outline"></i> Add To Cart
                                 </button>
                                 <p class="offer-price mb-0">$<?= number_format($product['base_price'], 2) ?> <i class="mdi mdi-tag-outline"></i><br>
                                    <span class="regular-price">$<?= number_format($product['mrp'], 2) ?></span>
                                 </p>
                              </div>
                           </a>
                        </div>
                     </div>

                  <?php } ?>
               <?php } ?>
            <?php } ?>
            </div>
      </div>
   </section>
   <?php
   include "./connection.php";

   $query = $conn->prepare("SELECT * FROM banners");
   $query->execute();
   $banner = $query->fetchAll();

   $query = $conn->prepare("SELECT * FROM subcategory");
   $query->execute();
   $ssubcategory = $query->fetchAll();

   ?>
   <section class="product-items-slider section-padding">
      <?php foreach ($banner as $bann) { ?>
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5"><?= $bann['name'] ?> <span class="badge badge-primary">20% OFF</span>
                  <a class="float-right text-secondary" href="shop.html">View All</a>
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
               <?php
               $product_ids = $bann["product_id"];
               $product_id = explode(",", $product_ids);

               foreach ($product_id as $p_id) { ?>

                  <?php
                  $q = $conn->prepare("SELECT * FROM products where id=$p_id");
                  $q->execute();
                  $products = $q->fetchAll();

                  foreach ($products as $product) { ?>

                     <div class="item">
                        <div class="product">
                           <a href="single.php?product=<?= $product['id'] ?>&offer=<?= $bann['id'] ?>">
                              <div class="product-header">
                                 <!-- <span class="badge badge-success"><?= $product['discount'] ?>% OFF</span> -->
                                 <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/products/<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>">
                                 <!-- <span class="<?= $product['is_veg'] ? 'veg text-success' : 'non-veg text-danger' ?> mdi mdi-circle"></span> -->
                              </div>
                              <div class="product-body">
                                 <h5><?= htmlspecialchars($product['product_name']) ?></h5>
                                 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?= htmlspecialchars($product['variant_name']) ?></h6>
                              </div>
                              <div class="product-footer">
                                 <button type="button" class="btn btn-secondary btn-sm float-right">
                                    <i class="mdi mdi-cart-outline"></i> Add To Cart
                                 </button>
                                 <p class="offer-price mb-0">$<?= number_format($product['base_price'], 2) ?> <i class="mdi mdi-tag-outline"></i><br>
                                    <span class="regular-price">$<?= number_format($product['mrp'], 2) ?></span>
                                 </p>
                              </div>
                           </a>
                        </div>
                     </div>

                  <?php } ?>
               <?php } ?>
            </div>
         </div>
      <?php } ?>
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