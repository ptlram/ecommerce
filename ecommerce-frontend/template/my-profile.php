<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>Groci - Organic Food & Grocery Market Template</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Select2 CSS -->
    <link href="vendor/select2/css/select2-bootstrap.css" />
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/osahan.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
</head>

<body>
    <?php
    include "./header.php";
    ?>
    <section class="account-page section-padding">
        <?php

        include "./connection.php"; // Ensure PDO connection is set up

        // Check if session email is set
        if (isset($_SESSION['email'])) {
            $logedemail = $_SESSION['email'];

            // Secure query using prepared statements
            $query = $conn->prepare("SELECT * FROM customers WHERE email = '$logedemail' OR mobile_number = '$logedemail' ");
            $query->execute();

            // Fetch the user data
            $userdata = $query->fetchAll();
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="card account-left">
                                <div class="user-profile-header">
                                    <img alt="logo" src="img/user.jpg">
                                    <h5 class="mb-1 text-secondary"><strong>Hi </strong><?php echo $userdata[0]['name'] ?? null; ?></h5>
                                    <p> <?= $userdata[0]['mobile_number'] ?? '+91 000 000 0000' ?></p>
                                </div>
                                <div class="list-group">
                                    <a href="my-profile.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile</a>
                                    <a href="my-address.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address</a>
                                    <a href="orderlist.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List</a>
                                    <a href="logout.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i> Logout</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-body account-right">
                                <div class="widget">
                                    <div class="section-header">
                                        <h5 class="heading-design-h5">
                                            My Profile
                                        </h5>
                                    </div>



                                    <form method="POST" action="">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label"> Name <span class="required">*</span></label>
                                                    <input class="form-control border-form-control" name="name" value="<?= $userdata[0]['name'] ?? '' ?>" placeholder="Enter your name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label"> Referral Code <span class="required">*</span></label>
                                                    <input class="form-control border-form-control" name="referral_code" value="<?= $userdata[0]['ReferralCode'] ?? '' ?>" placeholder="Enter referral code" disabled type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <?php

                                        $email = $_SESSION['email'] ?? ''; // Get session email
                                        $is_numeric_email = is_numeric($email); // Check if email is numeric
                                        ?>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone <span class="required">*</span></label>
                                                    <input class="form-control border-form-control" name="mobile_number"
                                                        value="<?= $userdata[0]['mobile_number'] ?? '' ?>"
                                                        placeholder="Enter phone number" type="number"
                                                        <?= $is_numeric_email ? 'disabled' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email Address <span class="required">*</span></label>
                                                    <input class="form-control border-form-control" name="email"
                                                        value="<?= $userdata[0]['email'] ?? '' ?>" type="email"
                                                        <?= !$is_numeric_email ? 'disabled' : '' ?>>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">State <span class="required">*</span></label>
                                                    <select class="form-control border-form-control" name="state" id="stateDropdown" required>
                                                        <option value="">Select State</option>
                                                        <?php
                                                        $q = $conn->prepare("SELECT * FROM states");
                                                        $q->execute();
                                                        $states = $q->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($states as $state): ?>
                                                            <option value="<?= htmlspecialchars($state['id']) ?>"
                                                                <?= ($userdata[0]['state'] ?? '') == $state['id'] ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($state['state_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">City <span class="required">*</span></label>
                                                    <select class="form-control border-form-control" name="city" id="cityDropdown" required>
                                                        <option value="">Select City</option>
                                                        <?php
                                                        $q = $conn->prepare("SELECT * FROM cities");
                                                        $q->execute();
                                                        $citiess = $q->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($citiess as $city): ?>
                                                            <option value="<?= htmlspecialchars($city['id']) ?>"
                                                                <?= ($userdata[0]['city'] ?? '') == $city['id'] ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($city['city_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                        <!-- Cities will be loaded dynamically via AJAX -->
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Pin Code <span class="required">*</span></label>
                                                    <input class="form-control border-form-control" name="pincode" value="<?= $userdata[0]['pincode'] ?? '' ?>" placeholder="Enter Pin Code" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">GST Number <span class="required">*</span></label>
                                                    <input class="form-control border-form-control" name="gst_number" value="<?= $userdata[0]['gst_number'] ?? '' ?>" placeholder="Enter GST number" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">Address <span class="required">*</span></label>
                                                    <textarea class="form-control border-form-control" name="address"><?= $userdata[0]['address'] ?? '' ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="button" class="btn btn-danger btn-lg" onclick="window.location.href='./index.php'">Cancel</button>
                                                <button type="submit" name="save_changes" class="btn btn-success btn-lg">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "./footer.php" ?>
    <div class="cart-sidebar">
        <div class="cart-sidebar-header">
            <h5>
                My Cart <span class="text-success">(5 item)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
                </a>
            </h5>
        </div>
        <div class="cart-sidebar-body">
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/11.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/7.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/9.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/1.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
            <div class="cart-list-product">
                <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                <img class="img-fluid" src="img/item/2.jpg" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#">Product Title Here</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
            </div>
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-store-details">
                <p>Sub Total <strong class="float-right">$900.69</strong></p>
                <p>Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p>
                <h6>Your total savings <strong class="float-right text-danger">$55 (42.31%)</strong></h6>
            </div>
            <a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>$1200.69</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- select2 Js -->
    <script src="vendor/select2/js/select2.min.js"></script>
    <!-- Owl Carousel -->
    <script src="vendor/owl-carousel/owl.carousel.js"></script>
    <!-- Custom -->
    <script src="js/custom.js"></script>

    <script>
        $(document).ready(function() {
            $('#stateDropdown').change(function() {
                var stateId = $(this).val();

                if (stateId) {
                    $.ajax({
                        url: '', // PHP file to fetch cities
                        type: 'POST',
                        data: {
                            state_id: stateId
                        },
                        success: function(response) {
                            $('#cityDropdown').html(response);
                        }
                    });
                } else {
                    $('#cityDropdown').html('<option value="">Select City</option>');
                }
            });
        });
    </script>


</body>

</html>

<?php
include "./connection.php"; // Ensure database connection

if (isset($_POST['state_id'])) {
    $state_id = $_POST['state_id'];

    $query = $conn->prepare("SELECT * FROM cities WHERE state_id = :state_id");
    $query->bindParam(':state_id', $state_id, PDO::PARAM_INT);
    $query->execute();
    $cities = $query->fetchAll(PDO::FETCH_ASSOC);

    echo '<option value="">Select City</option>';
    foreach ($cities as $city) {
        echo '<option value="' . htmlspecialchars($city['id']) . '">' . htmlspecialchars($city['city_name']) . '</option>';
    }
}
?>

<?php
include "./connection.php"; // Ensure this contains your PDO connection
session_start(); // Ensure session is started

if (isset($_POST["save_changes"])) {
    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo "<script>alert('You are not logged in. Please log in first.'); window.location.href='./index.php';</script>";
        exit;
    }

    $session_email = $_SESSION['email'];
    $is_numeric_email = is_numeric($session_email); // Check if session email is numeric

    // Collect form data and sanitize input
    $name = trim($_POST["name"]);
    $state = trim($_POST["state"]);
    $city = trim($_POST["city"]);
    $gst_number = trim($_POST["gst_number"]);
    $address = trim($_POST["address"]);
    $pincode = trim($_POST["pincode"]);

    try {
        if ($is_numeric_email) {
            $email = trim($_POST["email"]);

            // Check if email already exists for another user
            $check_query = $conn->prepare("SELECT * FROM customers WHERE email = ? AND mobile_number != ?");
            $check_query->execute([$email, $session_email]);

            if ($check_query->rowCount() > 0) {
                echo "<script>alert('Email already exists. Please use a different one.'); window.location.href='./my-profile.php';</script>";
                exit;
            }

            // Correct SQL update query
            $query = $conn->prepare("UPDATE customers SET name = ?, state = ?, city = ?, gst_number = ?, address = ?, pincode = ?, email = ? WHERE mobile_number = ?");
            $query->execute([$name, $state, $city, $gst_number, $address, $pincode, $email, $session_email]);
        } else {
            $mobile_number = trim($_POST["mobile_number"]);

            // Check if mobile number already exists for another user
            $check_query = $conn->prepare("SELECT * FROM customers WHERE mobile_number = ? AND email != ?");
            $check_query->execute([$mobile_number, $session_email]);

            if ($check_query->rowCount() > 0) {
                echo "<script>alert('Mobile number already exists. Please use a different one.'); window.location.href='./my-profile.php';</script>";
                exit;
            }

            // Correct SQL update query
            $query = $conn->prepare("UPDATE customers SET name = ?, mobile_number = ?, state = ?, city = ?, gst_number = ?, address = ?, pincode = ? WHERE email = ?");
            $query->execute([$name, $mobile_number, $state, $city, $gst_number, $address, $pincode, $session_email]);
        }

        echo "<script>alert('Profile updated successfully!'); window.location.href='./my-profile.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='./my-profile.php';</script>";
    }
}
?>