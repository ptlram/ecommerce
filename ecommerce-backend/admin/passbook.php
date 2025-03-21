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
        <?php
        include "../connection.php";

        // Default values
        $from = isset($_POST['from']) ? $_POST['from'] : '';
        $to = isset($_POST['to']) ? $_POST['to'] : '';

        // Convert date format from dd-mm-yyyy to yyyy-mm-dd (MySQL format)
        if (!empty($from) && !empty($to)) {
            $from = date("Y-m-d", strtotime($from));
            $to = date("Y-m-d", strtotime($to));

            // Query to fetch filtered transactions
            $query = $conn->prepare("SELECT id, remark, date, credit, debit FROM transaction WHERE date BETWEEN :from AND :to ORDER BY id DESC");
            $query->bindParam(':from', $from);
            $query->bindParam(':to', $to);

            // Query to calculate total credit and debit for the selected date range
            $totalQuery = $conn->prepare("SELECT SUM(credit) as total_credit, SUM(debit) as total_debit FROM transaction WHERE date BETWEEN :from AND :to");
            $totalQuery->bindParam(':from', $from);
            $totalQuery->bindParam(':to', $to);
        } else {
            // Default query to show all transactions if no date filter is applied
            $query = $conn->prepare("SELECT id, remark, date, credit, debit FROM transaction ORDER BY id ASC");
            // Query to calculate total credit and debit for the selected date range
            $totalQuery = $conn->prepare("SELECT SUM(credit) as total_credit, SUM(debit) as total_debit FROM transaction");
        }

        $query->execute();
        $transactions = $query->fetchAll(PDO::FETCH_ASSOC);


        $totalQuery->execute();
        $total = $totalQuery->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="m-heading-1 border-green-seagreen m-bordered">
                    <form method="post" id="form_sample_3" class="form-horizontal" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Select Date<span class="required"> * </span></label>
                                    <div class="col-md-9">
                                        <div class="input-group date-picker input-daterange">
                                            <input type="text" class="form-control" name="from" id="from" value="<?= isset($_POST['from']) ? $_POST['from'] : ''; ?>" placeholder="From" autocomplete="off">
                                            <span class="input-group-addon"> to </span>
                                            <input type="text" class="form-control" name="to" id="to" value="<?= isset($_POST['to']) ? $_POST['to'] : ''; ?>" placeholder="To" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <button type="submit" name="btn_search" class="btn green-seagreen">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">PASSBOOK</div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Remark</th>
                                            <th>Date</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($transactions as $transaction) {
                                            echo '<tr>
                                            <td>' . htmlspecialchars($transaction["id"]) . '</td>
                                            <td>' . htmlspecialchars($transaction["remark"]) . '</td>
                                            <td>' . htmlspecialchars($transaction["date"]) . '</td>
                                            <td>' . htmlspecialchars($transaction["credit"]) . '</td>
                                            <td>' . htmlspecialchars($transaction["debit"]) . '</td>
                                        </tr>';
                                        }

                                        // Display total row
                                        echo '<tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b>' . ($total["total_credit"] ?? 0) . '</b></td>
                                        <td><b>' . ($total["total_debit"] ?? 0) . '</b></td>
                                    </tr>';
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