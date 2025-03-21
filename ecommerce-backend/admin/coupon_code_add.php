<!DOCTYPE html>
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
                        <h1>Add New Coupon Code
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-6 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="Title"> Title</label>
                                            <input class="form-control" type="text" name="Title" placeholder="Enter Title" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Type</label><br>
                                            <label><input type="radio" name="Type" value="Fixed Amount" required> Fixed Amount</label><br>
                                            <label><input type="radio" name="Type" value="Percentage"> Percentage(%)</label><br>
                                        </div>

                                        <div class="form-group">
                                            <label for="couponvalue"> Coupon Value</label>
                                            <input class="form-control" type="text" name="couponvalue" placeholder="Coupon Value" required>
                                        </div>

                                        <label class="control-label col-md-3">Date Range</label>
                                        <div class="col-md-4">
                                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="date" class="form-control" name="from">
                                                <span class="input-group-addon"> to </span>
                                                <input type="date" class="form-control" name="to">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="MinimumBillAmount"> Minimum Bill Amount</label>
                                            <input class="form-control" type="text" name="MinimumBillAmount" placeholder="Minimum Bill Amount">
                                        </div>

                                        <div class="form-group">
                                            <label for="MaximumDiscount"> Maximum Discount</label>
                                            <input class="form-control" type="text" name="MaximumDiscount" placeholder="Maximum Discount">
                                        </div>

                                        <div class="form-group">
                                            <label for="category">category</label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">Select category</option>
                                                <?php
                                                include "../connection.php";
                                                $query = $conn->prepare("select * from category");
                                                $query->execute();
                                                $category = $query->fetchAll();
                                                foreach ($category as $bd) {
                                                    echo ' <option value="' . $bd["id"] . '">' . $bd["name"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="NumberOfCoupon">Number Of Coupon</label>
                                            <input type="number" class="form-control" name="NumberOfCoupon" value="0" required></input>
                                        </div>

                                        <div class="form-group">
                                            <label>Coupon Type</label><br>
                                            <label><input type="radio" name="CouponType" value="SecretCoupon" required> Secret Coupon</label><br>
                                            <label><input type="radio" name="CouponType" value="GeneralCoupon"> General Coupon</label><br>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label><br>
                                            <label><input type="radio" name="Status" value="Active" required> Active</label><br>
                                            <label><input type="radio" name="Status" value="Deactivate"> Deactivate</label><br>
                                        </div>

                                        <div class="form-group last">
                                            <label class="control-label col-md-3" style="padding-left: 0;line-break: strict;">Coupon Details</label>
                                            <div class="col-md-9">
                                                <textarea class="ckeditor form-control" name="CouponDetails" rows="6"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" name="submit" class="btn blue">Add Coupon</button>
                                        <button class="btn btn-success"><a href="coupon_codelist.php" style="text-decoration: none;color:white">Cancel</a></button>

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
    <script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
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
    <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

</body>

</html>
<?php
include "../connection.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    try {
        // Collect and sanitize form data
        $title = htmlspecialchars($_POST['Title']);
        $type = $_POST['Type'];
        $coupon_value = $_POST['couponvalue'];
        $date_from = $_POST['from'];
        $date_to = $_POST['to'];
        $min_bill_amount = !empty($_POST['MinimumBillAmount']) ? $_POST['MinimumBillAmount'] : NULL;
        $max_discount = !empty($_POST['MaximumDiscount']) ? $_POST['MaximumDiscount'] : NULL;
        $category_id = $_POST['category'];
        $number_of_coupons = $_POST['NumberOfCoupon'];
        $coupon_type = $_POST['CouponType'];
        $status = $_POST['Status'];
        $coupon_details = $_POST['CouponDetails'];

        // Insert into database
        $query = $conn->prepare("INSERT INTO coupons 
            (title, type, coupon_value, date_from, date_to, min_bill_amount, max_discount, category_id, number_of_coupons, 
            coupon_type, status, coupon_details) 
            VALUES 
            (:title, :type, :coupon_value, :date_from, :date_to, :min_bill_amount, :max_discount, :category_id, 
            :number_of_coupons, :coupon_type, :status, :coupon_details)");

        $query->execute([
            ':title' => $title,
            ':type' => $type,
            ':coupon_value' => $coupon_value,
            ':date_from' => $date_from,
            ':date_to' => $date_to,
            ':min_bill_amount' => $min_bill_amount,
            ':max_discount' => $max_discount,
            ':category_id' => $category_id,
            ':number_of_coupons' => $number_of_coupons,
            ':coupon_type' => $coupon_type,
            ':status' => $status,
            ':coupon_details' => $coupon_details
        ]);

        echo "<script>alert('Coupon added successfully!'); window.location.href='coupon_codelist.php';</script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>