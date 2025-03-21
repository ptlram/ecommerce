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
                        <h1>Add New Blog
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
                                            <h3 style="padding:5px 0px;font-weight: 500;">Blog Details</h3>
                                            <div class="form-group">
                                                <label for="blog_title">Blog Title</label>
                                                <input class="form-control" type="text" name="blog_title" placeholder="Enter Product Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="date">Blog Date</label>
                                                <input class="form-control" type="date" name="date" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="blog_image">Blog Image</label>
                                                <input type="file" class="form-control" id="blog_image" name="blog_image" accept="image/*" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="keyword">Keywords/Tag</label>
                                                <textarea class="form-control" name="keyword" placeholder="Keyword"></textarea>
                                                Comma (,) separated to multiple keyword
                                            </div>

                                            <div class="form-group">
                                                <label for="short_discription">Short Description</label>
                                                <textarea class="form-control" name="short_discription" placeholder="Enter Short Description" required></textarea>
                                            </div>

                                            <div class="form-group last">
                                                <label class="control-label col-md-3" style="padding-left: 0;line-break: strict;">Long Discription</label>
                                                <div class="col-md-9">
                                                    <textarea class="ckeditor form-control" name="long_discription" rows="6" required></textarea>
                                                </div>
                                            </div>
                                            <div style="margin-left: 10%; margin-top: 590px;">
                                                <button style="margin: 1.5%;" type="submit" name="submit" class="btn blue">Add Blog</button>
                                                <button class="btn btn-success"><a href="blog.php" style="text-decoration: none;color:white">Cancel</a></button>
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
            $("input[name='blog_title']").on("input", function() {
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
include "../connection.php";
// Function to Generate Unique Image Name
function generateUniqueFileName($originalName)
{
    $uniqueNumber = time(); // Generate timestamp as unique number
    return $uniqueNumber . $originalName; // Concatenate timestamp + original name
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $blog_title = $_POST['blog_title'];
    $blog_date = $_POST['date'];
    $keyword = $_POST['keyword'];
    $short_description = $_POST['short_discription'];
    $long_description = $_POST['long_discription'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Handling Image Upload with Unique Name
    $target_dir = "../pages/uploads/blog/"; // Folder to store images
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $originalImageName = $_FILES["blog_image"]["name"];
    $uniqueImageName = generateUniqueFileName($originalImageName); // Get unique file name
    $target_file = $target_dir . $uniqueImageName;

    move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file);

    // Insert data into database (Storing Only Unique Image Name)
    $sql = "INSERT INTO blogs (blog_title, blog_date, blog_image, keyword, short_description, long_description, slug, title, author) 
            VALUES (:blog_title, :blog_date, :blog_image, :keyword, :short_description, :long_description, :slug, :title, :author)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':blog_title', $blog_title);
    $stmt->bindParam(':blog_date', $blog_date);
    $stmt->bindParam(':blog_image', $uniqueImageName); // Store only the image name
    $stmt->bindParam(':keyword', $keyword);
    $stmt->bindParam(':short_description', $short_description);
    $stmt->bindParam(':long_description', $long_description);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);

    if ($stmt->execute()) {
        echo "<script>alert('Blog added successfully!'); window.location.href='blog.php';</script>";
    } else {
        echo "<script>alert('Failed to add blog');</script>";
    }
}
?>