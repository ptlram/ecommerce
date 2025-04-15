<?php
$is_product = false;
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
   <section class="shop-list">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="mt-3" style="padding: 0; background-color: white; border-radius: 5px; overflow-x: auto;">
                  <div class="scrollmenu" style="display: flex; align-items: center; gap: 15px; padding: 10px; white-space: nowrap; border-bottom: 2px solid #e0e0e0;">
                     <?php
                     if (isset($_GET["subcategory"])) {
                        $subidd = intval($_GET["subcategory"]); // Secure conversion to integer

                        // Fetch the category of the selected subcategory
                        $query = $conn->prepare("SELECT category_id FROM subcategory WHERE id = ?");
                        $query->execute([$subidd]);
                        $cat = $query->fetch(PDO::FETCH_ASSOC);

                        if ($cat) {
                           $cateid = $cat["category_id"];

                           // Fetch all subcategories under the same category
                           $query = $conn->prepare("SELECT * FROM subcategory WHERE category_id = ?");
                           $query->execute([$cateid]);
                           $subcatlist = $query->fetchAll();

                           foreach ($subcatlist as $scl) {
                              $isActive = ($scl["id"] == $subidd) ? 'background-color: #d1e4f7; color: #000; font-weight: 600;' : '';

                              echo '<div class="subcategory-item" onclick="getSubcategoryBasedProduct(this, ' . $scl["id"] . ')" 
                                            style="padding: 10px 15px; font-size: 16px; font-weight: 500; color: #333; border-radius: 5px; cursor: pointer; transition: background 0.3s, color 0.3s; ' . $isActive . '">
                                            <a href="?subcategory=' . $scl["id"] . '" style="text-decoration: none; color: inherit;">' . htmlspecialchars($scl["name"]) . '</a>
                                        </div>';
                           }
                        } else {
                           echo "<p>No subcategories found.</p>";
                        }
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <br>
   <section class="product-items-grid section-padding bg-white border-top">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="shop-head">
                  <a href="#"><span class=""></span>&nbsp;</a>
                  <span class=""></span> <a href="javascript:void(0)"></a>
                  <div class="btn-group float-right mt-2">
                     <div class="form-group">
                        <select class="select2 form-control border-form-control sort_product_selected">
                           <option value="">Sort by: <b>Recommended</b></option>
                           <option value="price_low_to_high">Sort by: Price (Low to High)</option>
                           <option value="price_high_to_low">Sort by: Price (High to Low)</option>
                           <option value="discount_high_to_low">Sort by: Discount (High to Low)</option>
                           <option value="discount_low_to_high">Sort by: Discount (Low to High)</option>
                           <option value="a_to_z">Sort by: Name (A to Z)</option>
                           <option value="z_to_a">Sort by: Name (Z to A)</option>
                        </select>
                     </div>
                  </div>
                  <h1 class="mb-3" style="font-size:1.25rem;">Product</h1>
               </div>
            </div>
         </div>

         <div class="row no-gutters filter_data">
            <?php
            if (isset($_GET['category'])) {
               $category_id = $_GET['category'];
               $q = $conn->prepare("SELECT * FROM products WHERE category = ?");
               $q->execute([$category_id]);
               $category_products = $q->fetchAll();

               if (!empty($category_products)) {
                  $is_product = true;
               }

               foreach ($category_products as $product) { ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6 p_list"> <!-- 4 items per row -->
                     <div class="product">
                        <a href="single.php?product=<?= $product['id'] ?>">
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
                              <img class="img-fluid lazyload" data-src="../../ecommerce-backend/pages/uploads/products/<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>">
                           </div>
                           <div class="product-body">
                              <h5 class="cut-text" title="<?= htmlspecialchars($product['product_name']) ?>">
                                 <?= htmlspecialchars($product['product_name']) ?>
                              </h5>
                              <h6><strong><span class="mdi mdi-approval"></span> <?= htmlspecialchars($product['variant_name']) ?></strong></h6>
                           </div>
                        </a>
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
                           <!-- Add to Cart Button -->
                           <button type="button" class="btn btn-secondary btn-sm float-right add-to-cart" data-product-id="<?= $product['id'] ?>">
                              <i class="mdi mdi-cart-outline"></i> Add To Cart
                           </button>

                           <!-- Quantity Selector -->
                           <div class="qty-selector d-none" id="qty-selector-<?= $product['id'] ?>">
                              <button type="button" class="btn btn-secondary btn-sm decrease-qty" data-product-id="<?= $product['id'] ?>">-</button>
                              <span class="quantity" id="quantity-<?= $product['id'] ?>">1</span>
                              <button type="button" class="btn btn-secondary btn-sm increase-qty" data-product-id="<?= $product['id'] ?>">+</button>
                           </div>


                        </div>
                     </div>
                  </div>
            <?php }
            } ?>
         </div>


         <div class="row no-gutters filter_data">
            <?php
            if (isset($_GET['subcategory'])) {
               $subcategory_id = $_GET['subcategory'];
               $q = $conn->prepare("SELECT * FROM products WHERE subcategory = ?");
               $q->execute([$subcategory_id]);
               $search_products = $q->fetchAll();
               if (!empty($search_products)) {
                  $is_product = true;
               }

               foreach ($search_products as $product) { ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6 p_list"> <!-- 4 items per row -->
                     <div class="product">
                        <a href="single.php?product=<?= $product['id'] ?>">
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
                              <img class="img-fluid lazyload" data-src="../../ecommerce-backend/pages/uploads/products/<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>">
                           </div>
                           <div class="product-body">
                              <h5 class="cut-text" title="<?= htmlspecialchars($product['product_name']) ?>">
                                 <?= htmlspecialchars($product['product_name']) ?>
                              </h5>
                              <h6><strong><span class="mdi mdi-approval"></span> <?= htmlspecialchars($product['variant_name']) ?></strong></h6>
                           </div>
                        </a>
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
                           <!-- Add to Cart Button -->
                           <button type="button" class="btn btn-secondary btn-sm add-to-cart" data-product-id="<?= $product['id'] ?>">
                              <i class="mdi mdi-cart-outline"></i> Add To Cart
                           </button>

                           <!-- Quantity Selector -->
                           <div class="qty-selector d-none" id="qty-selector-<?= $product['id'] ?>">
                              <button type="button" class="btn btn-secondary btn-sm decrease-qty" data-product-id="<?= $product['id'] ?>">-</button>
                              <span class="quantity" id="quantity-<?= $product['id'] ?>">1</span>
                              <button type="button" class="btn btn-secondary btn-sm increase-qty" data-product-id="<?= $product['id'] ?>">+</button>
                           </div>


                        </div>
                     </div>
                  </div>
            <?php }
            } ?>
         </div>

         <div class="row no-gutters filter_data">
            <?php

            if (isset($_GET['brand'])) {
               $brand_id = $_GET['brand'];
               $q = $conn->prepare("SELECT * FROM products WHERE brand = ?");
               $q->execute([$brand_id]);
               $search_products = $q->fetchAll();
               if (!empty($search_products)) {
                  $is_product = true;
               }

               foreach ($search_products as $product) { ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6 p_list"> <!-- 4 items per row -->
                     <div class="product">
                        <a href="single.php?product=<?= $product['id'] ?>">
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
                              <img
                                 class="img-fluid lazyload"
                                 data-src="../../ecommerce-backend/pages/uploads/products/<?= htmlspecialchars($product['product_image']) ?>"
                                 alt="<?= htmlspecialchars($product['product_name']) ?>"
                                 width="300"
                                 height="200" />
                           </div>
                           <div class="product-body">
                              <h5 class="cut-text" title="<?= htmlspecialchars($product['product_name']) ?>">
                                 <?= htmlspecialchars($product['product_name']) ?>
                              </h5>
                              <h6><strong><span class="mdi mdi-approval"></span> <?= htmlspecialchars($product['variant_name']) ?></strong></h6>
                           </div>
                        </a>
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
                           <!-- Add to Cart Button -->
                           <button type="button" class="btn btn-secondary btn-sm  add-to-cart" data-product-id="<?= $product['id'] ?>">
                              <i class="mdi mdi-cart-outline"></i> Add To Cart
                           </button>

                           <!-- Quantity Selector -->
                           <div class="qty-selector d-none" id="qty-selector-<?= $product['id'] ?>">
                              <button type="button" class="btn btn-secondary btn-sm decrease-qty" data-product-id="<?= $product['id'] ?>">-</button>
                              <span class="quantity" id="quantity-<?= $product['id'] ?>">1</span>
                              <button type="button" class="btn btn-secondary btn-sm increase-qty" data-product-id="<?= $product['id'] ?>">+</button>
                           </div>


                        </div>
                     </div>
                  </div>
            <?php }
            } ?>
         </div>

         <?php
         if ($is_product == true) {
         } else {
            echo "<h1>Products are currently unavailable</h1>";
         }
         ?>

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
            <img class="img-fluid lazyload" data-src="img/item/11.jpg" alt="">
            <span class="badge badge-success">50% OFF</span>
            <h5><a href="#">Product Title Here</a></h5>
            <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
            <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
         </div>
         <div class="cart-list-product">
            <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
            <img class="img-fluid lazyload" data-src="img/item/7.jpg" alt="">
            <span class="badge badge-success">50% OFF</span>
            <h5><a href="#">Product Title Here</a></h5>
            <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
            <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
         </div>
         <div class="cart-list-product">
            <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
            <img class="img-fluid lazyload" data-src="img/item/9.jpg" alt="">
            <span class="badge badge-success">50% OFF</span>
            <h5><a href="#">Product Title Here</a></h5>
            <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
            <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
         </div>
         <div class="cart-list-product">
            <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
            <img class="img-fluid lazyload" data-src="img/item/1.jpg" alt="">
            <span class="badge badge-success">50% OFF</span>
            <h5><a href="#">Product Title Here</a></h5>
            <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
            <p class="offer-price mb-0">₹450.99 <span class="regular-price">₹800.99</span></p>
         </div>
         <div class="cart-list-product">
            <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
            <img class="img-fluid lazyload" data-src="img/item/2.jpg" alt="">
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
   <!-- lazy load -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
   <script>
      if (window.lazySizes) {
         console.log("LazySizes is loaded");
      } else {
         console.log("LazySizes failed to load");
      }
   </script>

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