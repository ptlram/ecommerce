<?php
include "../connection.php"; // Include database connection

if (isset($_GET['id'])) {
    $coupon_id = $_GET['id'];

    // Fetch existing coupon details
    $query = $conn->prepare("SELECT * FROM coupons WHERE id = :id");
    $query->execute([':id' => $coupon_id]);
    $coupon = $query->fetch(PDO::FETCH_ASSOC);

    if (!$coupon) {
        echo "<script>alert('Coupon not found!'); window.location.href='coupon_codelist.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='coupon_codelist.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
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
    <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
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
                        <h1>Update Category Details
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
                                <!-- HTML Form for Updating Brand -->
                                <form action="coupon_code_update.php?id=<?php echo $coupon_id; ?>" method="POST" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="Title">Title</label>
                                            <input class="form-control" type="text" name="Title" value="<?php echo $coupon['title']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Type</label><br>
                                            <label><input type="radio" name="Type" value="Fixed Amount" <?php echo ($coupon['type'] == 'Fixed Amount') ? 'checked' : ''; ?> required> Fixed Amount</label><br>
                                            <label><input type="radio" name="Type" value="Percentage" <?php echo ($coupon['type'] == 'Percentage') ? 'checked' : ''; ?>> Percentage(%)</label><br>
                                        </div>

                                        <div class="form-group">
                                            <label for="couponvalue">Coupon Value</label>
                                            <input class="form-control" type="text" name="couponvalue" value="<?php echo $coupon['coupon_value']; ?>" required>
                                        </div>

                                        <label class="control-label col-md-3">Date Range</label>
                                        <div class="col-md-4">
                                            <div class="input-group input-large date-picker input-daterange" data-date-format="mm/dd/yyyy">
                                                <input type="date" class="form-control" name="from" value="<?php echo $coupon['date_from']; ?>" required>
                                                <span class="input-group-addon"> to </span>
                                                <input type="date" class="form-control" name="to" value="<?php echo $coupon['date_to']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="MinimumBillAmount">Minimum Bill Amount</label>
                                            <input class="form-control" type="text" name="MinimumBillAmount" value="<?php echo $coupon['min_bill_amount']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="MaximumDiscount">Maximum Discount</label>
                                            <input class="form-control" type="text" name="MaximumDiscount" value="<?php echo $coupon['max_discount']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">Select category</option>
                                                <?php
                                                $query = $conn->prepare("SELECT * FROM category");
                                                $query->execute();
                                                $categories = $query->fetchAll();
                                                foreach ($categories as $cat) {
                                                    $selected = ($coupon['category_id'] == $cat['id']) ? "selected" : "";
                                                    echo '<option value="' . $cat["id"] . '" ' . $selected . '>' . $cat["name"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="NumberOfCoupon">Number of Coupons</label>
                                            <input type="number" class="form-control" name="NumberOfCoupon" value="<?php echo $coupon['number_of_coupons']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Coupon Type</label><br>
                                            <label><input type="radio" name="CouponType" value="SecretCoupon" <?php echo ($coupon['coupon_type'] == 'SecretCoupon') ? 'checked' : ''; ?> required> Secret Coupon</label><br>
                                            <label><input type="radio" name="CouponType" value="GeneralCoupon" <?php echo ($coupon['coupon_type'] == 'GeneralCoupon') ? 'checked' : ''; ?>> General Coupon</label><br>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label><br>
                                            <label><input type="radio" name="Status" value="Active" <?php echo ($coupon['status'] == 'Active') ? 'checked' : ''; ?> required> Active</label><br>
                                            <label><input type="radio" name="Status" value="Deactivate" <?php echo ($coupon['status'] == 'Deactivate') ? 'checked' : ''; ?>> Deactivate</label><br>
                                        </div>

                                        <div class="form-group last">
                                            <label class="control-label col-md-3" style="padding-left: 0;">Coupon Details</label>
                                            <div class="col-md-9">
                                                <textarea class="ckeditor form-control" name="CouponDetails" rows="6"><?php echo $coupon['coupon_details']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" name="update" class="btn blue">Update Coupon</button>
                                        <button type="button" class="btn default" onclick="window.location.href='coupon_codelist.php'">Cancel</button>
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
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    try {
        $title = $_POST['Title'];
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

        // Update database
        $query = $conn->prepare("UPDATE coupons SET 
            title = :title, 
            type = :type, 
            coupon_value = :coupon_value, 
            date_from = :date_from, 
            date_to = :date_to, 
            min_bill_amount = :min_bill_amount, 
            max_discount = :max_discount, 
            category_id = :category_id, 
            number_of_coupons = :number_of_coupons, 
            coupon_type = :coupon_type, 
            status = :status, 
            coupon_details = :coupon_details 
            WHERE id = :id");

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
            ':coupon_details' => $coupon_details,
            ':id' => $coupon_id
        ]);

        echo "<script>alert('Coupon updated successfully!'); window.location.href='coupon_codelist.php';</script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>