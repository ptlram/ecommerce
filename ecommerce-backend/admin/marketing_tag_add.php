<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Metronic Admin Theme #4 | Buttons Datatable</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta
        content="Preview page of Metronic Admin Theme #4 for buttons extension demos"
        name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link
        href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/font-awesome/css/font-awesome.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link
        href="../assets/global/plugins/datatables/datatables.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link
        href="../assets/global/css/components.min.css"
        rel="stylesheet"
        id="style_components"
        type="text/css" />
    <link
        href="../assets/global/css/plugins.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link
        href="../assets/layouts/layout4/css/layout.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="../assets/layouts/layout4/css/themes/default.min.css"
        rel="stylesheet"
        type="text/css"
        id="style_color" />
    <link
        href="../assets/layouts/layout4/css/custom.min.css"
        rel="stylesheet"
        type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php
    include "./header.php"
    ?>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container" style="margin-top: 85px;">
        <!-- BEGIN SIDEBAR -->
        <?php
        include "./sidebar.php"
        ?>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN CONTENT BODY -->

                <div class="row">
                    <div class="col-md-6">

                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">Add Marketing Tag</div>
                            </div>
                            <div class="portlet-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>title<span class="required">*</span></label>
                                        <input type="text" name="invoice_title" class="form-control" placeholder="Transaction title" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Priority<span class="required">*</span></label>
                                        <input type="text" name="invoice_priority" class="form-control" placeholder="Transaction priority " required>
                                    </div>
                                    <div class="form-group">
                                        <label for="market_tag_image">image</label>
                                        <input type="file" class="form-control" id="market_tag_image" name="market_tag_image" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea class="form-control" placeholder="description" name="invoice_description"></textarea>
                                    </div>

                                    <button type="submit" name="submit" class="btn blue">Add tag</button>
                                    <button class="btn btn-success"><a href="marketing_tag.php" style="text-decoration: none;color:white">Cancel</a></button>
                                </form>
                                <?php
                                include "../connection.php"; // Database connection

                                if (isset($_POST['submit'])) {
                                    $title = trim($_POST['invoice_title']);
                                    $priority = trim($_POST['invoice_priority']);
                                    $description = trim($_POST['invoice_description']);

                                    // Image upload logic
                                    $image = "";
                                    if (!empty($_FILES['market_tag_image']['name'])) {
                                        $target_dir = "../pages/uploads/marketing_tag/"; // Ensure this directory exists
                                        $random_number = rand(1000, 9999); // Generate a random number
                                        $image = $random_number . "_" . basename($_FILES["market_tag_image"]["name"]);
                                        $target_file = $target_dir . $image;

                                        // Validate and move uploaded file
                                        if (!move_uploaded_file($_FILES["market_tag_image"]["tmp_name"], $target_file)) {
                                            echo "<script>alert('Error uploading image.');</script>";
                                            $image = ""; // Reset image if upload fails
                                        }
                                    }

                                    try {
                                        // Prepare SQL query
                                        $query = $conn->prepare("INSERT INTO marketing_tag (title, priority, image, description) VALUES (:title, :priority, :image, :description)");

                                        // Execute the query
                                        $query->execute([
                                            ':title' => $title,
                                            ':priority' => $priority,
                                            ':image' => $image,
                                            ':description' => $description
                                        ]);

                                        // Get the last inserted ID
                                        $last_id = $conn->lastInsertId();

                                        echo "<script>
                                            alert('Marketing tag added successfully! ID: " . $last_id . "');
                                            window.location.href = 'marketing_tag.php?id=" . $last_id . "';
                                        </script>";
                                        exit();
                                    } catch (PDOException $e) {
                                        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php
    include "./footer.php"
    ?>
    <!-- END FOOTER -->
    <!-- BEGIN QUICK NAV -->

    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->

    <div class="quick-nav-overlay"></div>

    <script
        src="../assets/global/plugins/jquery.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/js.cookie.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/jquery.blockui.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script
        src="../assets/global/scripts/datatable.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/datatables/datatables.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
    <script
        src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script
        src="../assets/global/scripts/app.min.js"
        type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script
        src="../assets/pages/scripts/table-datatables-buttons.min.js"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script
        src="../assets/layouts/layout4/scripts/layout.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/layouts/layout4/scripts/demo.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/layouts/global/scripts/quick-sidebar.min.js"
        type="text/javascript"></script>
    <script
        src="../assets/layouts/global/scripts/quick-nav.min.js"
        type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>