<?php
include "../connection.php"; // Include database connection

// Get ID from URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data
    $query = $conn->prepare("SELECT * FROM banners WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $offer = $query->fetch(PDO::FETCH_ASSOC);

    if (!$offer) {
        die("Offer not found.");
    }
}
?>
<?php
// Start output buffering to avoid "headers already sent" issues
ob_start();
session_start(); // Optional, if you're also using sessions

// Database connection (assuming $conn is already defined)
$uid = $_GET['id'];

// Fetch banner details from database
$queryp = $conn->prepare("SELECT * FROM banners WHERE id=:id");
$queryp->bindParam(':id', $uid, PDO::PARAM_INT);
$queryp->execute();
$pdsid = $queryp->fetch(PDO::FETCH_ASSOC);

// Ensure data exists before using it
if ($pdsid && isset($pdsid['product_id'])) {
    $idss = explode(",", $pdsid['product_id']); // Convert product_id string to array

    // Store the array in a cookie as a JSON string
    if ($pdsid['banner_for'] == "Product") {
        setcookie("product_ids", json_encode($idss), time() + 3600, "/"); // Expires in 1 hour
    } else {
        setcookie("product_ids", json_encode($idss), time() - 3600, "/"); // Expires in 1 hour
    }
}

// Flush output buffer
ob_end_flush();
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
                        <h1>Update offer Details
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <!-- HTML Form for Updating Brand -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <h4 class="mb-3">Offer Details</h4>

                                            <div class="form-group">
                                                <label for="state" class="control-label col-md-3" style="padding-left: 0;">Create Banner For</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="bannerfor" id="bannerfor" data-size="8" required>
                                                        <option value="">Create Banner For</option>
                                                        <option value="Brand" <?= ($offer['banner_for'] == 'Brand') ? 'selected' : ''; ?>>Brand</option>
                                                        <option value="Category" <?= ($offer['banner_for'] == 'Category') ? 'selected' : ''; ?>>Category</option>
                                                        <option value="Subcategory" <?= ($offer['banner_for'] == 'Subcategory') ? 'selected' : ''; ?>>Subcategory</option>
                                                        <option value="Product" <?= ($offer['banner_for'] == 'Product') ? 'selected' : ''; ?>>Selected Product</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Brand Selection -->

                                            <div id="brandGroup" class="form-group hidden">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Select Brand</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" name="brand" id="brand">
                                                        <option value="">Select Brand</option>
                                                        <?php
                                                        $query = $conn->prepare("SELECT * FROM brand");
                                                        $query->execute();
                                                        $brands = $query->fetchAll();
                                                        foreach ($brands as $bd) {
                                                            $selected = ($offer['brand'] == $bd["name"]) ? "selected" : "";
                                                            echo '<option value="' . $bd["name"] . '" ' . $selected . '>' . $bd["name"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Category Selection -->
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
                                                            $selected = ($offer['category'] == $row['id']) ? "selected" : "";
                                                            echo "<option value='" . $row['id'] . "' $selected>" . htmlspecialchars($row['name']) . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Subcategory Selection -->
                                            <div id="subcategoryGroup" class="form-group hidden">
                                                <label for="subcategory" style="padding-left: 0;">Subcategory</label>
                                                <select class="form-control" id="subcategory" name="subcategory">
                                                    <option value="">Select Subcategory</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input class="form-control" type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($offer['name']) ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="discription">Description</label>
                                                <textarea class="form-control" name="discription"><?= htmlspecialchars($offer['description']) ?></textarea>
                                            </div>

                                            <label class="control-label col-md-2" style="padding-left: 0;">Date Range</label>
                                            <div class="col-md-3">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                    <input type="date" class="form-control" name="from" value="<?= $offer['from_date'] ?>" required>
                                                    <span class=" input-group-addon"> to </span>
                                                    <input type="date" class="form-control" name="to" value="<?= $offer['to_date'] ?>" required>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" style="padding-left: 0;">Is In Banner?</label>
                                                <label>
                                                    <input type="radio" name="IsInBanner" value="Yes" <?= ($offer['is_in_banner'] == 'Yes') ? 'checked' : ''; ?> required> Yes
                                                </label>
                                                <label>
                                                    <input type="radio" name="IsInBanner" value="No" <?= ($offer['is_in_banner'] == 'No') ? 'checked' : ''; ?>> No
                                                </label>
                                            </div>

                                            <div id="bannerFields" class="<?= ($offer['is_in_banner'] == 'Yes') ? '' : 'hidden'; ?>">
                                                <div class="form-group">
                                                    <label for="AppBanner">App Banner</label><br>
                                                    <?php if (!empty($offer['app_banner'])): ?>
                                                        <img src="../pages/uploads/banners/<?= $offer['app_banner'] ?>" alt="App Banner" style="width: 100px; height: auto;"><br><br>
                                                    <?php endif; ?>
                                                    <label for="AppBanner">Upload New App Banner</label>
                                                    <input type="file" class="form-control" id="AppBanner" name="AppBanner" accept="image/*">
                                                </div>

                                                <div class="form-group">
                                                    <label for="WebBanner">Web Banner</label><br>
                                                    <?php if (!empty($offer['web_banner'])): ?>
                                                        <img src="../pages/uploads/banners/<?= $offer['web_banner'] ?>" alt="Web Banner" style="width: 100px; height: auto;"><br><br>
                                                    <?php endif; ?>
                                                    <label for="WebBanner">Upload New Web Banner</label>
                                                    <input type="file" class="form-control" id="WebBanner" name="WebBanner" accept="image/*">
                                                </div>

                                            </div>

                                            <div id="productGroup" class="form-group hidden">
                                                <label for="SelectProduct">Select Product</label>
                                                <input class="form-control" type="text" id="SelectProduct" name="SelectProduct" placeholder="Search Product">
                                                <div id="productResults">

                                                </div> <!-- Results will be displayed here -->
                                                <div id="selectResults">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <th>ID</th>
                                                            <th>Product Name</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $uid = $_GET['id'];
                                                            $queryp = $conn->prepare("select * from banners where id=$uid");
                                                            $queryp->execute();
                                                            $pdsid = $queryp->fetchAll();

                                                            $idss = explode(",", $pdsid[0]['product_id']);

                                                            if ($pdsid[0]['banner_for'] == "Product") {
                                                                foreach ($idss as $idd) {
                                                                    echo "<tr>";
                                                                    echo '<td>' . $idd . '</td>';
                                                                    $q = $conn->prepare("select * from products where id=$idd");
                                                                    $q->execute();
                                                                    $p = $q->fetchAll();
                                                                    echo '<td>' . $p[0]["product_name"] . '</td>';
                                                                    echo "</tr>";
                                                                }
                                                            }

                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <h4 class="mb-3">SEO Details</h4>

                                            <div class="mb-3">
                                                <label class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug" value="<?= htmlspecialchars($offer['slug']) ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($offer['title']) ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Keyword</label>
                                                <textarea class="form-control" name="keyword"><?= htmlspecialchars($offer['keyword']) ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Author</label>
                                                <input type="text" class="form-control" name="author" value="<?= htmlspecialchars($offer['author']) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-success">Update Offer</button>
                                        <a href="offers_banner_list.php" class="btn btn-secondary">Cancel</a>
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
    <!-- END THEME LAYOUT SCRIPTS -->

    <!-- sub category -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // When Category is changed, fetch Subcategories
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

            // Load existing subcategory on page load if a category is pre-selected
            var existingCategory = $("#category").val();
            var existingSubcategory = "<?= $offer['subcategory'] ?? ''; ?>"; // Fetch from DB

            if (existingCategory) {
                $.ajax({
                    url: "../pages/fetch_subcategory.php",
                    method: "POST",
                    data: {
                        category_id: existingCategory
                    },
                    success: function(data) {
                        $("#subcategory").html(data);
                        $("#subcategory").val(existingSubcategory); // Set selected subcategory
                    }
                });
            }
        });
    </script>

    <!-- slug -->
    <script>
        $(document).ready(function() {
            $("input[name='name']").on("input", function() {
                var brandName = $(this).val();
                var slug = brandName.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $("input[name='slug']").val(slug);
            });
        });
    </script>
    <!-- product select  -->
    <script>
        let selectedValues = [];
        let product_ids = [];

        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("product-checkbox")) {
                let value = event.target.value;

                if (event.target.checked) {
                    selectedValues.push(value);
                    product_ids = product_ids.filter(item => item !== value);
                } else {
                    selectedValues = selectedValues.filter(item => item !== value);
                    product_ids.push(value);

                }

                console.log(selectedValues); // Check the array in the console
                document.cookie = "selectedProducts=" + JSON.stringify(selectedValues) + "; path=/; max-age=3600";
                document.cookie = "unchecked=" + JSON.stringify(product_ids) + "; path=/; max-age=3600";
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
    <!-- hidden  -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let bannerForDropdown = document.getElementById("bannerfor");
            let selectedBannerFor = bannerForDropdown.value; // Get pre-selected value

            // Reference the groups
            let brandGroup = document.getElementById("brandGroup");
            let categoryGroup = document.getElementById("categoryGroup");
            let subcategoryGroup = document.getElementById("subcategoryGroup");
            let productGroup = document.getElementById("productGroup");

            // Hide all groups initially
            function hideAllGroups() {
                brandGroup.classList.add("hidden");
                categoryGroup.classList.add("hidden");
                subcategoryGroup.classList.add("hidden");
                productGroup.classList.add("hidden");
            }

            // Show correct group based on selection
            function showSelectedGroup(value) {
                hideAllGroups();
                if (value === "Brand") {
                    brandGroup.classList.remove("hidden");
                } else if (value === "Category") {
                    categoryGroup.classList.remove("hidden");
                } else if (value === "Subcategory") {
                    categoryGroup.classList.remove("hidden");
                    subcategoryGroup.classList.remove("hidden");
                } else if (value === "Product") {
                    productGroup.classList.remove("hidden");
                    document.cookie = "selectedProducts=" + JSON.stringify(selectedValues) + "; path=/; max-age=0";
                    document.cookie = "unchecked=" + JSON.stringify(selectedValues) + "; path=/; max-age=0";

                }
            }

            // Run function on page load to apply correct visibility
            showSelectedGroup(selectedBannerFor);

            // Listen for dropdown changes
            bannerForDropdown.addEventListener("change", function() {
                showSelectedGroup(this.value);
            });

            // Handle Subcategory population based on selected Category
            document.getElementById("category").addEventListener("change", function() {
                let categoryId = this.value;
                let subcategoryDropdown = document.getElementById("subcategory");

                if (categoryId) {
                    subcategoryDropdown.innerHTML = '<option>Loading...</option>'; // Show loading text

                    fetch("../pages/fetch_subcategory.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: `category_id=${categoryId}`,
                        })
                        .then(response => response.text())
                        .then(data => {
                            subcategoryDropdown.innerHTML = data;
                        })
                        .catch(() => {
                            alert("Failed to fetch subcategories. Please try again.");
                        });
                } else {
                    subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';
                }
            });

            // Handle Banner Visibility
            let isInBannerRadios = document.querySelectorAll("input[name='IsInBanner']");
            let appBannerField = document.getElementById("AppBanner").parentElement;
            let webBannerField = document.getElementById("webBanner").parentElement;

            function toggleBannerFields() {
                let checkedValue = document.querySelector("input[name='IsInBanner']:checked").value;
                if (checkedValue === "Yes") {
                    appBannerField.classList.remove("hidden");
                    webBannerField.classList.remove("hidden");
                } else {
                    appBannerField.classList.add("hidden");
                    webBannerField.classList.add("hidden");
                }
            }

            // Run on page load to apply correct banner visibility
            toggleBannerFields();

            // Listen for radio button changes
            isInBannerRadios.forEach((radio) => {
                radio.addEventListener("change", toggleBannerFields);
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bannerYes = document.querySelector('input[name="IsInBanner"][value="Yes"]');
            const bannerNo = document.querySelector('input[name="IsInBanner"][value="No"]');
            const bannerFields = document.getElementById("bannerFields");
            const appBannerField = document.getElementById("AppBanner").closest(".form-group"); // Target parent div
            const webBannerField = document.getElementById("WebBanner").closest(".form-group"); // Target parent div
            const appBanner = document.getElementById("AppBanner");
            const webBanner = document.getElementById("WebBanner");

            function toggleBannerFields() {
                if (bannerYes.checked) {
                    bannerFields.classList.remove("hidden");
                    appBannerField.classList.remove("hidden"); // Show App Banner field
                    webBannerField.classList.remove("hidden"); // Show Web Banner field

                } else {
                    bannerFields.classList.add("hidden");
                    appBannerField.classList.add("hidden"); // Hide App Banner field
                    webBannerField.classList.add("hidden"); // Hide Web Banner field

                }
            }

            // Run function on page load to apply correct visibility
            toggleBannerFields();

            // Attach event listeners
            bannerYes.addEventListener("change", toggleBannerFields);
            bannerNo.addEventListener("change", toggleBannerFields);
        });
    </script>
</body>

</html>

<?php
include '../connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $offerId = $id ?? null; // Check if offer ID exists for update
    $bannerFor = $_POST["bannerfor"];
    $brand = $_POST["brand"] ?? null;
    $category = $_POST["category"] ?? null;
    $subcategory = $_POST["subcategory"] ?? null;
    $name = $_POST["name"];
    $description = $_POST["discription"] ?? null;
    $fromDate = $_POST["from"];
    $toDate = $_POST["to"];
    $isInBanner = $_POST["IsInBanner"];
    $slug = $_POST["slug"];
    $title = $_POST["title"] ?? null;
    $keyword = $_POST["keyword"] ?? null;
    $author = $_POST["author"] ?? 'Bits Infotech';
    $product_id = null;

    $uploadDir = "../pages/uploads/banners/";
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    function uploadImage($file, $uploadDir, $allowedExtensions, $existingFile = null)
    {
        if (!empty($file["name"])) {
            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                die("Error: Invalid file type! Allowed: jpg, jpeg, png, gif");
            }
            if ($file["size"] > 2 * 1024 * 1024) {
                die("Error: File too large! Maximum allowed size is 2MB.");
            }
            $fileName = time() . "_" . basename($file["name"]);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($file["tmp_name"], $targetPath)) {
                return $fileName;
            }
        }
        return $existingFile;
    }

    // Determine product_id based on selection
    if ($bannerFor == "Brand") {
        $nquery = $conn->prepare("SELECT id FROM products WHERE brand = :brand");
        $nquery->bindParam(':brand', $brand);
    } elseif ($bannerFor == "Category") {
        $nquery = $conn->prepare("SELECT id FROM products WHERE category = :category");
        $nquery->bindParam(':category', $category);
    } elseif ($bannerFor == "Subcategory") {
        $nquery = $conn->prepare("SELECT id FROM products WHERE subcategory = :subcategory");
        $nquery->bindParam(':subcategory', $subcategory);
    } elseif ($bannerFor == "Product") {
        if (isset($_COOKIE["selectedProducts"])) {
            $cookieproduct = $_COOKIE["selectedProducts"];
            $cookieproduct = json_decode($_COOKIE['selectedProducts'], true);
        } else {
            $cookieproduct = [];
        }
        if (isset($_COOKIE["product_ids"])) {
            $cookieupdate = $_COOKIE["product_ids"];
            $cookieupdate = json_decode($_COOKIE['product_ids'], true);
        } else {
            $cookieupdate = [];
        }
        if (isset($_COOKIE["unchecked"])) {
            $unchecked = $_COOKIE["unchecked"];
            $unchecked = json_decode($_COOKIE['unchecked'], true);
        } else {
            $unchecked = [];
        }

        // Remove elements present in $removedata from $arrayData
        $product_id  = array_diff($cookieupdate, $unchecked);

        // Re-index the array (optional)
        $product_id  = array_values($product_id);

        $product_id  = array_merge($product_id, $cookieproduct);

        // Remove duplicates
        $product_id  = array_unique($product_id);

        // Reset array indexes after removing duplicates
        $product_id  = array_values($product_id);
        $product_id = implode(",", $product_id);
        $brand = "";
        $category = "";
        $subcategory = "";
        $bannerFor = "Product";
    }

    if (isset($nquery)) {
        $nquery->execute();
        $ids = $nquery->fetchAll(PDO::FETCH_COLUMN);
        $product_id = !empty($ids) ? implode(",", $ids) : null;
    }

    if ($product_id === null || $product_id == "") {
        echo "<script>alert('Product not found! Please select a valid product or Field.'); window.history.back();</script>";
        exit();
    }

    // Get existing banner images if updating
    if ($offerId) {
        $stmt = $conn->prepare("SELECT app_banner, web_banner FROM banners WHERE id = :offerId");
        $stmt->bindParam(':offerId', $offerId);
        $stmt->execute();
        $existingBanners = $stmt->fetch(PDO::FETCH_ASSOC);
        $existingAppBanner = $existingBanners['app_banner'] ?? "";
        $existingWebBanner = $existingBanners['web_banner'] ?? "";
    } else {
        $existingAppBanner = "";
        $existingWebBanner = "";
    }

    // Upload images
    $appBannerName = uploadImage($_FILES["AppBanner"], $uploadDir, $allowedExtensions, $existingAppBanner);
    $webBannerName = uploadImage($_FILES["WebBanner"], $uploadDir, $allowedExtensions, $existingWebBanner);

    if ($offerId) {
        // Update existing offer
        $query = "UPDATE banners SET 
            banner_for = :banner_for, brand = :brand, category = :category, subcategory = :subcategory, 
            name = :name, description = :description, from_date = :from_date, to_date = :to_date, 
            is_in_banner = :is_in_banner, product_id = :product_id, app_banner = :app_banner, 
            web_banner = :web_banner, slug = :slug, title = :title, keyword = :keyword, author = :author
            WHERE id = :offerId";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':offerId', $offerId);
    } else {
        // Insert new offer
        $query = "INSERT INTO banners (
            banner_for, brand, category, subcategory, name, description, from_date, to_date, 
            is_in_banner, product_id, app_banner, web_banner, slug, title, keyword, author
        ) VALUES (
            :banner_for, :brand, :category, :subcategory, :name, :description, :from_date, 
            :to_date, :is_in_banner, :product_id, :app_banner, :web_banner, :slug, :title, :keyword, :author
        )";

        $stmt = $conn->prepare($query);
    }

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
        setcookie("unchecked", "", time() - 3600, "/");
        echo "<script>alert('Offer " . ($offerId ? "updated" : "added") . " successfully!'); window.location.href='offers_banner_list.php';</script>";
    } else {
        echo "Error processing request.";
    }
}
?>