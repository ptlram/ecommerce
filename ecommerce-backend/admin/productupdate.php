<?php
include "../connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<?php
include "../connection.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $variant_name = $_POST['variant_name'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $exclusive_tax = isset($_POST['exclusive_tax']) ? 1 : 0;
    $base_price = $_POST['base_price'];
    $mrp = $_POST['mrp'];
    $retailer_price = $_POST['retailer_price'];
    $wholesaler_price = $_POST['wholesaler_price'];
    $hsn_code = $_POST['hsn_code'];
    $product_sku = $_POST['product_sku'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $keyword = $_POST['keyword'];
    $author = $_POST['author'];

    // Handling Single Product Image Upload
    $product_image = $_FILES['product_image']['name'];
    $target_dir = "../pages/uploads/products/";

    if (!empty($product_image)) {
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
        $product_image_name = time() . "_" . basename($product_image);
        move_uploaded_file($product_image_tmp, $target_dir . $product_image_name);
    } else {
        // Keep existing image if no new file is uploaded
        $stmt = $conn->prepare("SELECT product_image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        $product_image_name = $row['product_image'];
    }

    // Handling Multiple Product Images
    $existing_images = [];
    $stmt = $conn->prepare("SELECT multiple_images FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if (!empty($row['multiple_images'])) {
        $existing_images = explode(',', $row['multiple_images']);
    }

    if (!empty($_FILES['multiple_product_image']['name'][0])) {
        $uploaded_images = [];
        foreach ($_FILES['multiple_product_image']['name'] as $key => $image_name) {
            $image_tmp = $_FILES['multiple_product_image']['tmp_name'][$key];
            $new_image_name = time() . "_" . basename($image_name);
            move_uploaded_file($image_tmp, $target_dir . $new_image_name);
            $uploaded_images[] = $new_image_name;
        }
        // Merge with existing images
        $all_images = array_merge($existing_images, $uploaded_images);
        $multiple_images = implode(',', $all_images);
    } else {
        $multiple_images = implode(',', $existing_images);
    }

    // Update Product Query
    $query = "UPDATE products SET 
                product_name = ?, 
                variant_name = ?, 
                brand = ?, 
                category = ?, 
                subcategory = ?, 
                short_description = ?, 
                long_description = ?, 
                product_image = ?, 
                multiple_images = ?, 
                cgst = ?, 
                sgst = ?, 
                exclusive_tax = ?, 
                base_price = ?, 
                mrp = ?, 
                retailer_price = ?, 
                wholesaler_price = ?, 
                hsn_code = ?, 
                product_sku = ?, 
                priority = ?, 
                status = ?, 
                slug = ?, 
                title = ?, 
                keyword = ?, 
                author = ? 
                WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([
        $product_name,
        $variant_name,
        $brand,
        $category,
        $subcategory,
        $short_description,
        $long_description,
        $product_image_name,
        $multiple_images,
        $cgst,
        $sgst,
        $exclusive_tax,
        $base_price,
        $mrp,
        $retailer_price,
        $wholesaler_price,
        $hsn_code,
        $product_sku,
        $priority,
        $status,
        $slug,
        $title,
        $keyword,
        $author,
        $id
    ]);

    if ($stmt) {
        echo "<script>alert('Product updated successfully'); window.location.href='productlist.php';</script>";
    } else {
        echo "<script>alert('Product update failed');</script>";
    }
}
?>
<?php
include "../connection.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    // Fetch existing images from the database
    $stmt = $conn->prepare("SELECT multiple_images FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && !empty($product['multiple_images'])) {
        $currentImages = explode(',', $product['multiple_images']);
    } else {
        $currentImages = [];
    }

    // Check if any images were selected for removal
    if (isset($_POST['remove_images'])) {
        $removeImages = $_POST['remove_images'];

        // Remove selected images from storage
        foreach ($removeImages as $img) {
            $filePath = "../pages/uploads/products/" . $img;
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
        }

        // Remove the deleted images from the database list
        $updatedImages = array_diff($currentImages, $removeImages);
        $newImageList = implode(',', $updatedImages);

        // Update the database with the new list
        $updateQuery = $conn->prepare("UPDATE products SET multiple_images = ? WHERE id = ?");
        $updateQuery->execute([$newImageList, $id]);
    }

    echo "<script>alert('Product images updated successfully'); window.location.href='product_edit.php?id=$id';</script>";
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
                        <h1>Update Product Details
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
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="col-md-6 ">
                                            <h3 style="padding:5px 0px;font-weight: 500;">Product Details</h3>

                                            <input type="hidden" name="id" value="<?= $product['id'] ?>">

                                            <div class="form-group">
                                                <label for="product_name">Product Name</label>
                                                <input class="form-control" type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="variant_name">Product Variant Name</label>
                                                <input class="form-control" type="text" name="variant_name" value="<?= htmlspecialchars($product['variant_name']) ?>" required>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Select Brand</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="brand" id="brand" data-size="8">
                                                        <option value="">Select brand</option>
                                                        <?php
                                                        include "../connection.php";
                                                        $query = $conn->prepare("SELECT * FROM brand");
                                                        $query->execute();
                                                        $brands = $query->fetchAll();
                                                        foreach ($brands as $bd) {
                                                            echo '<option value="' . $bd["name"] . '" ' . ($product['brand'] == $bd["name"] ? 'selected' : '') . '>' . $bd["name"] . '</option>';
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
                                                        $query = $conn->prepare("SELECT * FROM category");
                                                        $query->execute();
                                                        $categories = $query->fetchAll();
                                                        foreach ($categories as $cat) {
                                                            echo '<option value="' . $cat["id"] . '" ' . ($product['category'] == $cat["id"] ? 'selected' : '') . '>' . $cat["name"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Select Subcategory</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="subcategory" id="subcategory" data-size="8">
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        // $id = $product["category"];
                                                        // $query = $conn->prepare("SELECT * FROM subcategory where category_id=$id");
                                                        // $query->execute();
                                                        // $subcategories = $query->fetchAll();
                                                        // foreach ($subcategories as $cat) {
                                                        //     echo '<option value="' . $cat["id"] . '" ' . ($product['subcategory'] == $cat["id"] ? 'selected' : '') . '>' . $cat["name"] . '</option>';
                                                        // }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="subcategory">Subcategory</label>
                                                <select class="form-control" id="subcategory" name="subcategory" required>
                                                    <option value="">Select subcategory</option>
                                                    <?php
                                                    $id = $product["category"];
                                                    $query = $conn->prepare("SELECT * FROM subcategory where category_id=$id");
                                                    $query->execute();
                                                    $subcategories = $query->fetchAll();
                                                    foreach ($subcategories as $cat) {
                                                        echo '<option value="' . $cat["id"] . '" ' . ($product['subcategory'] == $cat["id"] ? 'selected' : '') . '>' . $cat["name"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="short_description">Short Description</label>
                                                <textarea class="form-control" name="short_description"><?= htmlspecialchars($product['short_description']) ?></textarea>
                                            </div>

                                            <div class="form-group last">
                                                <label class="control-label">Long Description</label>
                                                <textarea class="ckeditor form-control" name="long_description"><?= htmlspecialchars($product['long_description']) ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="product_image">Product Image</label>
                                                <input type="file" class="form-control" name="product_image">
                                                <img src="../pages/uploads/products/<?= $product['product_image'] ?>" width="100">
                                            </div>

                                            <div class="form-group">
                                                <label for="multiple_product_image">Multiple Product Images</label>
                                                <input type="file" class="form-control" name="multiple_product_image[]" multiple>

                                                <?php
                                                if (!empty($product['multiple_images'])) {
                                                    $images = explode(',', $product['multiple_images']); // Adjust if stored as JSON
                                                    foreach ($images as $image) {
                                                        $image = trim($image);
                                                        echo '<div style="display: inline-block; margin: 5px; text-align: center;">
                                                                <img src="../pages/uploads/products/' . htmlspecialchars($image) . '" width="100">
                                                                <br>
                                                                <input type="checkbox" name="remove_images[]" value="' . htmlspecialchars($image) . '"> Remove
                                                                    </div>';
                                                    }
                                                }
                                                ?>
                                            </div>



                                            <div class="form-group">
                                                <label for="cgst">CGST *</label>
                                                <input type="number" class="form-control" name="cgst" value="<?= $product['cgst'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="sgst">SGST *</label>
                                                <input type="number" class="form-control" name="sgst" value="<?= $product['sgst'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Exclusive Tax</label>
                                                <input type="checkbox" name="exclusive_tax" value="1" <?= $product['exclusive_tax'] ? 'checked' : '' ?>> YES
                                            </div>

                                            <div class="form-group">
                                                <label for="base_price">Base Price *</label>
                                                <input type="number" class="form-control" name="base_price" value="<?= $product['base_price'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="mrp">MRP *</label>
                                                <input type="number" class="form-control" name="mrp" value="<?= $product['mrp'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="retailer_price">Retailer Price</label>
                                                <input type="number" class="form-control" name="retailer_price" value="<?= $product['retailer_price'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="wholesaler_price">Wholesaler Price</label>
                                                <input type="number" class="form-control" name="wholesaler_price" value="<?= $product['wholesaler_price'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="hsn_code">HSN Code</label>
                                                <input class="form-control" type="text" name="hsn_code" value="<?= htmlspecialchars($product['hsn_code']) ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="product_sku">Product SKU</label>
                                                <input class="form-control" type="text" name="product_sku" value="<?= htmlspecialchars($product['product_sku']) ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="priority">Priority</label>
                                                <input type="number" class="form-control" name="priority" value="<?= $product['priority'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label><br>
                                                <label><input type="radio" name="status" value="buynow" <?= $product['status'] === 'buynow' ? 'checked' : '' ?>> Buy Now</label><br>
                                                <label><input type="radio" name="status" value="OutOfStock" <?= $product['status'] === 'OutOfStock' ? 'checked' : '' ?>> Out of Stock</label><br>
                                                <label><input type="radio" name="status" value="ComingSoon" <?= $product['status'] === 'ComingSoon' ? 'checked' : '' ?>> Coming Soon</label><br>
                                                <label><input type="radio" name="status" value="InquiryNow" <?= $product['status'] === 'InquiryNow' ? 'checked' : '' ?>> Inquiry Now</label>
                                            </div>
                                            <button type="submit" name="update" class="btn blue">Update Product</button>
                                            <button class="btn btn-success"><a href="productlist.php" style="text-decoration: none;color:white">Cancel</a></button>

                                        </div>
                                        <div class="col-md-6 ">
                                            <h3 style="padding:5px 0px;font-weight: 500;">SEO Details</h3>

                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input class="form-control" type="text" name="slug" value="<?= htmlspecialchars($product['slug']) ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">title</label>
                                                <input class="form-control" type="text" name="title" value="<?= htmlspecialchars($product['title']) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="keyword">keyword</label>
                                                <input class="form-control" type="text" name="keyword" value="<?= htmlspecialchars($product['keyword']) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="author">author</label>
                                                <input class="form-control" type="text" name="author" value="<?= htmlspecialchars($product['author']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">

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
    <!-- END THEME LAYOUT SCRIPTS -->
    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("input[name='product_name']").on("input", function() {
                var brandName = $(this).val();
                var slug = brandName.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $("input[name='slug']").val(slug);
            });
        });
    </script>
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
</body>

</html>