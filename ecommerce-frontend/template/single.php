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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
   <?php include "./header.php" ?>

   <section class="shop-single section-padding pt-3">
      <?php
      if (isset($_GET['product'])) {
         $product_id = isset($_GET['product']) ? $_GET['product'] : null;

         $q = $conn->prepare("SELECT * FROM products WHERE id = ?");
         $q->execute([$product_id]);
         $products = $q->fetchAll();

         $p_images = explode(",", $products[0]['multiple_images']);
      ?>
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="shop-detail-left">
                     <div id="sync1" class="owl-carousel">
                        <?php foreach ($p_images as $image) { ?>
                           <div class="item"><img src="../../ecommerce-backend/pages/uploads/products/<?= htmlspecialchars($image) ?>" class="img-fluid img-center"></div>
                        <?php } ?>
                     </div>
                     <div id="sync2" class="owl-carousel">
                        <?php foreach ($p_images as $image) { ?>
                           <div class="item"><img src="../../ecommerce-backend/pages/uploads/products/<?= htmlspecialchars($image) ?>" class="img-fluid img-center"></div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="shop-detail-right">
                     <?php
                     $mrp = $products[0]["mrp"];
                     $retailer_price = $products[0]["retailer_price"];
                     $discount = (($mrp - $retailer_price) / $mrp) * 100;

                     if ($discount > 0) {
                        echo '<span class="badge badge-success">' . number_format($discount, 2) . '% OFF</span>';
                     }
                     ?>
                     <h2><?= htmlspecialchars($products[0]['product_name']) ?></h2>
                     <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?= htmlspecialchars($products[0]['variant_name']) ?></h6>
                     <p class="offer-price mb-0">
                        <?php if ($products[0]['retailer_price'] !== $products[0]['mrp']) {
                           echo '<span class="regular-price">MRP : ₹' . number_format($products[0]['mrp'], 2) . '</span>';
                        } ?>
                        <br> Discounted price : ₹<?= number_format($products[0]['retailer_price'], 2) ?>
                     </p>


                     <!-- Add to Cart Button -->
                     <div class="product-footer">
                        <p style="display:none;" ; class="offer-price mb-0">Discounted price : ₹<?= number_format($products[0]['retailer_price'], 2) ?> <br>
                           <?php if ($products[0]['retailer_price'] !== $products[0]['mrp']) : ?>
                              <span class="regular-price">₹<?= number_format($products[0]['mrp'], 2) ?></span>
                           <?php endif; ?>
                        </p>
                        <button type="button" class="btn btn-secondary btn-sm  add-to-cart" data-product-id="<?= $products[0]['id'] ?>">
                           <i class="mdi mdi-cart-outline"></i> Add To Cart
                        </button>

                        <div class="qty-selector d-none">
                           <button type="button" class="btn btn-secondary btn-sm decrease-qty" data-product-id="<?= $products[0]['id'] ?>" style="background-color:rgb(250, 155, 114);padding: 4%;"><i class="fa-sharp fa-solid fa-minus"></i></button>
                           <span class="quantity" style="font-size: large;">1</span>
                           <button type="button" class="btn btn-secondary btn-sm increase-qty" data-product-id="<?= $products[0]['id'] ?>" style="background-color:rgb(250, 155, 114);padding: 4%;"><i class="fa-sharp fa-solid fa-plus"></i></button>
                        </div>


                     </div>
                     <br>
                     <br>

                     <div class="short-description">
                        <h5>Quick Overview
                           <p class="float-right">Availability: <span class="badge badge-success">In Stock</span></p>
                        </h5>
                        <p><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b> Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum.</p>
                        <p class="mb-0"> Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt.</p>
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
      <?php } ?>
   </section>
   <section class="product-items-slider section-padding bg-white border-top">
      <div class="container">
         <?php
         if (isset($_GET['offer'])) {
            $banner_id = isset($_GET['offer']) ? $_GET['offer'] : null;

            $q = $conn->prepare("SELECT * FROM banners where id=$banner_id");
            $q->execute();
            $products = $q->fetchAll();

            $p_id = $products[0]['product_id'];
            $p_ids = explode(",", $p_id);
         ?>
            <div class="section-header">
               <h5 class="heading-design-h5">Best Offers View <span class="badge badge-primary">20% OFF</span>
                  <a class="float-right text-secondary" href="viewall.php?offer=<?= $banner_id ?>">View All</a>
               </h5>
            </div>

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
                           <a href="single.php?product=<?= $product['id'] ?>&offer=<?= $banner_id ?>">
                              <div class="product-header">
                                 <?php
                                 $mrp = $product["mrp"];
                                 $retailer_price = $product["retailer_price"];

                                 $discount = (($mrp - $retailer_price) / $mrp) * 100;

                                 // Display discount only if it's greater than 0
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
                                 <p class="offer-price mb-0">₹<?= number_format($product['retailer_price'], 2) ?> <br>
                                    <?php
                                    if ($product['retailer_price'] !== $product['mrp']) {
                                       echo '<span class="regular-price">₹' . number_format($product['mrp'], 2) . '</span>';
                                    } else {
                                       echo "<br>";
                                    }
                                    ?>
                                 </p>
                                 <button type="button" class="btn btn-secondary btn-sm add-to-cart" data-product-id="<?= $product['id'] ?>">
                                    <i class="mdi mdi-cart-outline"></i> Add To Cart
                                 </button>
                                 <div class="qty-selector d-none ">
                                    <button type="button" class="btn btn-secondary btn-sm decrease-qty" data-product-id="<?= $product['id'] ?>"> - </button>
                                    <span class="quantity">1</span>
                                    <button type="button" class="btn btn-secondary btn-sm increase-qty" data-product-id="<?= $product['id'] ?>"> + </button>
                                 </div>

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
</body>

</html>