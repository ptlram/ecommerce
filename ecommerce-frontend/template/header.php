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
                                        <form action="../../ecommerce-backend/login.php" method="post">
                                            <fieldset class="form-group">
                                                <label>Enter Email/Mobile number</label>
                                                <input type="text" name="email" class="form-control" placeholder="+91 123 456 7890">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Enter Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="********">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                            </fieldset>
                                            <!-- <div class="login-with-sites text-center">
                                                <p>or Login with your social profile:</p>
                                                <button class="btn-facebook login-icons btn-lg"><i class="mdi mdi-facebook"></i> Facebook</button>
                                                <button class="btn-google login-icons btn-lg"><i class="mdi mdi-google"></i> Google</button>
                                                <button class="btn-twitter login-icons btn-lg"><i class="mdi mdi-twitter"></i> Twitter</button>
                                            </div> -->
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="register" role="tabpanel">
                                        <h5 class="heading-design-h5">Register Now!</h5>
                                        <form action="register.php" method="post">
                                            <fieldset class="form-group">
                                                <label for="emailOrMobile">Enter Email/Mobile number</label>
                                                <input type="text" class="form-control" id="emailOrMobile" name="emailOrMobile" placeholder="+91 123 456 7890" required>
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
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2" required>
                                                <label class="custom-control-label" for="customCheck2">
                                                    I Agree with <a href="#">Terms and Conditions</a>
                                                </label>
                                            </div>
                                            <fieldset class="form-group mt-3">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                            </fieldset>
                                        </form>

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
                        <span class="input-group-btn categories-dropdown">
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
                        <input class="form-control" id="search" name="search" placeholder="Search products in Your City" aria-label="Search products in Your City" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button" name="searchbtn">
                                <i class="mdi mdi-file-find"></i> Search
                            </button>
                        </span>
                    </div>
                    <div id="suggestions" style="position: absolute; background: white; width: 64%;margin-left: 22% ;border: 1px solid #ddd; display: none;z-index: 1;"></div>
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
                        <a href="#" data-toggle="offcanvas" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value">5</small></a>
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
                        Blog Page
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="blog.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog</a>
                        <a class="dropdown-item" href="blog-detail.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog Detail</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More Pages
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="about.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> About Us</a>
                        <a class="dropdown-item" href="contact.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Contact Us</a>
                        <a class="dropdown-item" href="faq.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> FAQ </a>
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