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
    <!-- Footer -->
    <?php include "./header.php" ?>
    <!-- END Footer -->



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
    $id = $_GET["orderid"];
    $query = $conn->prepare("SELECT * FROM order_details where order_id=$id");
    $query->execute();
    $orderdetails = $query->fetchAll();

    $cquery = $conn->prepare("SELECT count(*) as totalcount FROM order_details where order_id=$id");
    $cquery->execute();
    $pcount = $cquery->fetchAll();


    ?>
    <section class="blog-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card padding-card reviews-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><?php echo $pcount[0]["totalcount"]; ?> Products</h5>
                            <?php

                            foreach ($orderdetails as $order) {
                                $pname = $order["product_name"];
                                $product = $conn->prepare("SELECT * FROM products where product_name='$pname'");
                                $product->execute();
                                $product = $product->fetchAll();

                                echo '<div class="media mb-4 border-bottom">';
                                echo '<img alt="Product Image" src="../../ecommerce-backend/pages/uploads/products/' . $product[0]["product_image"] . '" class="d-flex mr-3 rounded">';
                                echo '<div class="media-body col-md-11">';
                                echo '<a href="./single.php?product=' . $product[0]["id"] . '">';
                                echo '<h5 class="mt-0">' . $product[0]["product_name"] . ' - ' . $product[0]["variant_name"] . '</h5>';
                                echo '</a>';
                                echo '<span><strong> ' . $product[0]["retailer_price"] . '  </strong></span>';
                                echo '<div>';
                                echo '<span class="float-left text-success">Quantity : ' . $order["quantity"] . '</span>';
                                echo '<div style="display: flex; float: right;">';
                                echo '<div class="rating-component" style="margin-top: 0px; margin-right: 5px;"></div>';
                                echo '</div>'; // end float right
                                echo '</div>'; // end inner div
                                echo '</div>'; // end media-body
                                echo '</div>'; // end media

                            }
                            ?>

                        </div>
                    </div>
                </div>
                <?php
                $id = $_GET["orderid"];
                $oquery = $conn->prepare("SELECT * FROM orders where id=$id");
                $oquery->execute();
                $oorderdetails = $oquery->fetchAll();
                ?>
                <div class="col-md-4">
                    <div class="card sidebar-card mb-4">
                        <div class="card-body">
                            <h6>Order Number <strong class="float-right">BI-<?php echo $oorderdetails[0]["id"] ?></strong></h6>
                            <span class="badge_warning_font">Your Order has been <?php echo $oorderdetails[0]["status"] ?></span></p>
                            <hr>
                            <h5 class="card-title mb-4">Delivery Address</h5>
                            <h5><?php echo $oorderdetails[0]["customer_name"] ?></h5>
                            <a href="#">
                                <h6><?php echo $oorderdetails[0]["address"] ?></h6>
                            </a>
                            <p class="mb-0"><i class="mdi mdi-phone"></i> <?php echo $oorderdetails[0]["mobile"] ?></p>
                            <hr>
                            <p>MRP <strong class="float-right"><?php echo $oorderdetails[0]["discount"] + $oorderdetails[0]["final_price"] ?></strong></p>
                            <p>Discount <strong class="float-right text-success"> - ₹<?php echo $oorderdetails[0]["discount"] ?></strong></p>
                            <p>Delivery Charge <strong class="float-right text-danger">+ ₹<?php echo $oorderdetails[0]["delivery_charge"] ?></strong></p>
                            <hr>
                            <h6>Total Bill Amount <strong class="float-right">₹<?php echo $oorderdetails[0]["final_price"] ?></strong></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "./footer.php" ?>

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