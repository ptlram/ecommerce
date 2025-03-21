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
                        <h1>Add New Product
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
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="col-md-6 ">
                                            <h3 style="padding:5px 0px;font-weight: 500;">Product Details</h3>
                                            <div class="form-group">
                                                <label for="product_name">Product Name</label>
                                                <input class="form-control" type="text" name="product_name" placeholder="Enter Product Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="variant_name">Product Variant Name</label>
                                                <input class="form-control" type="text" name="variant_name" placeholder="Enter variant name" required>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Select Brand</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="brand" id="brand" data-size="8">
                                                        <option value="">Select brand</option>
                                                        <?php
                                                        include "../connection.php";
                                                        $query = $conn->prepare("select * from brand");
                                                        $query->execute();
                                                        $brand = $query->fetchAll();
                                                        foreach ($brand as $bd) {
                                                            echo ' <option value="' . $bd["name"] . '">' . $bd["name"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Select Category</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="category" id="category" data-size="8">
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        include '../pages/db.php'; // Database connection
                                                        $sql = "SELECT * FROM category";
                                                        $stmt = $pdo->query($sql);
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Sub Category</label>
                                                <div class="col-md-9">
                                                    <select class="bs-select form-control" data-live-search="true" id="subcategory" name="subcategory" data-size="8" required>
                                                        <option value="">Select SubCategory</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="subcategory">subcategory</label>
                                                <select class="form-control" id="subcategory" name="subcategory" required>
                                                    <option value="">Select subcategory</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="short_discription">Short Description</label>
                                                <textarea class="form-control" name="short_discription" placeholder="Enter Short Description"></textarea>
                                            </div>

                                            <div class="form-group last">
                                                <label class="control-label col-md-3" style="padding-left: 0;line-break: strict;">Long Discription</label>
                                                <div class="col-md-9">
                                                    <textarea class="ckeditor form-control" name="long_discription" rows="6"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="product_image">Product Image</label>
                                                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="multiple_product_image">Product Multiple Images</label>
                                                <input type="file" class="form-control" id="multiple_product_image" name="multiple_product_image[]" accept="image/*" multiple required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cgst">CGST *</label>
                                                <input type="number" class="form-control" id="cgst" name="cgst" value="0">
                                            </div>

                                            <div class="form-group">
                                                <label for="sgst">SGST *</label>
                                                <input type="number" class="form-control" id="sgst" name="sgst" value="0">
                                            </div>

                                            <div class="form-group">
                                                <label>Product is Exclusive Tax</label>
                                                <input type="checkbox" id="exclusiveTax">
                                                <label for="exclusiveTax">YES</label>
                                            </div>

                                            <div class="form-group">
                                                <label for="baseprice">Base Price *</label>
                                                <input type="number" class="form-control" id="baseprice" name="baseprice" value="0">
                                            </div>

                                            <div class="form-group">
                                                <label for="mrp">MRP *</label>
                                                <input type="number" class="form-control" id="mrp" name="mrp" value="0">
                                            </div>

                                            <div class="form-group">
                                                <label for="retailerprice">Retailer Price (Billing Amount)</label>
                                                <input type="number" class="form-control" name="retailerprice" required></input>
                                            </div>

                                            <div class="form-group">
                                                <label for="wholesalerprice">Wholesaler Price</label>
                                                <input type="number" class="form-control" name="wholesalerprice" required></input>
                                            </div>

                                            <div class="form-group">
                                                <label for="HSNCode">HSNCode</label>
                                                <input class="form-control" type="text" name="HSNCode" placeholder="HSNCode">
                                            </div>

                                            <div class="form-group">
                                                <label for="ProductSKU">Product SKU</label>
                                                <input class="form-control" type="text" name="ProductSKU" placeholder="Product SKU">
                                            </div>

                                            <div class="form-group">
                                                <label for="Priority">Priority</label>
                                                <input type="number" class="form-control" name="Priority" value="0" required></input>
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label><br>
                                                <label><input type="radio" name="Status" value="buynow" required> Buy Now</label><br>
                                                <label><input type="radio" name="Status" value="OutOfStock"> Out Of Stock</label><br>
                                                <label><input type="radio" name="Status" value="ComingSoon"> Coming Soon</label><br>
                                                <label><input type="radio" name="Status" value="InquiryNow"> Inquiry Now</label>
                                            </div>
                                            <button style="margin: 1.5%;" type="submit" name="submit" class="btn blue">Add Product</button>
                                            <button class="btn btn-success"><a href="productlist.php" style="text-decoration: none;color:white">Cancel</a></button>

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

                                        </div>
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

    <script>
        $(document).ready(function() {
            $("input[name='product_name']").on("input", function() {
                var brandName = $(this).val();
                var slug = brandName.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $("input[name='slug']").val(slug);
            });
        });
    </script>
    <!-- calculateMRP -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateFields() {
                let isExclusive = document.getElementById("exclusiveTax").checked;
                let basePriceField = document.getElementById("baseprice");
                let mrpField = document.getElementById("mrp");

                // Reset values when the checkbox is toggled
                basePriceField.value = "0";
                mrpField.value = "0";

                if (isExclusive) {
                    basePriceField.removeAttribute("readonly");
                    mrpField.setAttribute("readonly", true);
                } else {
                    basePriceField.setAttribute("readonly", true);
                    mrpField.removeAttribute("readonly");
                }
            }

            function calculateBasePrice() {

                let mrp = parseFloat(document.getElementById("mrp").value) || 0;
                let base = parseFloat(document.getElementById("baseprice").value) || 0;
                let cgst = parseFloat(document.getElementById("cgst").value) || 0;
                let sgst = parseFloat(document.getElementById("sgst").value) || 0;
                let isExclusive = document.getElementById("exclusiveTax").checked;
                let basePriceField = document.getElementById("baseprice");
                let mrpField = document.getElementById("mrp");

                if (!isExclusive) {
                    // If tax is inclusive, calculate Base Price
                    let basePrice = mrp / (1 + (cgst + sgst) / 100);
                    basePriceField.value = basePrice.toFixed(2);
                } else {
                    let mrpprice = base + ((base * (cgst + sgst)) / 100);
                    mrpField.value = mrpprice.toFixed(2);
                }
            }

            document.getElementById("mrp").addEventListener("input", calculateBasePrice);
            document.getElementById("baseprice").addEventListener("input", calculateBasePrice);
            document.getElementById("cgst").addEventListener("input", calculateBasePrice);
            document.getElementById("sgst").addEventListener("input", calculateBasePrice);
            document.getElementById("exclusiveTax").addEventListener("change", updateFields);

            // Initialize state on page load
            updateFields();
        });
    </script>




    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>
<?php
include "../connection.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    try {
        // Collect form data
        $product_name = $_POST['product_name'];
        $variant_name = $_POST['variant_name'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $short_description = $_POST['short_discription'];
        $long_description = $_POST['long_discription'];
        $cgst = $_POST['cgst'];
        $sgst = $_POST['sgst'];
        $exclusive_tax = isset($_POST['exclusiveTax']) ? 1 : 0;
        $base_price = $_POST['baseprice'];
        $mrp = $_POST['mrp'];
        $retailer_price = $_POST['retailerprice'];
        $wholesaler_price = $_POST['wholesalerprice'];
        $hsn_code = $_POST['HSNCode'];
        $product_sku = $_POST['ProductSKU'];
        $priority = $_POST['Priority'];
        $status = $_POST['Status'];
        $slug = $_POST['slug'];
        $title = $_POST['title'];
        $keyword = $_POST['keyword'];
        $author = $_POST['author'];

        // Set upload directory
        $target_dir = "../pages/uploads/products/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if not exists
        }

        // Function to sanitize filenames
        function sanitize_filename($filename)
        {
            return preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
        }

        // Handle single product image upload
        $product_image = "";
        if (!empty($_FILES['product_image']['name'])) {
            $original_name = pathinfo($_FILES['product_image']['name'], PATHINFO_FILENAME);
            $extension = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
            $random_prefix = rand(10000, 99999);
            $sanitized_name = sanitize_filename($original_name);
            $product_image = $random_prefix . $sanitized_name . "." . $extension;

            // Validate file type
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($extension, $allowed_extensions)) {
                die("Error: Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF.");
            }

            move_uploaded_file($_FILES['product_image']['tmp_name'], $target_dir . $product_image);
        }

        // Handle multiple product images upload
        $multiple_images = [];
        if (!empty($_FILES['multiple_product_image']['name'][0])) {
            foreach ($_FILES['multiple_product_image']['name'] as $key => $name) {
                $original_name = pathinfo($name, PATHINFO_FILENAME);
                $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                $random_prefix = rand(10000, 99999);
                $sanitized_name = sanitize_filename($original_name);
                $unique_filename = $random_prefix . $sanitized_name . "." . $extension;

                if (!in_array($extension, $allowed_extensions)) {
                    die("Error: Invalid file format for multiple images.");
                }

                move_uploaded_file($_FILES['multiple_product_image']['tmp_name'][$key], $target_dir . $unique_filename);
                $multiple_images[] = $unique_filename;
            }
        }
        $multiple_images_str = implode(",", $multiple_images); // Store filenames as CSV

        // Insert into database
        $query = $conn->prepare("INSERT INTO products 
            (product_name, variant_name, brand, category, subcategory, short_description, long_description, product_image, multiple_images, 
            cgst, sgst, exclusive_tax, base_price, mrp, retailer_price, wholesaler_price, hsn_code, product_sku, priority, status, 
            slug, title, keyword, author) 
            VALUES 
            (:product_name, :variant_name, :brand, :category, :subcategory, :short_description, :long_description, :product_image, 
            :multiple_images, :cgst, :sgst, :exclusive_tax, :base_price, :mrp, :retailer_price, :wholesaler_price, :hsn_code, 
            :product_sku, :priority, :status, :slug, :title, :keyword, :author)");

        $query->execute([
            ':product_name' => $product_name,
            ':variant_name' => $variant_name,
            ':brand' => $brand,
            ':category' => $category,
            ':subcategory' => $subcategory,
            ':short_description' => $short_description,
            ':long_description' => $long_description,
            ':product_image' => $product_image,
            ':multiple_images' => $multiple_images_str,
            ':cgst' => $cgst,
            ':sgst' => $sgst,
            ':exclusive_tax' => $exclusive_tax,
            ':base_price' => $base_price,
            ':mrp' => $mrp,
            ':retailer_price' => $retailer_price,
            ':wholesaler_price' => $wholesaler_price,
            ':hsn_code' => $hsn_code,
            ':product_sku' => $product_sku,
            ':priority' => $priority,
            ':status' => $status,
            ':slug' => $slug,
            ':title' => $title,
            ':keyword' => $keyword,
            ':author' => $author,
        ]);

        echo "<script>alert('Product added successfully!'); window.location.href='productlist.php';</script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>