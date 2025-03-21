<?php
include "../connection.php";

// Get Blog ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Blog ID.");
}
$blog_id = $_GET['id'];

// Fetch Blog Data
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = :id");
$stmt->bindParam(':id', $blog_id);
$stmt->execute();
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("Blog not found.");
}

// Update Blog
if (isset($_POST['update'])) {
    $blog_title = $_POST['blog_title'];
    $blog_date = $_POST['blog_date'];
    $keyword = $_POST['keyword'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Image Handling (If new image is uploaded)
    if (!empty($_FILES["blog_image"]["name"])) {
        $originalImageName = $_FILES["blog_image"]["name"];
        $uniqueImageName = time() . "_" . $originalImageName; // Unique name
        $uploadPath = "../pages/uploads/blog/" . $uniqueImageName;

        // Unlink (delete) the old image if it exists
        if (!empty($blog['blog_image']) && file_exists("../pages/uploads/blog/" . $blog['blog_image'])) {
            unlink("../pages/uploads/blog/" . $blog['blog_image']);
        }

        // Move the new image to the upload directory
        move_uploaded_file($_FILES["blog_image"]["tmp_name"], $uploadPath);
    } else {
        $uniqueImageName = $blog['blog_image']; // Keep old image if no new one is uploaded
    }

    // Update Query
    $sql = "UPDATE blogs SET 
            blog_title = :blog_title, 
            blog_date = :blog_date, 
            blog_image = :blog_image, 
            keyword = :keyword, 
            short_description = :short_description, 
            long_description = :long_description, 
            slug = :slug, 
            title = :title, 
            author = :author 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':blog_title', $blog_title);
    $stmt->bindParam(':blog_date', $blog_date);
    $stmt->bindParam(':blog_image', $uniqueImageName);
    $stmt->bindParam(':keyword', $keyword);
    $stmt->bindParam(':short_description', $short_description);
    $stmt->bindParam(':long_description', $long_description);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':id', $blog_id);

    if ($stmt->execute()) {
        echo "<script>alert('Blog updated successfully!'); window.location.href='blog.php';</script>";
    } else {
        echo "<script>alert('Failed to update blog');</script>";
    }
}
?>


</html>

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
                        <h1>Update Blog Details
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
                                    <div class="col-md-6">
                                        <h3 style="padding:5px 0px;font-weight: 500;">Blog Details</h3>

                                        <div class="form-group">
                                            <label for="blog_title">Blog Title</label>
                                            <input class="form-control" type="text" name="blog_title" value="<?= htmlspecialchars($blog['blog_title']) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="blog_date">Blog Date</label>
                                            <input class="form-control" type="date" name="blog_date" value="<?= htmlspecialchars($blog['blog_date']) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="blog_image">Current Image</label><br>
                                            <img src="../pages/uploads/blog/<?= htmlspecialchars($blog['blog_image']) ?>" alt="Blog Image" style="width: 100px; height: auto;"><br><br>
                                            <label for="blog_image">Upload New Image</label>
                                            <input type="file" class="form-control" id="blog_image" name="blog_image" accept="image/*">
                                        </div>

                                        <div class="form-group">
                                            <label for="keyword">Keywords</label>
                                            <textarea class="form-control" name="keyword"><?= htmlspecialchars($blog['keyword']) ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea class="form-control" name="short_description"><?= htmlspecialchars($blog['short_description']) ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="long_description">Long Description</label>
                                            <textarea class="ckeditor form-control" name="long_description" rows="6"><?= htmlspecialchars($blog['long_description']) ?></textarea>
                                        </div>
                                        <button type="submit" name="update" class="btn blue" style="margin-left: 1.5%;">Update Blog</button>
                                        <button type="button" class="btn default" onclick="window.location.href='blog.php';">Cancel</button>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 style="padding:5px 0px;font-weight: 500;">SEO Details</h3>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input class="form-control" type="text" name="slug" value="<?= htmlspecialchars($blog['slug']) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input class="form-control" type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input class="form-control" type="text" name="author" value="<?= htmlspecialchars($blog['author']) ?>">
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
    <script>
        $(document).ready(function() {
            $("input[name='brand_name']").on("input", function() {
                var brandName = $(this).val();
                var slug = brandName.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $("input[name='slug']").val(slug);
            });
        });
    </script>
</body>

</html>