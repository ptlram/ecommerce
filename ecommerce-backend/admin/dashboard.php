<?php
include "../connection.php";
$query = $conn->prepare("SELECT count(id) as totalcount FROM orders");
$query->execute();
$totalorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM orders where status="Pending"');
$query->execute();
$pendingorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM orders where status="Confirm"');
$query->execute();
$confirmorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM orders where status="Rejected"');
$query->execute();
$rejectedorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM orders where status="Dispatched"');
$query->execute();
$dispatchedorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM orders where status="Canceled"');
$query->execute();
$cancelorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM orders where status="Delivered"');
$query->execute();
$deliveredorders = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM customers');
$query->execute();
$customers = $query->fetchAll();

$query = $conn->prepare('SELECT count(id) as totalcount FROM products');
$query->execute();
$products = $query->fetchAll();

// Fetch first and last order date
$query = $conn->prepare('SELECT MIN(created_at) AS first_date, MAX(created_at) AS last_date FROM orders ');
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC); // Fetch as associative array

$firstDate = $result['first_date'] ?? null;
$lastDate = $result['last_date'] ?? null;

$avg = 0; // Default value  

if ($firstDate && $lastDate) {
    // Convert to DateTime objects
    $startDate = new DateTime($firstDate);
    $endDate = new DateTime($lastDate);

    // Calculate the number of days (including first & last date)
    $interval = $startDate->diff($endDate);
    $numDays = $interval->days + 1;

    // Get total number of orders
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_orders FROM orders");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalOrders = $result['total_orders'] ?? 0;

    //total value
    $query = $conn->prepare('SELECT sum(final_price) as totalcount FROM orders Where status IN ("Delivered", "Pending", "Dispatched", "Confirm")');
    $query->execute();
    $totalval = $query->fetchAll();
    // Calculate average orders per day
    if ($numDays > 0) {
        $avg = round($totalOrders / $numDays, 2);
        $totalavg = round($totalval[0]["totalcount"] / $numDays, 2);
    }
}


?>
<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Metronic Admin Theme #4 | Admin Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #4 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
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
                        <h1>Admin Dashboard
                            <small>statistics, charts, recent events and reports</small>
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->

                </div>
                <!-- END PAGE HEAD-->

                <!-- BEGIN PAGE BASE CONTENT -->
                <!-- BEGIN DASHBOARD STATS 1-->
                <div class="page-title">
                    <h1>Orders</h1>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $totalorders[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $pendingorders[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Panding Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $confirmorders[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Confirm Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                            <div class="visual">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $dispatchedorders[0]["totalcount"];  ?>></span>
                                </div>
                                <div class="desc"> Dispatch Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                            <div class="visual">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $deliveredorders[0]["totalcount"];  ?>></span>
                                </div>
                                <div class="desc"> Delivered Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $rejectedorders[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Rejected Orders</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 yellow" href="#">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $cancelorders[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Canceled Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 yellow" href="#">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">

                                <div class="number">
                                    <span data-counter="counterup" data-value="<?php echo $avg; ?>">0</span>
                                </div>

                                <div class="desc"> Avarage Orders Per Day </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $customers[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Customers </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $products[0]["totalcount"];  ?>>0</span>
                                </div>
                                <div class="desc"> Products </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value=<?php echo $totalavg;  ?>>0</span>
                                </div>
                                <div class="desc"> Avg value Per Day </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- graph -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold">Daliy Received Amount Graph</span>
                                </div>
                                <form method="post" id="form_sample_3" class="form-horizontal">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <select class="form-control select2me" name="selected_month" id="selected_month" data-placeholder="Select Month" required>
                                                    <option value="">Select Month</option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="selected_year" value="2025" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="portlet-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="curve_chart_per_day" style="width:100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MONTHLY CHART START -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold">Received Amount Per Month</span>
                                </div>
                                <form method="post" id="form_sample_3" class="form-horizontal">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <input type="text" name="selected_year2" id="selected_year2" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="portlet-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="curve_chart" style="width:100%;display: block;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MONTHLY CHART START END -->

                <!-- MONTHLY PROFIT CHART START -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold">MONTHLY PROFIT</span>
                                </div>
                                <form method="post" id="form_sample_3" class="form-horizontal">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <input type="text" name="selected_year3" id="selected_year3" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="portlet-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="curve_chart_profit" style="width:100%;display: block;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MONTHLY PROFIT CHART START END -->

                <!-- MONTHLY PORFIT CHART START -->

                <div id="piechart" style="width: 600px; height: 400px;"></div>
                <br>

                <!-- MONTHLY PROFIT CHART END -->

                <!-- END DASHBOARD STATS 1-->
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Today's Pending Orders</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Customer Name</th>
                                            <th>Mobile No</th>
                                            <th>Invoice Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $query = $conn->prepare('SELECT customer_name, mobile, final_price FROM orders where status="Pending"');
                                        $query->execute();
                                        $pendings = $query->fetchAll();
                                        $i = 1;
                                        foreach ($pendings as $pending) {
                                            echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $pending["customer_name"] . '</td>
                                            <td>' . $pending["mobile"] . '</td>
                                            <td>' . $pending["final_price"] . '</td>
                                            </tr>';
                                            $i++;
                                        }
                                        ?>


                                    </tbody>
                                </table>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Today's Confirm Orders</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Customer Name</th>
                                            <th>Mobile No</th>
                                            <th>Invoice Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $query = $conn->prepare('SELECT customer_name, mobile, final_price FROM orders WHERE status = "Confirm" AND DATE(updated_at) = CURDATE();');
                                        $query->execute();
                                        $confirms = $query->fetchAll();
                                        $i = 1;
                                        foreach ($confirms as $confirm) {
                                            echo '<tr>
                                                    <td>' . $i . '</td>
                                                    <td>' . $confirm["customer_name"] . '</td>
                                                    <td>' . $confirm["mobile"] . '</td>
                                                    <td>' . $confirm["final_price"] . '</td>
                                                    </tr>';
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Today's Delivered Orders</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Customer Name</th>
                                            <th>Mobile No</th>
                                            <th>Invoice Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $query = $conn->prepare('SELECT customer_name, mobile, final_price FROM orders WHERE status = "Delivered" AND DATE(updated_at) = CURDATE();');
                                        $query->execute();
                                        $delivereds = $query->fetchAll();
                                        $i = 1;
                                        foreach ($delivereds as $delivered) {
                                            echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $delivered["customer_name"] . '</td>
                                            <td>' . $delivered["mobile"] . '</td>
                                            <td>' . $delivered["final_price"] . '</td>
                                            </tr>';
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Top 10 Selling Products</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product Name</th>

                                            <th>No Of Selling</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $conn->prepare('SELECT product_name, COUNT(*) AS total_products FROM order_details GROUP BY product_name ORDER BY total_products DESC LIMIT 10;');
                                        $query->execute();
                                        $topproducts = $query->fetchAll();
                                        $i = 1;
                                        foreach ($topproducts as $topproduct) {
                                            echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $topproduct["product_name"] . '</td>
                                            <td>' . $topproduct["total_products"] . '</td>
                                            </tr>';
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Top 10 Customer By Order</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>
                                            <th>Orders</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $conn->prepare('SELECT  customer_name,mobile, COUNT(customer_name) AS total_order FROM orders GROUP BY customer_name ORDER BY total_order DESC LIMIT 10;');
                                        $query->execute();
                                        $toporeders = $query->fetchAll();
                                        $i = 1;
                                        foreach ($toporeders as $toporeder) {
                                            echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $toporeder["customer_name"] . '</td>
                                            <td>' . $toporeder["mobile"] . '</td>
                                            <td>' . $toporeder["total_order"] . '</td>
                                            </tr>';
                                            $i++;
                                        }
                                        ?>

                                    </tbody>
                                </table>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Top 10 Customer By Amount</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $conn->prepare('SELECT  customer_name,mobile, SUM(final_price) AS total_amount FROM orders GROUP BY customer_name ORDER BY total_amount DESC LIMIT 10;');
                                        $query->execute();
                                        $topamounts = $query->fetchAll();
                                        $i = 1;
                                        foreach ($topamounts as $topamount) {
                                            echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $topamount["customer_name"] . '</td>
                                            <td>' . $topamount["mobile"] . '</td>
                                            <td>' . $topamount["total_amount"] . '</td>
                                            </tr>';
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->
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


    <!-- BEGIN CORE PLUGINS -->
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- //graph -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        //dashboard_chart1
        $(document).ready(function() {
            google.charts.load('current', {
                packages: ['bar']
            });

            // Function to fetch and update the chart
            function updateChart() {
                var month = $("#selected_month").val();
                var year = $("input[name='selected_year']").val();

                if (month === "") {
                    let currentMonth = new Date().getMonth() + 1;

                    // Format the month as two digits (e.g., "01" for January, "02" for February)
                    month = currentMonth < 10 ? "0" + currentMonth : currentMonth;

                    // Set the selected value in the dropdown

                }

                console.log("Fetching sssssssssssssssssssssssssssdata for:", month, year);

                $.ajax({
                    type: "POST",
                    url: "dashboard_chart1.php", // Update with your PHP file
                    data: {
                        month: month,
                        year: year
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log("Received response:", response);

                        if (response.orders && response.orders.length > 0) {
                            // Add a short delay before drawing the new chart
                            setTimeout(() => drawChartDay(response.orders), 100);
                        } else {
                            console.warn("No data available for the selected month.");

                            // Draw a default chart with 0 values for all days
                            var emptyData = [];
                            for (let i = 1; i <= 31; i++) {
                                emptyData.push({
                                    day: i,
                                    total_orders: 0
                                });
                            }

                            setTimeout(() => drawChartDay(emptyData), 100);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $("#curve_chart_per_day").html("<p>Failed to load data.</p>");
                    }
                });
            }
            // Draw Google Chart
            function drawChartDay(data) {
                var chartData = [
                    ["Day", "Total Orders"]
                ];

                // Fill missing days with 0
                for (let i = 1; i <= 31; i++) {
                    let order = data.find(d => parseInt(d.day) === i);
                    chartData.push([i, order ? parseInt(order.total_orders) : 0]);
                }

                var dataTable = google.visualization.arrayToDataTable(chartData);
                var options = {
                    legend: {
                        position: 'none'
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('curve_chart_per_day'));
                chart.draw(dataTable, google.charts.Bar.convertOptions(options));
            }
            setTimeout(updateChart(), 0);
            // Trigger chart update when month or year changes
            $("#selected_month, input[name='selected_year']").on("change", updateChart);
            $("#selected_month, input[name='selected_year']").on("keyup", updateChart);
        });

        //dashboard_chart2
        $(document).ready(function() {
            google.charts.load('current', {
                packages: ['bar']
            });

            function secondchart() {
                var year = $("input[name='selected_year2']").val().trim(); // Get selected year

                console.log("Selected Year:", year);

                // Ensure the year is a valid four-digit number
                if (year.length === 4 && !isNaN(year)) {
                    $.ajax({
                        type: "POST",
                        url: "dashboard_chart2.php", // Ensure this file returns correct JSON
                        data: {
                            year: year
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log("Received response:", response);

                            if (response.months && response.months.length > 0) {
                                setTimeout(() => drawChart(response.months), 100);
                            } else {
                                console.warn("No data available for this year.");

                                // Draw an empty chart with 0 values
                                var emptyData = Array.from({
                                    length: 12
                                }, (_, i) => ({
                                    month: i + 1,
                                    total_amount: 0
                                }));

                                setTimeout(() => drawChart(emptyData), 100);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                        }
                    });
                }
            }

            function drawChart(data) {
                var chartData = [
                    ["Month", "Total Received Amount"]
                ];

                // Fill missing months with 0
                for (let i = 1; i <= 12; i++) {
                    let record = data.find(d => parseInt(d.month) === i);
                    chartData.push([getMonthName(i), record ? parseFloat(record.total_amount) : 0]);
                }

                var dataTable = google.visualization.arrayToDataTable(chartData);
                var options = {
                    legend: {
                        position: 'none'
                    },
                    chart: {
                        title: "Monthly Received Amount"
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('curve_chart'));
                chart.draw(dataTable, google.charts.Bar.convertOptions(options));
            }

            function getMonthName(month) {
                const months = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                return months[month - 1];
            }

            // Set the current year and call secondchart
            let currentYear = new Date().getFullYear();
            $("input[name='selected_year2']").val(currentYear);

            // Call secondchart after setting the year
            setTimeout(secondchart, 0);

            // Trigger chart update when year input changes
            $("input[name='selected_year2']").on("input", secondchart);
        });

        //dashboard_chart3
        $(document).ready(function() {
            google.charts.load('current', {
                packages: ['bar']
            });

            function thirdchart() {
                var year = $("input[name='selected_year3']").val().trim(); // Get selected year

                console.log("Selected Year:", year);

                // Ensure the year is a valid four-digit number
                if (year.length === 4 && !isNaN(year)) {
                    $.ajax({
                        type: "POST",
                        url: "dashboard_chart3.php", // Ensure this file returns correct JSON
                        data: {
                            year: year
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log("Received response:", response);

                            if (response.months && response.months.length > 0) {
                                setTimeout(() => drawChart(response.months), 100);
                            } else {
                                console.warn("No data available for this year.");

                                // Draw an empty chart with 0 values
                                var emptyData = Array.from({
                                    length: 12
                                }, (_, i) => ({
                                    month: i + 1,
                                    balance: 0
                                }));

                                setTimeout(() => drawChart(emptyData), 100);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                        }
                    });
                }
            }

            function drawChart(data) {
                var chartData = [
                    ["Month", "Total Received Amount"]
                ];

                // Fill missing months with 0
                for (let i = 1; i <= 12; i++) {
                    let record = data.find(d => parseInt(d.month) === i);
                    chartData.push([getMonthName(i), record ? parseFloat(record.balance) : 0]);
                }

                var dataTable = google.visualization.arrayToDataTable(chartData);
                var options = {
                    legend: {
                        position: 'none'
                    },
                    chart: {
                        title: "Total Monthly Profit"
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('curve_chart_profit'));
                chart.draw(dataTable, google.charts.Bar.convertOptions(options));
            }

            function getMonthName(month) {
                const months = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                return months[month - 1];
            }

            // Set the current year and call thirdchart
            let currentYear = new Date().getFullYear();
            $("input[name='selected_year3']").val(currentYear);

            // Call thirdchart after setting the year
            setTimeout(thirdchart, 0);

            // Trigger chart update when year input changes
            $("input[name='selected_year3']").on("input", thirdchart);
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the current month (1-based) and year
            let currentMonth = new Date().getMonth() + 1;
            let currentYear = new Date().getFullYear();

            // Format the month as two digits (e.g., "01" for January, "02" for February)
            let formattedMonth = currentMonth < 10 ? "0" + currentMonth : currentMonth;

            // Set the selected values in the dropdowns
            document.getElementById("selected_month").value = formattedMonth;
            document.querySelector("input[name='selected_year2']").value = currentYear;

            // Call updateChart after setting the values
        });
    </script>

    <!-- pie chart  -->
    <?php
    $query = $conn->prepare("SELECT transaction_type, SUM(amount) AS total_price
                            FROM expense
                            GROUP BY transaction_type
                            ORDER BY total_price DESC; -- (Optional) Sort in descending order
                            ");
    $query->execute();
    $expensevalue = $query->fetchAll();
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load Google Charts
        google.charts.load('current', {
            packages: ['corechart']
        });

        // Draw the Pie Chart when the page loads
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Category', 'Value'],
                <?php
                $chartData = []; // Create an array to store data rows
                foreach ($expensevalue as $exv) {
                    $chartData[] = '["' . $exv["transaction_type"] . '", ' . number_format($exv["total_price"], 1, '.', '') . ']';
                }
                echo implode(",", $chartData); // Join array elements to avoid trailing comma
                ?>
            ]);

            // Chart Options
            var options = {
                title: 'Expense Distribution',
                is3D: true,
                pieSliceText: 'value',
                pieSliceTextStyle: {
                    fontSize: 12,
                    bold: true
                },
            };

            // Draw the Chart in the 'piechart' div
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>



    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>