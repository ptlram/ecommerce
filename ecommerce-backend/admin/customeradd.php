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
                        <h1>Add Customer
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
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="catagory_name">Name</label>
                                        <input class="form-control" type="text" name="catagory_name" placeholder="Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Mobilenumber">Mobile Number</label>
                                        <input class="form-control" type="tel" name="Mobilenumber" id="Mobilenumber"
                                            placeholder="Mobile Number" required>
                                        <small id="error-msg" style="color: red; display: none;">Please enter a valid 10-digit number</small>
                                    </div>


                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>


                                    <div class="form-group">
                                        <label for="state" class="control-label col-md-3" style="padding-left: 0;">Select State</label>
                                        <div class="col-md-9.5">
                                            <select class="bs-select form-control" data-live-search="true" name="state" id="state" data-size="8">
                                                <option value="">Select state</option>
                                                <?php
                                                include "../connection.php";
                                                $query = $conn->prepare("select * from states");
                                                $query->execute();
                                                $brand = $query->fetchAll();
                                                foreach ($brand as $bd) {
                                                    echo ' <option value="' . $bd["id"] . '">' . $bd["state_name"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select class="form-control" id="city" name="city" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        <textarea class="form-control" name="Address" placeholder="Address"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="GST_Number">GST Number</label>
                                        <input class="form-control" type="text" name="GST_Number" placeholder="GST Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="Points">Points</label>
                                        <input class="form-control" type="number" name="Points" placeholder="Points">
                                    </div>

                                    <div class="form-group">
                                        <label>Customer Type</label><br>
                                        <label><input type="radio" name="customertype" value="retailer" required> Retailer</label>
                                        <label><input type="radio" name="customertype" value="wholesaler"> Wholesaler</label>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success">Add Customer</button>
                                    <button class="btn btn-success"><a href="customerlist.php" style="text-decoration: none;color:white">Cancel</a></button>
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
        document.getElementById("Mobilenumber").addEventListener("input", function() {
            let mobileInput = this.value;
            let errorMsg = document.getElementById("error-msg");

            if (!/^\d{10}$/.test(mobileInput)) {
                errorMsg.style.display = "block";
            } else {
                errorMsg.style.display = "none";
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Fetch Cities based on Selected State
            $("#state").change(function() {
                var stateId = $(this).val();
                $("#city").html("<option value=''>Select City</option>"); // Reset city dropdown

                if (stateId) {
                    $.ajax({
                        url: "../pages/fetch_cities.php",
                        method: "POST",
                        data: {
                            state_id: stateId
                        },
                        dataType: "json",
                        success: function(data) {
                            $.each(data, function(index, city) {
                                $("#city").append("<option value='" + city.id + "'>" + city.city_name + "</option>");
                            });
                        }
                    });
                }
            });
        });
    </script>
    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>

<?php
include "../pages/db.php"; // Include database connection

if (isset($_POST['submit'])) {
    $name = $_POST['catagory_name'];
    $mobile_number = $_POST['Mobilenumber'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['Address'];
    $gst_number = $_POST['GST_Number'];
    $points = $_POST['Points'];
    $customer_type = $_POST['customertype'];

    function generateAlphanumericCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $maxIndex)];
        }

        return $code;
    }

    // Check if the mobile number already exists
    $checkQuery = $pdo->prepare("SELECT COUNT(*) FROM customers WHERE mobile_number = ?");
    $checkQuery->execute([$mobile_number]);
    $count = $checkQuery->fetchColumn();

    if ($count > 0) {
        echo "<script>alert('Mobile number already exists!'); </script>";
        exit();
    }

    $checkQueryeid = $pdo->prepare("SELECT COUNT(*) FROM customers WHERE email = ?");
    $checkQueryeid->execute([$email]);
    $counteid = $checkQueryeid->fetchColumn();

    if ($counteid > 0) {
        echo "<script>alert('Email Id already exists!');</script>";
        exit();
    }
    // Generate a unique referral code
    $rcode = generateAlphanumericCode();

    // Insert data into the database
    $query = $pdo->prepare("INSERT INTO customers (name, mobile_number, email, state, city, address, gst_number, points, customer_type, otp, isverify, ReferralCode) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $query->execute([$name, $mobile_number, $email, $state, $city, $address, $gst_number, $points, $customer_type, 123321, "no", $rcode]);

    if ($result) {
        echo "<script>alert('Customer added successfully!'); window.location.href='customerlist.php';</script>";
    } else {
        echo "<script>alert('Failed to add customer.');</script>";
    }
}
?>