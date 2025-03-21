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

                            <?php
                            include "../connection.php";

                            // Initialize order data arrays
                            $order_data = [];
                            $order_products = [];

                            // Check if order_id is set in the URL
                            if (isset($_GET['order_id'])) {
                                $order_id = $_GET['order_id'];

                                // Fetch order details from the orders table
                                $query = $conn->prepare("SELECT * FROM orders WHERE id = :order_id");
                                $query->execute([':order_id' => $order_id]);
                                $order_data = $query->fetch(PDO::FETCH_ASSOC);

                                // If order exists, fetch associated products from the order_details table
                                if ($order_data) {
                                    $productQuery = $conn->prepare("SELECT * FROM order_details WHERE order_id = :order_id");
                                    $productQuery->execute([':order_id' => $order_data['id']]);
                                    $order_products = $productQuery->fetchAll(PDO::FETCH_ASSOC);
                                }
                            }
                            ?>

                            <div class="portlet-body form">
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="col-md-6">
                                            <h3 style="padding:5px 0px;font-weight:500;">Copy Order</h3>
                                            <!-- Customer Details -->
                                            <div class="form-group">
                                                <label for="Customer">Customer <span class="required">*</span></label>
                                                <!-- Display customer name as read-only; store customer_id in hidden input -->
                                                <input type="hidden" name="customer_id" value="<?= isset($order_data['customer_id']) ? htmlspecialchars($order_data['customer_id']) : ''; ?>">
                                                <input type="text" class="form-control" value="<?= isset($order_data['customer_name']) ? htmlspecialchars($order_data['customer_name']) : ''; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="mobile_no">Mobile No. <span class="required">*</span></label>
                                                <input type="text" name="customer_mno" id="customer_mno" class="form-control" value="<?= isset($order_data['mobile']) ? htmlspecialchars($order_data['mobile']) : ''; ?>" placeholder="Customer Mobile no" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="email">Email ID.</label>
                                                <input type="text" name="customer_email" id="customer_email" class="form-control" value="<?= isset($order_data['email']) ? htmlspecialchars($order_data['email']) : ''; ?>" placeholder="Customer Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="city">City</label>
                                                <input type="text" name="customer_city" id="customer_city" class="form-control" value="<?= isset($order_data['city']) ? htmlspecialchars($order_data['city']) : ''; ?>" placeholder="Customer City" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="address">Address <span class="required">*</span></label>
                                                <textarea class="form-control" placeholder="Customer Address" id="customer_address" name="customer_address" required><?= isset($order_data['address']) ? htmlspecialchars($order_data['address']) : ''; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="pincode">Pincode <span class="required">*</span></label>
                                                <input type="text" name="customer_pincode" id="customer_pincode" class="form-control" value="<?= isset($order_data['pincode']) ? htmlspecialchars($order_data['pincode']) : ''; ?>" placeholder="Customer Pincode" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="delivery_time">Delivery Time <span class="required">*</span></label>
                                                <select class="select2me form-control" name="delivery_time_slot" required>
                                                    <option value="">Select Delivery Time Slot</option>
                                                    <option value="03:00 PM To 05:00 PM" <?= (isset($order_data['delivery_time']) && $order_data['delivery_time'] == "03:00 PM To 05:00 PM") ? 'selected' : ''; ?>>03:00 PM To 05:00 PM</option>
                                                    <option value="10:00 AM To 01:00 PM" <?= (isset($order_data['delivery_time']) && $order_data['delivery_time'] == "10:00 AM To 01:00 PM") ? 'selected' : ''; ?>>10:00 AM To 01:00 PM</option>
                                                    <option value="10:00 AM To 09:00 PM" <?= (isset($order_data['delivery_time']) && $order_data['delivery_time'] == "10:00 AM To 09:00 PM") ? 'selected' : ''; ?>>10:00 AM To 09:00 PM</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="discount">Discount <span class="required">*</span></label>
                                                <input type="text" name="invoice_discount" class="form-control" value="<?= isset($order_data['discount']) ? htmlspecialchars($order_data['discount']) : '0'; ?>" placeholder="Discount">
                                                <span class="help-block" id="point_message"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="delivery_charge">Delivery Charge <span class="required">*</span></label>
                                                <input type="text" name="invoice_delivery_charges" class="form-control" value="<?= isset($order_data['delivery_charge']) ? htmlspecialchars($order_data['delivery_charge']) : '0'; ?>" placeholder="Delivery Charge">
                                            </div>
                                            <div class="form-group">
                                                <label class="special_instruction">Special Instruction</label>
                                                <textarea class="form-control" placeholder="Special Instruction" id="invoice_special_instruction" name="invoice_special_instruction" required><?= isset($order_data['special_instruction']) ? htmlspecialchars($order_data['special_instruction']) : ''; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="sms">Send sms </label>
                                                <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="send_sms" name="send_sms" value="1" <?= (isset($order_data['sms']) && $order_data['sms'] == 1) ? 'checked' : ''; ?>> YES
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Product List Section -->
                                            <div>
                                                <div id="productList">
                                                    <?php
                                                    if (!empty($order_products)) {
                                                        $i = 1;
                                                        foreach ($order_products as $product) {
                                                    ?>
                                                            <div class="product-entry" style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                                                                <span><?= $i; ?>.</span>
                                                                <select name="product[]" class="product-select" required style="padding: 5px; width: 120px;">
                                                                    <option value="">Select Product</option>
                                                                    <?php
                                                                    // Fetch products for dropdown
                                                                    $pd = $conn->prepare("SELECT id, product_name, mrp, retailer_price FROM products");
                                                                    $pd->execute();
                                                                    $products = $pd->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach ($products as $pro) {
                                                                        $selected = ($pro['id'] == $product['product_id']) ? 'selected' : '';
                                                                        echo '<option value="' . $pro['id'] . '" data-mrp="' . $pro['mrp'] . '" data-offer="' . $pro['retailer_price'] . '" ' . $selected . '>' . htmlspecialchars($pro['product_name']) . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <!-- Hidden input for product name -->
                                                                <input type="hidden" name="product_name[]" class="product-name" value="<?= htmlspecialchars($product['product_name']); ?>">
                                                                <input type="text" name="mrp[]" class="mrp" placeholder="MRP" readonly style="padding: 5px; width: 80px;" value="<?= htmlspecialchars($product['mrp']); ?>">
                                                                <input type="text" name="offer_mrp[]" class="offer-mrp" placeholder="Offer MRP" readonly style="padding: 5px; width: 100px;" value="<?= htmlspecialchars($product['offer_mrp']); ?>">
                                                                <input type="number" name="qty[]" class="qty" placeholder="Qty" required style="padding: 5px; width: 60px;" value="<?= htmlspecialchars($product['quantity']); ?>">
                                                                <input type="text" name="total_price[]" class="total-price" placeholder="Total" readonly style="padding: 5px; width: 100px;" value="">
                                                                <button type="button" class="add-row" style="padding: 5px 10px; background-color: green; color: white;">+</button>
                                                                <button type="button" class="remove-row" style="padding: 5px 10px; background-color: red; color: white;">-</button>
                                                            </div>
                                                        <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        // If no products were copied, show one empty row
                                                        ?>
                                                        <div class="product-entry" style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                                                            <span>1.</span>
                                                            <select name="product[]" class="product-select" required style="padding: 5px; width: 120px;">
                                                                <option value="">Select Product</option>
                                                                <?php
                                                                $pd = $conn->prepare("SELECT id, product_name, mrp, retailer_price FROM products");
                                                                $pd->execute();
                                                                $products = $pd->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($products as $pro) {
                                                                    echo '<option value="' . $pro['id'] . '" data-mrp="' . $pro['mrp'] . '" data-offer="' . $pro['retailer_price'] . '">' . htmlspecialchars($pro['product_name']) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <!-- Hidden input for product name -->
                                                            <input type="hidden" name="product_name[]" class="product-name">
                                                            <input type="text" name="mrp[]" class="mrp" placeholder="MRP" readonly style="padding: 5px; width: 80px;">
                                                            <input type="text" name="offer_mrp[]" class="offer-mrp" placeholder="Offer MRP" readonly style="padding: 5px; width: 100px;">
                                                            <input type="number" name="qty[]" class="qty" placeholder="Qty" required style="padding: 5px; width: 60px;">
                                                            <input type="text" name="total_price[]" class="total-price" placeholder="Total" readonly style="padding: 5px; width: 100px;">
                                                            <button type="button" class="add-row" style="padding: 5px 10px; background-color: green; color: white;">+</button>
                                                            <button type="button" class="remove-row" style="padding: 5px 10px; background-color: red; color: white;">-</button>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <!-- Grand Total -->
                                                <div style="font-weight: bold; margin-top: 10px;">
                                                    Grand Total: <input type="text" id="grandTotal" name="grandTotal" readonly style="padding: 5px; width: 120px;" value="<?= isset($order_data['final_price']) ? htmlspecialchars($order_data['final_price']) : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" name="submit" class="btn blue">Copy Order</button>
                                            <button class="btn btn-success"><a href="brandlist.php" style="text-decoration: none; color:white;">Cancel</a></button>
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

    <script>
        $(document).ready(function() {
            // Update hidden product name whenever a product is selected
            $(document).on("change", ".product-select", function() {
                var selectedText = $(this).find("option:selected").text().trim();
                $(this).closest(".product-entry").find(".product-name").val(selectedText);
            });
        });
    </script>


    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>