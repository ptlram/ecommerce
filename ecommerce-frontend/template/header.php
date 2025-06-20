<?php
include "../../ecommerce-backend/session_expire.php";
?>
<div class="modal fade login-modal-main" id="bd-example-modal">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="login-modal">
                    <div class="row">

                        <div class="col-lg-12 pad-right-0">
                            <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                                <span class="sr-only">Close</span>
                            </button>

                            <div class="login-modal-right">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="login" role="tabpanel">
                                        <h5 class="heading-design-h5">Login to your account</h5>
                                        <form id="login-form" method="post">
                                            <fieldset class="form-group">
                                                <label>Enter Email ID</label>
                                                <input type="text" name="email" class="form-control" placeholder="enter your email Id" required>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Enter Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="********" required>
                                            </fieldset>
                                            <!-- OTP Field (hidden by default) -->
                                            <fieldset class="form-group" id="otp-field" style="display:none;">
                                                <label>Enter OTP</label>
                                                <input type="text" name="otp" class="form-control" maxlength="6" placeholder="Enter 6-digit OTP">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <button id="login-button" type="submit" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                            </fieldset>
                                        </form>
                                        <div id="login-error" style="color:red;"></div>
                                    </div>
                                    <div class="tab-pane" id="register" role="tabpanel">
                                        <h5 class="heading-design-h5">Register Now!</h5>
                                        <form id="register-form" method="post">
                                            <fieldset class="form-group">
                                                <label for="emailOrMobile">Enter Email ID</label>
                                                <input type="text" class="form-control" id="emailOrMobile" name="emailOrMobile" placeholder="enter your email Id" required>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="password">Enter Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="confirmPassword">Enter Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="********" required>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label for="refferal_code">Refferal Code (optional)</label>
                                                <input type="text" class="form-control" id="refferal_code" name="refferal_code" placeholder="Enter Refferal Code">
                                            </fieldset>
                                            <!-- OTP Field (hidden by default) -->
                                            <fieldset class="form-group" id="register-otp-field" style="display:none;">
                                                <label>Enter OTP</label>
                                                <input type="text" name="otp" class="form-control" maxlength="6" placeholder="Enter 6-digit OTP" inputmode="numeric" autocomplete="one-time-code">
                                            </fieldset>
                                            <fieldset class="form-group mt-3">
                                                <button id="register-button" type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                            </fieldset>
                                        </form>
                                        <div id="register-error" style="color:red;"></div>

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center login-footer-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="mdi mdi-lock"></i> LOGIN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="mdi mdi-pencil"></i> REGISTER</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <script>
                                // Registration Form Submission
                                document.getElementById("register-form").addEventListener("submit", function(e) {
                                    e.preventDefault();

                                    const form = e.target;
                                    const emailOrMobile = form.emailOrMobile.value.trim();
                                    const password = form.password.value;
                                    const confirmPassword = form.confirmPassword.value;
                                    const referralCode = form.refferal_code?.value || "";
                                    const otpField = document.getElementById("register-otp-field");
                                    const otpInput = form.otp; // Ensure this matches the name attribute in your HTML
                                    const otp = otpInput?.value || "";
                                    const errorBox = document.getElementById("register-error");
                                    const registerButton = document.getElementById("register-button");
                                    if (otpField.style.display === "block") {
                                        // OTP verification step
                                        fetch("./registerverify.php", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded"
                                                },
                                                body: `otp=${encodeURIComponent(otp)}`
                                            })
                                            .then(res => res.json()) // Handling response as JSON
                                            .then(result => {
                                                if (result.success) {
                                                    window.location.href = result.redirect; // Redirect to the appropriate page
                                                } else {
                                                    errorBox.textContent = result.message || "Invalid OTP. Please try again.";
                                                }
                                            })
                                            .catch(err => {
                                                errorBox.textContent = "An error occurred while verifying OTP.";
                                            });
                                    } else {
                                        // Initial registration step - send data and get OTP
                                        fetch("./register.php", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded"
                                                },
                                                body: `emailOrMobile=${encodeURIComponent(emailOrMobile)}&password=${encodeURIComponent(password)}&confirmPassword=${encodeURIComponent(confirmPassword)}&refferal_code=${encodeURIComponent(referralCode)}&ajax=1`
                                            })
                                            .then(res => res.json()) // Handling response as JSON
                                            .then(result => {
                                                if (result.otpSent) {
                                                    otpField.style.display = "block"; // Show OTP field
                                                    registerButton.textContent = "Verifying...";
                                                    errorBox.textContent = "OTP sent to your email.";

                                                    otpInput?.addEventListener("input", () => {
                                                        if (otpInput.value.length === 6) {
                                                            form.dispatchEvent(new Event("submit"));
                                                        }
                                                    });
                                                } else {
                                                    errorBox.textContent = result.message || "Failed to send OTP. Please try again.";
                                                }
                                            })
                                            .catch(err => {
                                                errorBox.textContent = "An error occurred while sending OTP.";
                                            });
                                    }
                                });



                                document.getElementById("login-form").addEventListener("submit", function(e) {
                                    e.preventDefault(); // Prevent default form submission

                                    const form = e.target;
                                    const email = form.email.value;
                                    const password = form.password.value;
                                    const otpField = document.getElementById("otp-field");
                                    const otpInput = form.otp;
                                    const otp = otpInput ? otpInput.value : "";
                                    const errorBox = document.getElementById("login-error");

                                    // If OTP field is visible, user is verifying OTP
                                    if (otpField.style.display === "block") {
                                        // Verify OTP
                                        fetch("../../ecommerce-backend/verify-otp.php", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded"
                                                },
                                                body: `otp=${encodeURIComponent(otp)}`
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    window.location.href = data.redirect; // Redirect to dashboard or homepage
                                                } else {
                                                    errorBox.textContent = data.message;
                                                }
                                            });
                                    } else {
                                        // First step: validate email and password
                                        fetch("../../ecommerce-backend/login.php", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded"
                                                },
                                                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&ajax=1`
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.otpSent) {
                                                    otpField.style.display = "block"; // Show OTP field
                                                    document.getElementById("login-button").textContent = "Verifying...";
                                                    errorBox.textContent = "OTP sent to your email.";

                                                    // Add event listener for OTP input
                                                    otpInput.addEventListener("input", function() {
                                                        if (otpInput.value.length === 6) {
                                                            // Automatically submit the form when 6 digits are entered
                                                            form.dispatchEvent(new Event("submit"));
                                                        }
                                                    });
                                                } else {
                                                    errorBox.textContent = data.message;
                                                }
                                            });
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="navbar-top bg-success pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="shop.php" class="mb-0 text-white">
                    20% cashback for new users | Code: <strong><span class="text-light">OGOFERS13 <span class="mdi mdi-tag-faces"></span></span> </strong>
                </a>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded osahan-menu">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo"> </a>
        <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                <div class="top-categories-search">

                    <div class="input-group">
                        <span class="input-group-btn categories-dropdown" hidden>
                            <select id="category" name="category" class="form-control-select">
                                <option selected="selected">Your Category</option>
                                <?php
                                include "./connection.php";
                                $query = $conn->prepare("SELECT * FROM category");
                                $query->execute();
                                $categories = $query->fetchAll();
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category["id"] . '">' . $category["name"] . '</option>';
                                }
                                ?>
                            </select>
                        </span>
                        <input class="form-control" id="search" name="search" placeholder="Search products" aria-label="Search products in Your City" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button" name="searchbtn">
                                <i class="mdi mdi-file-find"></i> Search
                            </button>
                        </span>
                    </div>
                    <div id="suggestions" style="position: absolute; background: white; width: 86% ;border: 1px solid #ddd; display: none;z-index: 1;"></div>
                </div>
            </div>
            <div class="my-2 my-lg-0">
                <ul class="list-inline main-nav-right">
                    <?php

                    if (isset($_SESSION['email'])) {
                    ?>
                        <li class="list-inline-item">
                            <a href="./my-profile.php" class="btn btn-link"><i class="mdi mdi-account-circle"></i> Hi

                                <?php
                                include "./connection.php";
                                $loginuser = $_SESSION['email'];
                                $que = $conn->prepare("SELECT * FROM customers WHERE email='$loginuser' || mobile_number='$loginuser'");
                                $que->execute();
                                $username = $que->fetchAll();
                                if ($username[0]["name"] == Null) {
                                    echo $loginuser;
                                } else {
                                    echo $username[0]["name"];
                                }
                                ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="list-inline-item">
                            <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"><i class="mdi mdi-account-circle"></i> Login/Sign Up</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="list-inline-item cart-btn">
                        <?php if (isset($loginuser)) { ?>
                            <a href="./cart.php" data-toggle="offcanvas" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart
                            </a>
                        <?php } else { ?>

                            <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"><i class="mdi mdi-cart"></i> My Cart</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto">
                <li class="nav-item">
                    <a class="nav-link shop" href="index.php"><strong>Home</strong></a>
                </li>

                <?php
                $query = $conn->prepare("SELECT * FROM category");
                $query->execute();
                $category = $query->fetchAll();
                foreach ($category as $ca) {
                    echo '<li class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle"  data-toggle="dropdown">' . $ca["name"] . '</a>
                        ';
                    $cid = $ca["id"];
                    $query = $conn->prepare("SELECT * FROM subcategory WHERE category_id=$cid");
                    $query->execute();
                    $subcategory = $query->fetchAll();
                    echo '<div class="dropdown-menu">';
                    foreach ($subcategory as $sca) {
                        echo '
                                <a class="dropdown-item" href="shop.php?subcategory=' . $sca["id"] . '"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> ' . $sca["name"] . '</a>
                              ';
                    }
                    echo "</div></li>";
                }
                ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More Pages
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="about.php"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> About Us</a>
                        <a class="dropdown-item" href="contact.php"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Contact Us</a>
                        <a class="dropdown-item" href="faq.php"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> FAQ </a>
                    </div>
                </li>
                <?php if (isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            let searchText = $(this).val();
            let category = $("#category").val();

            if (searchText.length > 0) {
                $.ajax({
                    url: "search_suggestions.php",
                    method: "POST",
                    data: {
                        query: searchText,
                        category: category
                    },
                    success: function(response) {
                        $("#suggestions").html(response).fadeIn();
                    }
                });
            } else {
                $("#suggestions").fadeOut();
            }
        });

        $(document).on("click", ".suggestion-item", function() {
            $("#search").val($(this).text());
            $("#suggestions").fadeOut();
        });

        $("button[name='searchbtn']").on("click", function() {
            let searchQuery = $("#search").val().trim();
            if (searchQuery !== "") {
                window.location.href = "viewall.php?product=" + encodeURIComponent(searchQuery);
            }
        });
    });
</script>