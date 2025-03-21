<?php
include "../connection.php"; // Database connection

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid ID.'); window.location.href = 'marketing_tag.php';</script>";
    exit();
}

$id = $_GET['id'];

// Fetch current tag details
$query = $conn->prepare("SELECT * FROM marketing_tag WHERE id = :id");
$query->execute([":id" => $id]);
$tag = $query->fetch(PDO::FETCH_ASSOC);

if (!$tag) {
    echo "<script>alert('Tag not found.'); window.location.href = 'marketing_tag.php';</script>";
    exit();
}

// Handle form submission
if (isset($_POST['update'])) {
    $title = trim($_POST['invoice_title']);
    $priority = trim($_POST['invoice_priority']);
    $description = trim($_POST['invoice_description']);

    // Image Upload Logic (if new image is uploaded)
    $image = $tag['image']; // Keep old image if not updated
    if (!empty($_FILES['market_tag_image']['name'])) {
        $target_dir = "../pages/uploads/marketing_tag/";
        $random_number = rand(1000, 9999);
        $image = $random_number . "_" . basename($_FILES["market_tag_image"]["name"]);
        $target_file = $target_dir . $image;

        if (move_uploaded_file($_FILES["market_tag_image"]["tmp_name"], $target_file)) {
            // Optional: Delete the old image if a new one is uploaded
            if (!empty($tag['image']) && file_exists($target_dir . $tag['image'])) {
                unlink($target_dir . $tag['image']);
            }
        } else {
            echo "<script>alert('Error uploading image.');</script>";
            $image = $tag['image']; // Keep old image on failure
        }
    }

    // Update Query
    $update_query = $conn->prepare("UPDATE marketing_tag SET title = :title, priority = :priority, image = :image, description = :description WHERE id = :id");

    if ($update_query->execute([
        ':title' => $title,
        ':priority' => $priority,
        ':image' => $image,
        ':description' => $description,
        ':id' => $id
    ])) {
        echo "<script>alert('Marketing tag updated successfully!'); window.location.href = 'marketing_tag.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating tag.');</script>";
    }
}
?>

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
                        <h1>Update marketing tag
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <!-- HTML Form for Updating Expense -->
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <label>Title<span class="required">*</span></label>
                                    <input type="text" name="invoice_title" class="form-control" value="<?php echo htmlspecialchars($tag['title']); ?>" required>

                                    <label>Priority<span class="required">*</span></label>
                                    <input type="text" name="invoice_priority" class="form-control" value="<?php echo htmlspecialchars($tag['priority']); ?>" required>

                                    <label>Current Image</label><br>
                                    <?php if (!empty($tag['image'])): ?>
                                        <img src="../pages/uploads/marketing_tag/<?php echo $tag['image']; ?>" width="100">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>

                                    <label>Change Image</label>
                                    <input type="file" class="form-control" name="market_tag_image" accept="image/*">

                                    <label>Description</label>
                                    <textarea class="form-control" name="invoice_description"><?php echo htmlspecialchars($tag['description']); ?></textarea>

                                    <button type="submit" name="update" class="btn btn-success">Update Tag</button>
                                    <a href="marketing_tag.php" class="btn btn-danger">Cancel</a>
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
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>