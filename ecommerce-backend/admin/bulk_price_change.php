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
                        <h1>Bulk Price Change
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
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label col-md-3" style="padding-left: 0;">Select Category</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="category" id="category" data-size="8" required>
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

                                            <div class="form-group">
                                                <label for="subcategory">subcategory</label>
                                                <select class="form-control" id="subcategory" name="subcategory" required>
                                                    <option value="">Select subcategory</option>
                                                </select>
                                            </div>
                                            <button style="margin: 1.5%;" type="submit" name="submit" class="btn blue">Search</button>
                                            <!-- Table to display the fetched products -->
                                            <div class="col-md-12">
                                                <h3 class="form-section" style="margin-left: 10px;">Product List</h3>

                                                <div class="col-md-4">
                                                    <label class="control-label">Produt Name</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Base Price</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">MRP</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Retail Price</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Wholesale Price</label>
                                                </div>
                                                <form id="updateForm" action="" method="post">
                                                    <div id="product-list"></div>
                                                    <button type="submit" name="updatebtn" class="btn blue" style="margin: 1.5%;">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        include '../connection.php'; // Database connection

                                        if (isset($_POST["updatebtn"])) {
                                            $product_ids = $_POST['product_id'];
                                            $mrp_values = $_POST['mrp'];
                                            $retailer_prices = $_POST['retailer_price'];
                                            $wholesaler_prices = $_POST['wholesaler_price'];

                                            $updatedCount = 0;


                                            foreach ($product_ids as $index => $product_id) {
                                                $mrp = $mrp_values[$index];
                                                $retailer_price = $retailer_prices[$index];
                                                $wholesaler_price = $wholesaler_prices[$index];

                                                $sql = "UPDATE products 
                                                SET mrp = :mrp, retailer_price = :retailer_price, wholesaler_price = :wholesaler_price 
                                                WHERE id = :id";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute([
                                                    ':mrp' => $mrp,
                                                    ':retailer_price' => $retailer_price,
                                                    ':wholesaler_price' => $wholesaler_price,
                                                    ':id' => $product_id
                                                ]);

                                                if ($stmt->rowCount() > 0) {
                                                    $updatedCount++;
                                                }
                                            }

                                            if ($updatedCount > 0) {
                                                echo "<script>alert('Successfully updated $updatedCount products!'); window.location.href='bulk_price_change.php';</script>";
                                            } else {
                                                echo "<script>alert('No changes were made.'); window.location.href='bulk_price_change.php';</script>";
                                            }
                                        }
                                        ?>
                                        <div class="form-actions">
                                        </div>

                                    </div>

                                </form>
                                <!-- Table to display the fetched products -->

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
    <!-- Add jQuery First -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Then Load Bootstrap Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.10.0/bootstrap-maxlength.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/3.1.1/pwstrength-bootstrap.min.js"></script>

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
            // Fetch subcategories when category changes
            $("#category").on("change", function() {
                var category = $(this).val();

                if (category) {
                    $("#subcategory").html('<option>Loading...</option>');

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
                    $("#subcategory").html('<option value="">Select a Subcategory</option>');
                }
            });

            // Fetch products when Search button is clicked
            $("button[name='submit']").on("click", function(e) {
                e.preventDefault();

                var categoryId = $("#category").val();
                var subcategoryId = $("#subcategory").val();

                if (categoryId !== "" && subcategoryId !== "") {
                    $.ajax({
                        type: "POST",
                        url: "fetch_products2.php",
                        data: {
                            category: categoryId,
                            subcategory: subcategoryId
                        },
                        dataType: "json",
                        success: function(response) {
                            $("#product-list").html("");
                            if (response.length > 0) {


                                $.each(response, function(index, item) {
                                    $("#product-list").append(`
                                        <div class="row">
                                            <input type="hidden" name="product_id[]" value="${item.id}">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="product_name[]" value="${item.product_name}" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="base_price[]" value="${item.base_price}" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="mrp[]" value="${item.mrp}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="retailer_price[]" value="${item.retailer_price}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="wholesaler_price[]" value="${item.wholesaler_price}">
                                            </div>
                                        </div>
                                    `);
                                });
                            } else {
                                $("#product-list").html("<p>No products found.</p>");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching products:", error);
                        }
                    });
                } else {
                    alert("Please select both Category and Subcategory.");
                }
            });


        });
    </script>

    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>