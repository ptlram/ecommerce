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

                $query = $conn->prepare("SELECT id, mobile, customer_name, final_price, delivery_time, discount,status FROM orders ORDER BY id DESC");
                $query->execute();
                $orders = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">ORDERS LIST</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>copy</th>
                                            <th>Bill No</th>
                                            <th>Status</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Total</th>
                                            <th>Delivery</th>
                                            <th>Points</th>
                                            <!-- <th>Coupon Discount</th>
                                            <th>Payable</th>
                                            <th>Mode</th>
                                            <th>Date</th>
                                            <th>Points</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($orders as $order) {
                                            // Map order status to text and color
                                            $status = $order['status'];
                                            switch ($status) {
                                                case "Pending":
                                                    $color = "#ff9800"; // Pending
                                                    $statusText = "Pending";
                                                    break;
                                                case "Confirm":
                                                    $color = "#4caf50"; // Confirm
                                                    $statusText = "Confirm";
                                                    break;
                                                case "Dispatched":
                                                    $color = "#2196f3"; // Dispatched
                                                    $statusText = "Dispatched";
                                                    break;
                                                case "Delivered":
                                                    $color = "#2e7d32"; // Delivered
                                                    $statusText = "Delivered";
                                                    break;
                                                case "Rejected":
                                                    $color = "#f44336"; // Rejected
                                                    $statusText = "Rejected";
                                                    break;
                                                case "Canceled":
                                                    $color = "#9e9e9e"; // Canceled
                                                    $statusText = "Canceled";
                                                    break;
                                                default:
                                                    $color = "#000000";
                                                    $statusText = $status;
                                                    break;
                                            }

                                            echo "<tr>
                                    <td>{$order['id']}</td>
                                    <td><a href='./copy_order.php?order_id=" . $order['id'] . "'>copy</a></td>
                                    <td><a href='./bill.php?order_id=" . $order['id'] . "'>Bill No-" . $order['id'] . "</a></td>
                                    <td style='color: {$color};'>{$statusText}</td>
                                    <td>{$order['customer_name']}</td>
                                    <td>{$order['mobile']}</td>
                                    <td>{$order['final_price']}</td>
                                    <td>{$order['delivery_time']}</td>
                                    <td>{$order['discount']}</td>
                                </tr>";
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
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