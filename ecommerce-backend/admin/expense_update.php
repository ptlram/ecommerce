<?php
include '../connection.php'; // Database connection

// Get expense ID from URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch expense data
    $stmt = $conn->prepare("SELECT * FROM expense WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $expense = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$expense) {
        die("Expense not found!");
    }
}

// Handle form submission for updating
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["invoice_Amount"];
    $date = $_POST["date"];
    $remark = $_POST["invoice_Remark"];
    $transactionType = $_POST["invoice_Transaction_Types"];

    // Update query
    $stmt = $conn->prepare("UPDATE expense SET amount = :amount, date = :date, remark = :remark, transaction_type = :transactionType WHERE id = :id");
    $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':remark', $remark, PDO::PARAM_STR);
    $stmt->bindParam(':transactionType', $transactionType, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Expense updated successfully!'); window.location.href='expense.php';</script>";
    } else {
        echo "Error updating expense.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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
    <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php
    include "./header.php";
    ?>
    <!-- END HEADER -->
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
                        <h1>Update expense Details
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <!-- HTML Form for Updating Expense -->
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input class="form-control" type="text" name="invoice_Amount" value="<?= htmlspecialchars($expense['amount']); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                        <select class="form-control" name="invoice_Transaction_Types" required>
                                            <option value="Salary" <?= $expense['transaction_type'] == 'Salary' ? 'selected' : '' ?>>Salary</option>
                                            <option value="Fuel" <?= $expense['transaction_type'] == 'Fuel' ? 'selected' : '' ?>>Fuel</option>
                                            <option value="Commission" <?= $expense['transaction_type'] == 'Commission' ? 'selected' : '' ?>>Commission</option>
                                            <option value="Vehicle Maintenance" <?= $expense['transaction_type'] == 'Vehicle Maintenance' ? 'selected' : '' ?>>Vehicle Maintenance</option>
                                            <option value="Stationery" <?= $expense['transaction_type'] == 'Stationery' ? 'selected' : '' ?>>Stationery</option>
                                            <option value="Purchase" <?= $expense['transaction_type'] == 'Purchase' ? 'selected' : '' ?>>Purchase</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control" type="date" name="date" value="<?= $expense['date']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea class="form-control" name="invoice_Remark"><?= htmlspecialchars($expense['remark']); ?></textarea>
                                    </div>

                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                    <a href="expense_list.php" class="btn btn-secondary">Cancel</a>
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
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
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
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>