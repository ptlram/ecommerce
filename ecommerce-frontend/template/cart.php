<!DOCTYPE html>
<html lang="en">

<head>

   <link href="../template/css/1st.css" rel="stylesheet">
   <link rel="stylesheet" href="../template/css/2nd.css">
   <link rel="stylesheet" href="../template/css/3rd.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="../template/css/4th.css">


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
   <title>Confirm Order | Bits Infotech</title>

</head>

<body>
   <?php include "header.php" ?>
   <style type="text/css">
      li.prda:hover {
         background-color: #5897fb !important;
      }

      li.prda:hover a {
         color: #FFF !important;

      }

      ul#myMenu {
         max-height: 350px;
         overflow-x: hidden;
         overflow-y: auto;
      }
   </style>
   <?php
   include "./connection.php";


   if (!isset($_SESSION['customer_id'])) {
      echo json_encode(["status" => "error", "message" => "User not logged in"]);
      exit;
   }

   $customer_id = $_SESSION['customer_id'];

   $query = $conn->prepare("SELECT c.id, c.product_id, c.quantity, p.product_name, p.product_image, p.retailer_price ,p.mrp
                         FROM cart c 
                         JOIN products p ON c.product_id = p.id 
                         WHERE c.customer_id = ?");
   $query->execute([$customer_id]);
   $cart_items = $query->fetchAll(PDO::FETCH_ASSOC);


   ?>

   <section class="checkout-page section-padding">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <div class="card">
                  <h5 class="card-header pb-0">My Cart
                     <span class="text-secondary float-right">(<?= count($cart_items) ?> item<?= count($cart_items) > 1 ? 's' : '' ?>)</span>
                  </h5>
                  <div class="card-body pt-0 pr-0 pl-0 pb-0" style="max-height: 31.6rem; overflow: hidden; overflow-y: auto;">
                     <?php foreach ($cart_items as $cart_item) { ?>
                        <div class="cart-list-product" style="border-bottom: unset;">
                           <form method="post" action="">
                              <input type="hidden" name="code" value="<?= $cart_item['product_id'] ?>" />
                              <input type="hidden" name="action" value="remove" />
                              <a class="float-right remove-cart" href="javascript:void(0)" data-cart-id="<?= $cart_item['id'] ?>">
                                 <button type="button" class="remove" style="border-radius: 50%; border: unset; color: #e96125; line-height: 20px; outline: none;">
                                    <i class="mdi mdi-close"></i>
                                 </button>
                              </a>
                           </form>

                           <img class="img-fluid" src="../../ecommerce-backend/pages/uploads/products/<?= $cart_item['product_image'] ?>" alt="Product Image" style="height: fit-content;">
                           <h5><a href="single.php?product=<?= $cart_item['product_id'] ?>" class="cut-text"><?= htmlspecialchars($cart_item['product_name']) ?></a></h5>
                           <p class="offer-price mb-2 mt-2">
                              ₹<?= number_format($cart_item['mrp'], 2) ?>

                           </p>
                           <p class="offer-price mb-2 mt-2">
                              Discount :₹<?= number_format($cart_item['retailer_price'], 2) ?>

                           </p>

                           <form method="post" action="">
                              <input type="hidden" name="code" value="<?= $cart_item['product_id'] ?>" />
                              <input type="hidden" name="action" value="change" />

                              <div class="qty" style="display: flex;">
                                 <div class="plus-minus">
                                    <div class="cart-plus-minus">
                                       <div class="dec qtybutton" onclick="update_cart('minus', <?= $cart_item['id'] ?>)">-</div>
                                       <input type="text" class="quantity" step="1" min="1" name="quantity"
                                          value="<?= $cart_item['quantity'] ?>" title="Qty" size="4"
                                          inputmode="numeric" readonly id="quantity_<?= $cart_item['id'] ?>">
                                       <div class="inc qtybutton" onclick="update_cart('add', <?= $cart_item['id'] ?>)">+</div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     <?php } ?>
                  </div>

                  <?php
                  $mrp_total = 0;
                  $retailer_total = 0;

                  foreach ($cart_items as $cart_item) {
                     $mrp_total += $cart_item['mrp'] * $cart_item['quantity'];  // Sum of MRP
                     $retailer_total += $cart_item['retailer_price'] * $cart_item['quantity']; // Sum of Retailer Prices
                  }

                  $discounted_price = $retailer_total; // Discounted Price
                  $you_save = $mrp_total - $discounted_price; // Savings Calculation
                  ?>

                  <div class="cart-store-details padding-20 pt-3 border-top">
                     <p>MRP Total <strong class="float-right">₹<?= number_format($mrp_total, 2) ?></strong></p>
                     <p>Discounted Price <strong class="float-right text-success">₹<?= number_format($discounted_price, 2) ?></strong></p>
                     <p>You Save <strong class="float-right text-danger">₹<?= number_format($you_save, 2) ?></strong></p>
                  </div>


                  <div class="cart-store-details padding-20 pt-3 border-top">
                     <p>Total Payable <strong class="float-right">₹<?= number_format($discounted_price, 2) ?></strong></p>

                  </div>

               </div>
            </div>
            <div class="col-md-8">
               <div class="checkout-step">
                  <div class="accordion" id="accordionExample">
                     <form action="placeorder.php" method="post" id="checkout-selection">
                        <div class="card checkout-step-one">
                        </div>
                        <?php include "./connection.php";
                        if (isset($_SESSION["email"])) {

                           $email = $_SESSION["email"];
                           $quer = $conn->prepare("SELECT * FROM customers WHERE email='$email' OR mobile_number='$email'");
                           $quer->execute();
                           $caddress = $quer->fetchAll();
                        }
                        ?>
                        <div class="card checkout-step-two">
                           <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                 <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="number">1</span> Delivery Address
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseTwo" cla ss="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">

                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Name <span class="required">*</span></label>
                                          <input name="customer_name" class="form-control border-form-control" value="<?php echo $caddress[0]["name"]; ?>" placeholder="Name" type="text" required="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Phone <span class="required">*</span></label>
                                          <input name="customer_mobile" class="form-control border-form-control" value="<?php echo $caddress[0]["mobile_number"]; ?>" placeholder="Phone Number" type="text" onkeypress="return isNumberKey(event)" maxlength="12" minlength="10" readonly required="">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Email Address </label>
                                          <input name="customer_email" class="form-control border-form-control" value="<?php echo $caddress[0]["email"]; ?>" placeholder="Email Address" type="email">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">City <span class="required">*</span></label>
                                          <select name="customer_city" class="select2 form-control border-form-control" data-placeholder="Select a City" required id="customer_city_id">
                                             <option value="">Select City</option>
                                             <?php
                                             $stateid = $caddress[0]["state"];
                                             $cityid = $caddress[0]["city"];
                                             $query = $conn->prepare("SELECT * FROM cities where state_id='$stateid'");
                                             $query->execute();
                                             $citydata = $query->fetchAll();
                                             foreach ($citydata as $city) {
                                                echo '<option value="' . $city["city_name"] . '"';
                                                if ($cityid == $city["id"]) {
                                                   echo "selected";
                                                }
                                                echo '>' . $city["city_name"] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Pincode <span class="required">*</span></label>
                                          <input type="text" name="invoice_pincode" class="form-control" placeholder="Pincode" required value="<?php echo $caddress[0]["pincode"]; ?>" onkeypress="return isNumberKey(event)">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Shipping Address <span class="required">*</span></label>
                                          <textarea name="customer_address" class="form-control border-form-control" required="required"><?php echo $caddress[0]["address"]; ?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Special Instruction</label>
                                          <textarea name="invoice_special_instruction" class="form-control border-form-control" placeholder="Special Instruction"></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Select Delivery Time <span class="required">*</span></label>
                                          <select name="delivery_time_slot" class="select2 form-control border-form-control" data-placeholder="Select Delivery Time" required id="delivery_time_slot_id" required>
                                             <option value="">Select Delivery Time</option>
                                             <br />
                                             <?php
                                             $query = $conn->prepare("SELECT * FROM time_slot ORDER BY priority");
                                             $query->execute();
                                             $timedata = $query->fetchAll();
                                             foreach ($timedata as $time) {
                                                echo '<option value="' . $time["time_slot"] . '">' . $time["time_slot"] . '</option><br />';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="card">
                           <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                 <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="number">2</span> Payment
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="col-12 mb-3 payment-options">
                                    <div class="row">
                                       <input type="hidden" name="applied_coupon_code" id="applied_coupon_code">
                                       <input type="hidden" name="applied_coupon_code_id" id="applied_coupon_code_id">
                                       <input type="hidden" name="applied_coupon_code_type" id="applied_coupon_code_type">
                                       <input type="radio" id="customRadio1" name="invoice_payment_mode" value="1" required checked>
                                       <label class="selected-payment" for="customRadio1">Cash on Delivery</label>
                                       <input type="radio" id="customRadio2" name="invoice_payment_mode" value="2" required>
                                       <label class="" for="customRadio2">Pay Online</label>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="row float-right">
                                       <button type="submit" name="btn_invoice" class="btn btn-secondary mb-2 btn-lg" id="btn_next"> Place Order <i class="fa fa-long-arrow-right ml-2"></i></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>

                  </div>

               </div>
            </div>
         </div>
      </div>

   </section>



   <?php include "footer.php" ?>
   <!-- Bootstrap core JavaScript -->
   <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
   </link>
   <script src="../template/js/1st.js"></script>
   <script src="../template/js/2nd.js"></script>



   <!-- <script src="js/sweetalert.js"></script> -->
   <link href="vendor/datatables/datatables.min.css" rel="stylesheet" />
   <script src="vendor/datatables/datatables.min.js"></script>

   <script>
      $(document).ready(function() {
         function update_cart(action, cartId) {
            let quantityElem = $("#quantity_" + cartId);
            let quantity = parseInt(quantityElem.val());

            if (action === "add") {
               quantity += 1; // Increase quantity
            } else if (action === "minus" && quantity > 1) {
               quantity -= 1; // Decrease but NEVER below 1
            } else {
               return; // If quantity is already 1, do nothing
            }

            // Update the input field
            quantityElem.val(quantity);

            // Send AJAX request to update the cart in the database
            $.ajax({
               url: "./cart_update.php",
               type: "POST",
               data: {
                  cart_id: cartId,
                  quantity: quantity
               },
               success: function(response) {
                  console.log("Cart updated:", response);
               },
               error: function() {
                  alert("Error updating cart.");
               }
            });
            window.location.reload(true);

         }

         $(".inc").click(function() {
            let cartId = $(this).attr("onclick").match(/\d+/)[0];
            update_cart("add", cartId);
         });

         $(".dec").click(function() {
            let cartId = $(this).attr("onclick").match(/\d+/)[0];
            update_cart("minus", cartId);
         });

         // Handle product removal (Only when clicking "X" button)
         $(".remove-cart").click(function() {
            let cartId = $(this).data("cart-id");

            $.ajax({
               url: "./cart_remove.php",
               type: "POST",
               data: {
                  cart_id: cartId
               },
               success: function(response) {
                  console.log("Item removed:", response);
                  location.reload(); // Refresh the cart
               },
               error: function() {
                  alert("Error removing item.");
               }
            });
         });
      });
   </script>
   <script>
      $("input[name='invoice_payment_mode']").on("change", (e) => {
         for (const iterator of $(".selected-payment")) {
            $(iterator).removeClass("selected-payment")
         }

         if (e.target.value == 1) {
            document.getElementById("btn_next").innerText = "Place Order";
         } else {
            document.getElementById("btn_next").innerText = "Proceed to payment";
         }
         var icon = document.createElement("i");
         icon.className = "fa fa-long-arrow-right ml-2"
         document.getElementById("btn_next").appendChild(icon)
         $(e.target).next().addClass("selected-payment")
      })
      $(document).ready(function() {
         document.getElementById("btn-offer-close").addEventListener("click", () => {
            setTimeout(() => {
               $("#header-nav-menu").css("position", "sticky");
            }, 200)
         })
      });
   </script>
</body>

</html>