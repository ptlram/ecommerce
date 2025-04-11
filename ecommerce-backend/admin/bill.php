<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Metronic Admin Theme #4 | Buttons Datatable</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta
        content="Preview page of Metronic Admin Theme #4 for buttons extension demos"
        name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link
        href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/font-awesome/css/font-awesome.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link
        href="../assets/global/plugins/datatables/datatables.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link
        href="../assets/global/css/components.min.css"
        rel="stylesheet"
        id="style_components"
        type="text/css" />
    <link
        href="../assets/global/css/plugins.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link
        href="../assets/layouts/layout4/css/layout.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/layouts/layout4/css/themes/default.min.css"
        rel="stylesheet"
        type="text/css"
        id="style_color" />
    <link
        href="../assets/layouts/layout4/css/custom.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php
    include "./header.php"
    ?>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container" style="margin-top: 85px;">
        <!-- BEGIN SIDEBAR -->
        <?php
        include "./sidebar.php"
        ?>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN CONTENT BODY -->
                <?php
                include "../connection.php"; // Database connection

                $query = $conn->prepare("SELECT id, mobile, customer_name, final_price, delivery_time, discount FROM orders ORDER BY id DESC");
                $query->execute();
                $orders = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">ORDER DETAILS</div>
                            </div>
                            <div class="portlet-body">
                                <?php
                                include "../connection.php"; // Database connection

                                if (isset($_GET['order_id'])) {
                                    $order_id = $_GET['order_id'];

                                    // Fetch order details
                                    $query = $conn->prepare("SELECT * FROM orders WHERE id = :order_id");
                                    $query->execute([":order_id" => $order_id]);
                                    $order = $query->fetch(PDO::FETCH_ASSOC);

                                    if ($order) {
                                ?>
                                        <div style="display: flex; justify-content: space-between;">
                                            <!-- Left Section: Customer Details -->
                                            <div style="width: 45%;">
                                                <p><strong>Name :</strong> <?= htmlspecialchars($order['customer_name']); ?></p>
                                                <p><strong>Mobile :</strong> <?= htmlspecialchars($order['mobile']); ?></p>
                                            </div>

                                            <!-- Right Section: Order & Delivery Details -->
                                            <div style="width: 45%;">
                                                <p><strong>Invoice No. :</strong> BI-<?= htmlspecialchars($order['id']); ?></p>
                                                <p><strong>City :</strong> <?= htmlspecialchars($order['city']); ?></p>
                                                <p><strong>Pincode :</strong> <?= htmlspecialchars($order['pincode']); ?></p>
                                                <p><strong>Address :</strong> <?= htmlspecialchars($order['address']); ?></p>
                                                <p><strong>Delivery Time :</strong> <?= htmlspecialchars($order['delivery_time']); ?></p>
                                                <div class="form-group">
                                                    <p><strong>Delivery Route :</strong>
                                                        <select class="form-control select2me" style="padding: 5px ; width: 200px" ;>
                                                            <option>Select Delivery Boy</option>
                                                            <!-- Fetch & populate delivery boys from database -->
                                                        </select>
                                                    </p>
                                                </div>
                                                <button style="padding: 5px 10px; background-color: #17c2a4; color: white; border: none;">Assign Delivery Boy</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label><strong>Delivery Date</strong></label>
                                            <input class="form-control select2me" style="width: 200px" type="date" value="<?= date("Y-m-d"); ?>">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label><strong>Send</strong></label>
                                            <input type="checkbox"> SMS
                                            <input type="checkbox"> Email
                                        </div>
                                        <br>
                                        <!-- Status & Notifications -->

                                        <div class="form-group">
                                            <form action="" method="post">
                                                <label class="status"><strong>Status</strong></label>
                                                <!-- Hidden input with the order id -->
                                                <input type="hidden" name="selected_invoice_id" value="<?= isset($order['id']) ? htmlspecialchars($order['id']) : ''; ?>">
                                                <select class="form-control select2me" name="selected_invoice_status" data-placeholder="Select Status" required style="width: 200px;">
                                                    <option value="Pending" style="color: #ff9800;" <?= (isset($order['status']) && $order['status'] == "Pending") ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="Confirm" style="color: #4caf50;" <?= (isset($order['status']) && $order['status'] == "Confirm") ? 'selected' : ''; ?>>Confirm</option>
                                                    <option value="Dispatched" style="color: #2196f3;" <?= (isset($order['status']) && $order['status'] == "Dispatched") ? 'selected' : ''; ?>>Dispatched</option>
                                                    <option value="Delivered" style="color: #2e7d32;" <?= (isset($order['status']) && $order['status'] == "Delivered") ? 'selected' : ''; ?>>Delivered</option>
                                                    <option value="Rejected" style="color: #f44336;" <?= (isset($order['status']) && $order['status'] == "Rejected") ? 'selected' : ''; ?>>Rejected</option>
                                                    <option value="Canceled" style="color: #9e9e9e;" <?= (isset($order['status']) && $order['status'] == "Canceled") ? 'selected' : ''; ?>>Canceled</option>
                                                </select>
                                                <div class="form-group" style="margin-top: 10px;">
                                                    <button type="submit" style="padding: 5px 10px; background-color: #17c2a4; color: white; border: none;">Change</button>
                                                </div>
                                            </form>
                                        </div>
                            </div>
                    <?php
                                    } else {
                                        echo "<p style='color:red;'>Error: Order not found!</p>";
                                    }
                                } else {
                                    echo "<p style='color:red;'>Error: Order ID is missing!</p>";
                                }
                    ?>
                        </div>
                    </div>

                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        include "../connection.php"; // Database connection

                        // Check if order_id is set in the URL
                        if (isset($_GET['order_id'])) {
                            $order_id = $_GET['order_id'];

                            // Fetch order details for the specific order_id
                            $query = $conn->prepare("SELECT product_name, mrp, offer_mrp, quantity FROM order_details WHERE order_id = :order_id ORDER BY id DESC");
                            $query->execute([":order_id" => $order_id]);
                            $order_details = $query->fetchAll(PDO::FETCH_ASSOC);
                        } else {
                            echo "<p style='color:red;'>Error: Order ID is missing!</p>";
                            exit();
                        }
                        ?>
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">ORDERS LIST</div>
                                <?php if (!empty($order_id)): ?>
                                    <button style="margin-top: 4px; margin-left: 4px;" class="btn green caption-subject bold uppercase" onclick="openInvoice(<?php echo htmlspecialchars($order_id, ENT_QUOTES, 'UTF-8'); ?>)">
                                        View Invoice
                                    </button>
                                <?php endif; ?>

                                <script>
                                    function openInvoice(orderId) {
                                        window.open("bill_invoice.php?orderid=" + orderId, "_blank");
                                    }
                                </script>

                            </div>
                            <div class="portlet-body">


                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product Name</th>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>MRP</th>
                                            <th>Offer Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $total_mrp = 0;

                                        // Calculate total MRP (mrp * quantity) for each product
                                        foreach ($order_details as $detail) {
                                            $total_mrp += $detail['mrp'] * $detail['quantity'];
                                            echo "<tr>
                                                    <td>{$i}</td>
                                                    <td>{$detail['product_name']}</td>
                                                    <td>0.00</td>  <!-- CGST Fixed Value -->
                                                    <td>0.00</td>  <!-- SGST Fixed Value -->
                                                    <td>{$detail['mrp']}</td>
                                                    <td>{$detail['offer_mrp']}</td>
                                                    <td>{$detail['quantity']}</td>
                                                </tr>";
                                            $i++;
                                        }

                                        // Display Total MRP row
                                        echo "<tr>
                                                <td colspan='6' style='text-align:right;'><strong>Total MRP:</strong></td>
                                                <td colspan='3'>{$total_mrp}</td>
                                            </tr>";

                                        // If an order ID is set, fetch the discount from orders table
                                        if (isset($_GET['order_id'])) {
                                            $order_id = $_GET['order_id'];
                                            $query = $conn->prepare("SELECT discount ,delivery_charge FROM orders WHERE id = :order_id");
                                            $query->execute([':order_id' => $order_id]);
                                            $order = $query->fetch(PDO::FETCH_ASSOC);

                                            // Display Discount row
                                            echo "<tr>
                                                    <td colspan='6' style='text-align:right;'><strong>Discount:</strong></td>
                                                    <td colspan='3'>" . $order['discount'] . "</td>
                                                </tr>";

                                            // Calculate and display Net Amount (Total MRP - Discount)
                                            $net_amount = $total_mrp - $order['discount'];
                                            echo "<tr>
                                                    <td colspan='6' style='text-align:right;'><strong>Net Amount:</strong></td>
                                                    <td colspan='3'>{$net_amount}</td>
                                                </tr>";
                                            echo "<tr>
                                                    <td colspan='6' style='text-align:right;'><strong>Delivery Charge:</strong></td>
                                                    <td colspan='3'>" . $order['delivery_charge'] . "</td>
                                                </tr>";

                                            $final_amount = $net_amount + $order['delivery_charge'];

                                            echo "<tr>
                                                    <td colspan='6' style='text-align:right;'><strong>TOTAL:</strong></td>
                                                    <td colspan='3'>" . $final_amount . "</td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                include "../connection.php"; // Database connection

                                // Process the form submission to update status
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $order_id = trim($_POST['selected_invoice_id']);
                                    $new_status = trim($_POST['selected_invoice_status']);

                                    if ($new_status == "Delivered") {
                                        $amount = $final_amount;
                                        $remark = 'order no. :' . $order_id;
                                        $date = date('Y-m-d'); // Get today's date

                                        $stmt2 = $conn->prepare("INSERT INTO transaction (credit, date, remark) VALUES (:credit, :date, :remark)");

                                        // Bind parameters
                                        $stmt2->bindParam(':credit', $amount, PDO::PARAM_STR);
                                        $stmt2->bindParam(':date', $date, PDO::PARAM_STR);
                                        $stmt2->bindParam(':remark', $remark, PDO::PARAM_STR);

                                        // Execute the statement
                                        $stmt2->execute();


                                        if (!empty($order_id) && !empty($new_status)) {
                                            try {
                                                $updateQuery = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
                                                $updateQuery->execute([
                                                    ':status' => $new_status,
                                                    ':id'     => $order_id
                                                ]);
                                                echo "<script>alert('Order status updated successfully!'); window.location.href = 'orders.php';</script>";
                                                exit();
                                            } catch (PDOException $e) {
                                                echo "<script>alert('Error updating status: " . $e->getMessage() . "'); window.history.back();</script>";
                                                exit();
                                            }
                                        } else {
                                            echo "<script>alert('Please select a valid status.'); window.history.back();</script>";
                                            exit();
                                        }
                                    } else {
                                        if (!empty($order_id) && !empty($new_status)) {
                                            try {
                                                $updateQuery = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
                                                $updateQuery->execute([
                                                    ':status' => $new_status,
                                                    ':id'     => $order_id
                                                ]);
                                                echo "<script>alert('Order status updated successfully!'); window.location.href = 'orders.php';</script>";
                                                exit();
                                            } catch (PDOException $e) {
                                                echo "<script>alert('Error updating status: " . $e->getMessage() . "'); window.history.back();</script>";
                                                exit();
                                            }
                                        } else {
                                            echo "<script>alert('Please select a valid status.'); window.history.back();</script>";
                                            exit();
                                        }
                                    }
                                    // Retrieve current order details if order_id is provided via GET
                                    $order = [];
                                    if (isset($_GET['order_id'])) {
                                        $order_id = $_GET['order_id'];
                                        $query = $conn->prepare("SELECT * FROM orders WHERE id = :order_id");
                                        $query->execute([':order_id' => $order_id]);
                                        $order = $query->fetch(PDO::FETCH_ASSOC);
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php
    include "./footer.php"
    ?>
    <!-- END FOOTER -->
    <!-- BEGIN QUICK NAV -->

    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->

    <div class="quick-nav-overlay"></div>

    <script
        src="../assets/global/plugins/jquery.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/js.cookie.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/jquery.blockui.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script
        src="../assets/global/scripts/datatable.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/datatables/datatables.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script
        src="../assets/global/scripts/app.min.js"
        type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script
        src="../assets/pages/scripts/table-datatables-buttons.min.js"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script
        src="../assets/layouts/layout4/scripts/layout.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/layouts/layout4/scripts/demo.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/layouts/global/scripts/quick-sidebar.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/layouts/global/scripts/quick-nav.min.js"
        type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>