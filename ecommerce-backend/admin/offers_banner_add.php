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
    <style>
        .hidden {
            display: none;
        }
    </style>
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
                        <h1>Add Offers
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="col-md-6 ">
                                        <h3 style="padding:5px 0px;font-weight: 500;">Offers Details</h3>

                                        <div class="form-group">
                                            <label for="state" class="control-label col-md-3" style="padding-left: 0;">Create Banner For</label>
                                            <div class="col-md-9.5">
                                                <select class="bs-select form-control" data-live-search="true" name="bannerfor" id="bannerfor" data-size="8" required>
                                                    <option value="">Create Banner For</option>
                                                    <option value="Brand">Brand</option>
                                                    <option value="Category">Category</option>
                                                    <option value="Subcategory">Subcategory</option>
                                                    <option value="Product">Selected Product</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="brandGroup" class="form-group hidden">
                                            <label class="control-label col-md-3" style="padding-left: 0;">Select Brand</label>
                                            <div class="col-md-9.5">
                                                <select class="bs-select form-control" name="brand" id="brand">
                                                    <option value="">Select Brand</option>
                                                    <?php
                                                    include "../connection.php";
                                                    $query = $conn->prepare("SELECT * FROM brand");
                                                    $query->execute();
                                                    $brand = $query->fetchAll();
                                                    foreach ($brand as $bd) {
                                                        echo '<option value="' . $bd["name"] . '">' . $bd["name"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="categoryGroup" class="form-group hidden">
                                            <label class="control-label col-md-3" style="padding-left: 0;">Select Category</label>
                                            <div class="col-md-9.5">
                                                <select class="bs-select form-control" name="category" id="category">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    include '../pages/db.php';
                                                    $sql = "SELECT * FROM category";
                                                    $stmt = $pdo->query($sql);
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="subcategoryGroup" class="form-group hidden">
                                            <label for="subcategory" style="padding-left: 0;">Subcategory</label>
                                            <select class="form-control" id="subcategory" name="subcategory">
                                                <option value="">Select Subcategory</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" type="text" name="name" placeholder="Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="discription">Description</label>
                                            <textarea class="form-control" name="discription" placeholder="Description"></textarea>
                                        </div>

                                        <label class="control-label col-md-2" style="padding-left: 0;">Date Range</label>
                                        <div class="col-md-3">
                                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="date" class="form-control" name="from" required>
                                                <span class="input-group-addon"> to </span>
                                                <input type="date" class="form-control" name="to" required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" style="padding-left: 0;">Is In Banner?</label>
                                            <label><input type="radio" name="IsInBanner" value="Yes" required> Yes</label>
                                            <label><input type="radio" name="IsInBanner" value="No"> No</label>
                                        </div>

                                        <div class="form-group hidden">
                                            <label for="AppBanner">App Banner</label>
                                            <input type="file" class="form-control" id="AppBanner" name="AppBanner" accept="image/*">
                                        </div>

                                        <div class="form-group hidden">
                                            <label for="webBanner">Web Banner</label>
                                            <input type="file" class="form-control" id="webBanner" name="webBanner" accept="image/*">
                                        </div>

                                        <div id="productGroup" class="form-group hidden">
                                            <label for="SelectProduct">Select Product</label>
                                            <input class="form-control" type="text" id="SelectProduct" name="SelectProduct" placeholder="Search Product">
                                            <div id="productResults"></div> <!-- Results will be displayed here -->
                                            <div id="selectResults"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 ">
                                        <h3 style="padding:5px 0px;font-weight: 500;">SEO Details</h3>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input class="form-control" type="text" name="slug" placeholder="Slug" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input class="form-control" type="text" name="title" placeholder="Title">
                                        </div>

                                        <div class="form-group">
                                            <label for="keyword">Keyword</label>
                                            <textarea class="form-control" name="keyword" placeholder="Keyword"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input class="form-control" type="text" name="author" placeholder="Author" value="Bits Infotech">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button style="margin-left: 1.5%;" type="submit" name="submit" class="btn btn-success">Add Offer</button>
                                        <button class="btn btn-success"><a href="offers_banner_list.php" style="text-decoration: none;color:white">Cancel</a></button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let selectedValues = [];

        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("product-checkbox")) {
                let value = event.target.value;

                if (event.target.checked) {
                    selectedValues.push(value);
                } else {
                    selectedValues = selectedValues.filter(item => item !== value);
                }

                console.log(selectedValues); // Check the array in the console
                document.cookie = "selectedProducts=" + JSON.stringify(selectedValues) + "; path=/; max-age=3600";
                $.ajax({
                    url: "offerselectproduct.php",
                    method: "POST",
                    success: function(response) {
                        $("#selectResults").html(response);
                    }
                })
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#SelectProduct").on("keyup", function() {
                let query = $(this).val().trim();

                if (query.length < 1) { // Only search if at least 2 characters are typed
                    $("#productResults").html("");
                    return;
                }

                $.ajax({
                    url: "fetch_products.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $("#productResults").html(response);
                    },
                    error: function() {
                        $("#productResults").html("<p style='color:red;'>Error fetching products.</p>");
                    }
                });
            });
        });
    </script>
    <!-- sub category  -->
    <script>
        $(document).ready(function() {
            $("#category").on("change", function() {
                var category = $(this).val();

                if (category) {
                    $("#subcategory").html('<option>Loading...</option>'); // Show loading text

                    $.ajax({
                        url: "../pages/fetch_subcategory.php",
                        method: "POST",
                        data: {
                            category_id: category
                        },
                        success: function(data) {
                            $("#subcategory").html(data);
                        },
                        error: function() {
                            alert("Failed to fetch subcategories. Please try again.");
                        }
                    });
                } else {
                    $("#subcategory").html('<option value="">Select a Subcategory</option>'); // Reset dropdown
                }
            });
        });
    </script>
    <!-- slug  -->
    <script>
        $(document).ready(function() {
            $("input[name='name']").on("input", function() {
                var brandName = $(this).val();
                var slug = brandName.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $("input[name='slug']").val(slug);
            });
        });
    </script>

    <script>
        document.getElementById("bannerfor").addEventListener("change", function() {
            // Hide all groups first
            document.getElementById("brandGroup").classList.add("hidden");
            document.getElementById("categoryGroup").classList.add("hidden");
            document.getElementById("subcategoryGroup").classList.add("hidden");
            document.getElementById("productGroup").classList.add("hidden");

            // Get selected value
            let selectedValue = this.value;

            // Show only the selected field
            if (selectedValue === "Brand") {
                document.getElementById("brandGroup").classList.remove("hidden");
            } else if (selectedValue === "Category") {
                document.getElementById("categoryGroup").classList.remove("hidden");
            } else if (selectedValue === "Subcategory") {
                document.getElementById("categoryGroup").classList.remove("hidden");
                document.getElementById("subcategoryGroup").classList.remove("hidden");
            } else if (selectedValue === "Product") {
                document.getElementById("productGroup").classList.remove("hidden");
                document.cookie = "product_ids=" + JSON.stringify(selectedValues) + "; path=/; max-age=0";
                document.cookie = "selectedProducts=" + JSON.stringify(selectedValues) + "; path=/; max-age=0";
            }
        });

        document.querySelectorAll("input[name='IsInBanner']").forEach((radio) => {
            radio.addEventListener("change", function() {
                // Hide both banners initially
                document.getElementById("AppBanner").parentElement.classList.add("hidden");
                document.getElementById("webBanner").parentElement.classList.add("hidden");

                // Show banners if "Yes" is selected
                if (this.value === "Yes") {
                    document.getElementById("AppBanner").parentElement.classList.remove("hidden");
                    document.getElementById("webBanner").parentElement.classList.remove("hidden");
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bannerYes = document.querySelector('input[name="IsInBanner"][value="Yes"]');
            const bannerNo = document.querySelector('input[name="IsInBanner"][value="No"]');
            const appBanner = document.getElementById("AppBanner");
            const webBanner = document.getElementById("webBanner");

            function toggleBannerRequirement() {
                if (bannerYes.checked) {
                    appBanner.setAttribute("required", "required");
                    webBanner.setAttribute("required", "required");
                } else {
                    appBanner.removeAttribute("required");
                    webBanner.removeAttribute("required");
                }
            }

            bannerYes.addEventListener("change", toggleBannerRequirement);
            bannerNo.addEventListener("change", toggleBannerRequirement);
        });
    </script>



</body>

</html>
<?php
include '../connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bannerFor = $_POST["bannerfor"];
    $brand = $_POST["brand"] ?? null;
    $category = $_POST["category"] ?? null;
    $subcategory = $_POST["subcategory"] ?? null;
    // $selectedProduct = $_POST["SelectProduct"] ?? null;
    $name = $_POST["name"];
    $description = $_POST["discription"] ?? null;
    $fromDate = $_POST["from"];
    $toDate = $_POST["to"];
    $isInBanner = $_POST["IsInBanner"];
    $product_id = null;
    $slug = $_POST["slug"];
    $title = $_POST["title"] ?? null;
    $keyword = $_POST["keyword"] ?? null;
    $author = $_POST["author"] ?? 'Bits Infotech';

    $appBannerName = "";
    $webBannerName = "";

    // Fetch product IDs based on banner type
    if ($bannerFor == "Brand") {

        $queryid = $conn->prepare("SELECT id FROM products WHERE brand = :brand");
        $queryid->bindParam(':brand', $brand);
    } elseif ($bannerFor == "Category") {
        $queryid = $conn->prepare("SELECT id FROM products WHERE category = :category");
        $queryid->bindParam(':category', $category);
    } elseif ($bannerFor == "Subcategory") {
        $queryid = $conn->prepare("SELECT id FROM products WHERE subcategory = :subcategory");
        $queryid->bindParam(':subcategory', $subcategory);
    } elseif ($bannerFor == "Product") {
        $product_id = json_decode($_COOKIE['selectedProducts'], true);
        $product_id = implode(",", $product_id);
    }


    if (isset($queryid)) {
        $queryid->execute();
        $ids = $queryid->fetchAll(PDO::FETCH_COLUMN);
        $product_id = !empty($ids) ? implode(",", $ids) : null;
    }
    if ($product_id === null) {
        echo "<script>alert('Product not found! Please select a valid product or Field.'); window.history.back();</script>";
        exit();
    }

    // Define allowed file types
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $uploadDir = "../pages/uploads/banners/";

    // Function to handle file upload
    function uploadImage($file, $uploadDir, $allowedExtensions)
    {
        if (!empty($file["name"])) {
            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

            if (!in_array($extension, $allowedExtensions)) {
                die("Error: Invalid file type! Allowed: jpg, jpeg, png, gif");
            }

            if ($file["size"] > 2 * 1024 * 1024) { // Limit file size to 2MB
                die("Error: File too large! Maximum allowed size is 2MB.");
            }

            $fileName = time() . "_" . basename($file["name"]);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($file["tmp_name"], $targetPath)) {
                return $fileName; // Return only the file name
            }
        }
        return null;
    }

    // Upload banners safely
    $appBannerName = isset($_FILES["AppBanner"]) && !empty($_FILES["AppBanner"]["name"]) ?
        uploadImage($_FILES["AppBanner"], $uploadDir, $allowedExtensions) : "";

    $webBannerName = isset($_FILES["webBanner"]) && !empty($_FILES["webBanner"]["name"]) ?
        uploadImage($_FILES["webBanner"], $uploadDir, $allowedExtensions) : "";


    // Prepare SQL statement
    $query = "INSERT INTO banners (
        banner_for, brand, category, subcategory,  name, 
        description, from_date, to_date, is_in_banner, product_id, app_banner, web_banner, slug, title, keyword, author
    ) VALUES (
        :banner_for, :brand, :category, :subcategory, :name, 
        :description, :from_date, :to_date, :is_in_banner, :product_id, :app_banner, :web_banner, :slug, :title, :keyword, :author
    )";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':banner_for', $bannerFor);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':subcategory', $subcategory);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':from_date', $fromDate);
    $stmt->bindParam(':to_date', $toDate);
    $stmt->bindParam(':is_in_banner', $isInBanner);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':app_banner', $appBannerName);
    $stmt->bindParam(':web_banner', $webBannerName);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':keyword', $keyword);
    $stmt->bindParam(':author', $author);

    if ($stmt->execute()) {
        setcookie("selectedProducts", "", time() - 3600, "/");
        echo "<script>alert('Offer added successfully!'); window.location.href='offers_banner_list.php';</script>";
    } else {
        echo "Error adding banner.";
    }
}
?>