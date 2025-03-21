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

                <div class="row">
                    <div class="col-md-6">

                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Add Expense</div>
                            </div>
                            <div class="portlet-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Amount<span class="required">*</span></label>
                                        <input type="text" name="invoice_Amount" class="form-control" placeholder="Transaction Amount" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Transaction Type<span class="required">*</span></label>
                                        <select name="invoice_Transaction_Types" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Salary">Salary</option>
                                            <option value="Fuel">Fuel</option>
                                            <option value="Commission">Commission</option>
                                            <option value="Vehicle Maintenance">Vehicle Maintenance</option>
                                            <option value="Stationery">Stationery</option>
                                            <option value="Purchase">Purchase</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Date *:</label>
                                        <input class="form-control" type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea class="form-control" placeholder="Remark" name="invoice_Remark"></textarea>
                                    </div>

                                    <button type="submit" name="submit" class="btn blue">Add Expense</button>
                                    <button class="btn btn-success"><a href="expense.php" style="text-decoration: none;color:white">Cancel</a></button>
                                </form>
                                <?php
                                include '../connection.php'; // Include the database connection

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $amount = $_POST["invoice_Amount"];
                                    $transactionType = $_POST["invoice_Transaction_Types"];
                                    $date = $_POST["date"];
                                    $remark = $_POST["invoice_Remark"];

                                    // Validate required fields
                                    if (!empty($amount) && !empty($transactionType) && !empty($date)) {
                                        // Prepare SQL statement
                                        $stmt = $conn->prepare("INSERT INTO expense (amount, date, remark, transaction_type) VALUES (:amount, :date, :remark, :transactionType)");

                                        // Bind parameters
                                        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
                                        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                                        $stmt->bindParam(':remark', $remark, PDO::PARAM_STR);
                                        $stmt->bindParam(':transactionType', $transactionType, PDO::PARAM_STR);

                                        $stmt2 = $conn->prepare("INSERT INTO transaction (debit, date, remark) VALUES (:debit, :date, :remark)");

                                        // Bind parameters
                                        $stmt2->bindParam(':debit', $amount, PDO::PARAM_STR);
                                        $stmt2->bindParam(':date', $date, PDO::PARAM_STR);
                                        $stmt2->bindParam(':remark', $remark, PDO::PARAM_STR);

                                        // Execute and check insertion
                                        if ($stmt->execute()) {
                                            $stmt2->execute();
                                            echo "<script>alert('Expense added successfully!'); window.location.href='expense.php';</script>";
                                        } else {
                                            echo "Error: ";
                                        }
                                    } else {
                                        echo "<script>alert('Please fill in all required fields!');</script>";
                                    }
                                }
                                ?>

                            </div>
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