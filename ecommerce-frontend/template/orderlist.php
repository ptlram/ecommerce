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
   <?php
   include "./header.php";
   ?>
   <section class="account-page section-padding">
      <?php

      include "./connection.php"; // Ensure PDO connection is set up

      // Check if session email is set
      if (isset($_SESSION['email'])) {
         $logedemail = $_SESSION['email'];

         // Secure query using prepared statements
         $query = $conn->prepare("SELECT * FROM customers WHERE email = '$logedemail' OR mobile_number = '$logedemail' ");
         $query->execute();

         // Fetch the user data
         $userdata = $query->fetchAll();
      }
      ?>
      <div class="container">
         <div class="row">
            <div class="col-lg-9 mx-auto">
               <div class="row no-gutters">
                  <div class="col-md-4">
                     <div class="card account-left">
                        <div class="user-profile-header">
                           <img alt="logo" src="img/user.jpg">
                           <h5 class="mb-1 text-secondary"><strong>Hi </strong><?php echo $userdata[0]['name'] ?? null; ?></h5>
                           <p> <?= $userdata[0]['mobile_number'] ?? '+91 000 000 0000' ?></p>
                        </div>
                        <div class="list-group">
                           <a href="my-profile.php" class="list-group-item list-group-item-action "><i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile</a>
                           <a href="my-address.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address</a>
                           <a href="orderlist.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List</a>
                           <a href="logout.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i> Logout</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="card card-body account-right">
                        <div class="widget">
                           <div class="section-header">
                              <h5 class="heading-design-h5">
                                 Order List
                              </h5>
                           </div>
                           <div class="order-list-tabel-main table-responsive">
                              <table class="datatabel table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
                                 <thead>
                                    <tr>
                                       <th>Order #</th>
                                       <th>Date Purchased</th>
                                       <th>Status</th>
                                       <th>Total</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $oquery = $conn->prepare("SELECT * FROM orders WHERE email = '$logedemail' OR mobile = '$logedemail' ");
                                    $oquery->execute();
                                    $orderdata = $oquery->fetchAll();
                                    foreach ($orderdata as $data) {
                                       echo '<tr>
                                                <td>#' . $data["id"] . '</td>
                                                <td>' . $data["created_at"] . '</td>
                                                <td>' . $data["status"] . '</td>
                                                <td>₹' . $data["final_price"] . '</td>
                                                <td><a data-toggle="tooltip" data-placement="top" title="" href="orderdetails.php?orderid=' . $data["id"] . '" data-original-title="View Detail" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a></td>
                                             </tr>';
                                    }
                                    ?>

                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php include "./footer.php" ?>
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
   <!-- Data Tables -->
   <link href="vendor/datatables/datatables.min.css" rel="stylesheet" />
   <script src="vendor/datatables/datatables.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.datatabel').DataTable();
      });
   </script>
   <!-- Custom -->
   <script src="js/custom.js"></script>
</body>

</html>