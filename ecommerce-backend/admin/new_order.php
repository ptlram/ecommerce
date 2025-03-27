<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Metronic Admin Theme #4 | Bootstrap Form Controls</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="../assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php
    include "./header.php";
    ?>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php
        include "./sidebar.php";
        ?>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Add New Order
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="col-md-6">
                                            <h3 style="padding:5px 0px;font-weight: 500;">New Order</h3>
                                            <div class="form-group">
                                                <label for="Customer">Customer<span class="required">*</span></label>

                                                <select class="bs-select form-control" data-live-search="true" name="customer_id" id="customer_id" data-size="8" required>
                                                    <option value="">Select Customer</option>
                                                    <?php
                                                    include "../connection.php";

                                                    $query = $conn->prepare("SELECT * FROM customers");
                                                    $query->execute();
                                                    $customers = $query->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($customers as $customer) {
                                                        $id = $customer["city"];

                                                        // Ensure city ID is not empty/null before querying
                                                        if (!empty($id)) {
                                                            $subquery = $conn->prepare("SELECT city_name FROM cities WHERE id = :id");
                                                            $subquery->execute(['id' => $id]);
                                                            $city = $subquery->fetch(PDO::FETCH_ASSOC);

                                                            // Get city name safely
                                                            $cityName = $city ? $city["city_name"] : "Unknown City";
                                                        } else {
                                                            $cityName = "Unknown City"; // Default if no city is found
                                                        }

                                                        echo '<option value="' . htmlspecialchars($customer["id"]) . '"  
              data-mobile_number="' . htmlspecialchars($customer["mobile_number"]) . '" 
              data-email="' . htmlspecialchars($customer["email"]) . '" 
              data-address="' . htmlspecialchars($customer["address"]) . '" 
              data-city="' . htmlspecialchars($cityName) . '" > '
                                                            . htmlspecialchars($customer["name"]) . '-' . htmlspecialchars($customer["mobile_number"]) . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label class="mobile_no">Mobile No.<span class="required">*</span></label>
                                                <input type="text" name="cmobile" id="cmobile" class="form-control" value="" placeholder="Customer Mobile no" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="email">Email ID.</label>
                                                <input type="text" name="customer_email" id="customer_email" class="form-control" value="" placeholder="Customer Email" requried>
                                            </div>
                                            <div class="form-group">
                                                <label class="city">City</label>
                                                <input type="text" name="customer_city" id="customer_city" class="form-control" value="" placeholder="Customer city" requried>
                                            </div>

                                            <div class="form-group">
                                                <label class="address">Address<span class="required">*</span></label>
                                                <textarea class="form-control" placeholder="Customer Addres" id="customer_address" name="customer_address" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="pincode">Pincode<span class="required">*</span></label>
                                                <input type="text" name="customer_pincode" id="customer_pincode" class="form-control" value="" placeholder="Customer Pincode" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="delivery_time">Delivery Time<span class="required">*</span></label>
                                                <select class="select2me form-control" name="delivery_time_slot" required>
                                                    <option value="">Select Delivery Time Slot</option>
                                                    <?php
                                                    include "../connection.php"; // Include database connection

                                                    // Fetch time slots from database
                                                    $query = $conn->prepare("SELECT time_slot FROM time_slot ORDER BY priority ASC");
                                                    $query->execute();
                                                    $time_slots = $query->fetchAll(PDO::FETCH_ASSOC);

                                                    // Populate the dropdown with database values
                                                    foreach ($time_slots as $slot) {
                                                        echo '<option value="' . htmlspecialchars($slot['time_slot']) . '">' . htmlspecialchars($slot['time_slot']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="discount">Discount<span class="required">*</span></label>
                                                <input type="text" name="invoice_discount" class="form-control" value="0" placeholder="Discount">
                                                <span class="help-block" id="point_message"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="delivery_charge">Delivery Charge<span class="required">*</span></label>
                                                <input type="text" name="invoice_delivery_charges" class="form-control" value="0" placeholder="Delivery Charge">
                                            </div>
                                            <div class="form-group">
                                                <label class="special_instruction">Special Instruction</label>
                                                <textarea class="form-control" placeholder="Special Instruction" id="invoice_special_instruction" name="invoice_special_instruction" requried></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="sms">Send sms </label>
                                                <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="send_sms" name="send_sms" value="1"> YES
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="col-md-12">
                                                    <div class="col-md-1">
                                                        Sr No.
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label">Produt Name</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="control-label">MRP</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="control-label">Offer MRP</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="control-label">Quantity</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="control-label">Total</label>
                                                    </div>

                                                    <div id="productList" class="col-md-6">
                                                        <div class="product-entry" style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                                                            <span>1.</span>
                                                            <select class="product-select  form-control" data-live-search="true" name="product[]" required data-size="8" style="padding: 5px; width: 120px;">
                                                                <option value="">Select Product</option>
                                                                <?php
                                                                include("../connection.php");

                                                                try {
                                                                    $pd = $conn->prepare("SELECT id, product_name, mrp, retailer_price FROM products");
                                                                    $pd->execute();
                                                                    $products = $pd->fetchAll(PDO::FETCH_ASSOC);

                                                                    foreach ($products as $pro) {
                                                                        echo '<option value="' . $pro['id'] . '" data-mrp="' . $pro['mrp'] . '" data-offer="' . $pro['retailer_price'] . '">' . htmlspecialchars($pro['product_name']) . '</option>';
                                                                    }
                                                                } catch (PDOException $e) {
                                                                    echo '<option value="">Error loading products</option>';
                                                                }
                                                                ?>
                                                            </select>

                                                            <!-- Hidden input to store product name -->
                                                            <input type="hidden" name="product_name[]" class="product-name form-control">

                                                            <input type="text" name="mrp[]" class="mrp form-control" placeholder="MRP" readonly style="padding: 5px; width: 80px;">
                                                            <input type="text" name="offer_mrp[]" class="offer-mrp form-control" placeholder="Offer MRP" readonly style="padding: 5px; width: 100px;">
                                                            <input type="number" name="qty[]" class="qty form-control" placeholder="Qty" required style="padding: 5px; width: 60px;">
                                                            <input type="text" name="total_price[]" class="total-price form-control" placeholder="Total" readonly style="padding: 5px; width: 100px;">
                                                            <button type="button" class="add-row" style="padding: 5px 10px; background-color: green; color: white;">+</button>
                                                            <button type="button" class="remove-row" style="padding: 5px 10px; background-color: red; color: white;">-</button>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!-- Grand Total -->
                                                <div style="font-weight: bold; margin-top: 10px;">
                                                    Grand Total: <input type="text" id="grandTotal" name="grandTotal" class="form-control" readonly style="padding: 5px; width: 120px;">
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit" name="submit" class="btn blue">Add Order</button>
                                                <button class="btn btn-success"><a href="brandlist.php" style="text-decoration: none;color:white">Cancel</a></button>
                                            </div>
                                        </div>
                                        <div class="form-actions">

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                    </div>

                </div>

                <!-- END PAGE BASE CONTENT -->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php
    include "./footer.php";
    ?>
    <!-- END FOOTER -->
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- BEGIN CORE PLUGINS -->
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $(document).on("change", "select[name='customer_id']", function() {
                var selected = $(this).find(":selected"); // Get selected option

                // Fetch customer details from data attributes
                var mobile_number = selected.data("mobile_number");
                var email = selected.data("email");
                var city = selected.data("city");
                var address = selected.data("address");

                // Update input fields
                $("#cmobile").val(mobile_number);
                $("#customer_email").val(email);
                $("#customer_city").val(city);
                $("#customer_address").val(address);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Update MRP, Offer MRP, and Total when selecting a product
            $(document).on("change", ".product-select", function() {
                var selected = $(this).find(":selected");
                var row = $(this).closest(".product-entry");

                row.find(".mrp").val(selected.data("mrp") || "");
                row.find(".offer-mrp").val(selected.data("offer") || "");
                row.find(".qty").val(1).trigger("input"); // Default qty to 1
            });

            // Update total price when changing quantity
            $(document).on("input", ".qty", function() {
                var row = $(this).closest(".product-entry");
                var offerPrice = parseFloat(row.find(".offer-mrp").val()) || 0;
                var qty = parseInt($(this).val()) || 0;

                // Ensure quantity is always ≥ 0
                if (qty < 0) {
                    $(this).val(0);
                    qty = 0;
                }

                var total = offerPrice * qty;
                row.find(".total-price").val(total.toFixed(2));

                updateGrandTotal(); // Update total after every qty change
            });

            // Add new row
            $(document).on("click", ".add-row", function() {
                var newRow = $(".product-entry:first").clone();
                newRow.find("input").val("");
                newRow.find("select").val("");
                newRow.find(".qty").val(1); // Set default qty to 1
                newRow.find("span").text($("#productList .product-entry").length + 1);

                // Ensure each new row has both Add and Remove buttons
                newRow.find(".add-row").remove();
                newRow.find(".remove-row").remove();
                newRow.append('<button type="button" class="add-row" style="padding: 5px 10px; background-color: green; color: white;">+</button>');
                newRow.append('<button type="button" class="remove-row" style="padding: 5px 10px; background-color: red; color: white;">-</button>');

                $("#productList").append(newRow);
                updateRowNumbers();
            });

            // Remove row
            $(document).on("click", ".remove-row", function() {
                if ($("#productList .product-entry").length > 1) {
                    $(this).closest(".product-entry").remove();
                    updateRowNumbers();
                    updateGrandTotal();
                } else {
                    alert("At least one product is required.");
                }
            });

            // Update Grand Total
            function updateGrandTotal() {
                var grandTotal = 0;
                $(".total-price").each(function() {
                    grandTotal += parseFloat($(this).val()) || 0;
                });
                $("#grandTotal").val(grandTotal.toFixed(2));
            }

            // Update row numbers dynamically
            function updateRowNumbers() {
                $("#productList .product-entry").each(function(index) {
                    $(this).find("span").text(index + 1);
                });
            }
        });
    </script>

    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>

<?php
include "../connection.php"; // Database connection

if (isset($_POST["submit"])) {
    try {
        $conn->beginTransaction(); // Start transaction

        // Fetch customer name from the database using customer_id
        $customer_id = $_POST["customer_id"];
        $query = $conn->prepare("SELECT name FROM customers WHERE id = :customer_id");
        $query->execute([":customer_id" => $customer_id]);
        $customer = $query->fetch(PDO::FETCH_ASSOC);
        $customer_name = $customer["name"]; // Store fetched name

        // Store other values in variables
        $mobile = $_POST["cmobile"];
        $email = $_POST["customer_email"];
        $city = $_POST["customer_city"];
        $address = $_POST["customer_address"];
        $pincode = $_POST["customer_pincode"];
        $delivery_time = $_POST["delivery_time_slot"];
        $discount = $_POST["invoice_discount"];
        $delivery_charge = $_POST["invoice_delivery_charges"];
        $special_instruction = $_POST["invoice_special_instruction"];
        $sms = isset($_POST["send_sms"]) ? 1 : 0;
        $final_price = $_POST["grandTotal"];

        // Insert order into `orders` table
        $insertQuery = $conn->prepare("INSERT INTO orders 
            (customer_name, mobile, email, city, address, pincode, delivery_time, discount, delivery_charge, special_instruction, sms, final_price) 
            VALUES 
            (:customer_name, :mobile, :email, :city, :address, :pincode, :delivery_time, :discount, :delivery_charge, :special_instruction, :sms, :final_price)");

        $insertQuery->execute([
            ":customer_name" => $customer_name,
            ":mobile" => $mobile,
            ":email" => $email,
            ":city" => $city,
            ":address" => $address,
            ":pincode" => $pincode,
            ":delivery_time" => $delivery_time,
            ":discount" => $discount,
            ":delivery_charge" => $delivery_charge,
            ":special_instruction" => $special_instruction,
            ":sms" => $sms,
            ":final_price" => $final_price
        ]);

        $order_id = $conn->lastInsertId(); // Get the last inserted order ID

        // Insert each product into `order_details` table
        if (!empty($_POST['product'])) {
            $insertDetails = $conn->prepare("INSERT INTO order_details ( product_name, mrp,offer_mrp, quantity,order_id) VALUES (?,?, ?, ?, ?)");

            foreach ($_POST['product'] as $key => $product_id) {
                $product_id = $_POST['product'][$key]; // Get product name
                $q = $conn->prepare("SELECT product_name from products where id=$product_id ");
                $q->execute();
                $p_name = $q->fetchAll();
                $product_name = $p_name[0]["product_name"];

                $mrp = $_POST['mrp'][$key];
                $offer_mrp = $_POST['offer_mrp'][$key];
                $quantity = $_POST['qty'][$key];

                $insertDetails->execute([$product_name, $mrp, $offer_mrp, $quantity, $order_id]);
            }
        }

        $conn->commit(); // Commit transaction

        // JavaScript alert and redirect after successful insertion
        echo "<script>alert('Order inserted successfully!'); window.location.href='./orders.php';</script>";
        exit();
    } catch (PDOException $e) {
        $conn->rollBack(); // Rollback transaction if an error occurs
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>