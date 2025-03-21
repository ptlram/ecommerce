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

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php
    include "./header.php";
    ?>
    <!-- END HEADER -->
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
                        <h1>important link
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
                            <?php
                            include "../connection.php"; // Database connection

                            // Fetch existing data from the database BEFORE the form
                            $stmt = $conn->prepare("SELECT * FROM important_links WHERE id = 1");
                            $stmt->execute();
                            $data = $stmt->fetch(PDO::FETCH_ASSOC) ?? [
                                'shipping_and_return' => '',
                                'privacy_policy' => '',
                                'terms_and_condition' => '',
                                'about_us' => ''
                            ];

                            if (isset($_POST['update'])) {
                                $shipping_and_return = trim($_POST['shipping_and_return']);
                                $privacy_policy = trim($_POST['privacy_policy']);
                                $terms_and_condition = trim($_POST['terms_and_condition']);
                                $about_us = trim($_POST['about_us']);

                                try {
                                    if ($data) {
                                        // If record exists, update it
                                        $query = $conn->prepare("UPDATE important_links SET 
                                    shipping_and_return = :shipping_and_return, 
                                    privacy_policy = :privacy_policy, 
                                    terms_and_condition = :terms_and_condition, 
                                    about_us = :about_us 
                                    WHERE id = 1");
                                    } else {
                                        // If record does not exist, insert a new one
                                        $query = $conn->prepare("INSERT INTO important_links (id, shipping_and_return, privacy_policy, terms_and_condition, about_us) 
                                     VALUES (1, :shipping_and_return, :privacy_policy, :terms_and_condition, :about_us)");
                                    }

                                    // Execute the query
                                    $query->execute([
                                        ':shipping_and_return' => $shipping_and_return,
                                        ':privacy_policy' => $privacy_policy,
                                        ':terms_and_condition' => $terms_and_condition,
                                        ':about_us' => $about_us
                                    ]);

                                    echo "<script>
            alert('Important links updated successfully!');
            window.location.href = 'important_links.php';
        </script>";
                                    exit();
                                } catch (PDOException $e) {
                                    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
                                }
                            }
                            ?>

                            <div class="portlet-body form">
                                <!-- HTML Form for Updating Important Links -->
                                <form method="POST">
                                    <div class="form-group last">
                                        <label>Shipping And Return</label>
                                        <textarea class="ckeditor form-control" name="shipping_and_return" rows="6" required><?= htmlspecialchars($data['shipping_and_return']); ?></textarea>
                                    </div>

                                    <div class="form-group last">
                                        <label>Privacy Policy</label>
                                        <textarea class="ckeditor form-control" name="privacy_policy" rows="6" required><?= htmlspecialchars($data['privacy_policy']); ?></textarea>
                                    </div>

                                    <div class="form-group last">
                                        <label>Terms And Condition</label>
                                        <textarea class="ckeditor form-control" name="terms_and_condition" rows="6" required><?= htmlspecialchars($data['terms_and_condition']); ?></textarea>
                                    </div>

                                    <div class="form-group last">
                                        <label>About Us</label>
                                        <textarea class="ckeditor form-control" name="about_us" rows="6" required><?= htmlspecialchars($data['about_us']); ?></textarea>
                                    </div>

                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                    <a href="important_links.php" class="btn btn-secondary">Cancel</a>
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
    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>