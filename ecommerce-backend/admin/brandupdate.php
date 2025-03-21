<?php
include('../connection.php'); // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing brand details
    $stmt = $conn->prepare("SELECT * FROM brand WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $brand = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$brand) {
        echo "<script>alert('Brand not found'); window.location.href='brand_list.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='brand_list.php';</script>";
    exit();
}

if (isset($_POST['update'])) {
    // Get updated form data
    $brand_name = $_POST['brand_name'];
    $priority = $_POST['priority'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $description = $_POST['discription'];
    $keyword = $_POST['keyword'];
    $author = $_POST['author'];

    try {
        // Check if a new image is uploaded
        if (!empty($_FILES["image"]["name"])) {
            $target_dir = "../pages/uploads/brand/";
            $new_image_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $new_image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allowed image types
            $allowed_types = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowed_types)) {
                echo "<script>alert('Invalid image format. Allowed: JPG, JPEG, PNG, GIF');</script>";
                exit();
            }

            // Delete old image if it exists
            if (!empty($brand['image']) && file_exists($target_dir . $brand['image'])) {
                unlink($target_dir . $brand['image']);
            }

            // Move new uploaded image
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_to_save = $new_image_name;
            } else {
                echo "<script>alert('Error uploading new image');</script>";
                exit();
            }
        } else {
            // Keep the old image if no new image is uploaded
            $image_to_save = $brand['image'];
        }

        // Update database with new details
        $sql = "UPDATE brand SET name = :name, priority = :priority, slug = :slug, title = :title, 
                discription = :description, keyword = :keyword, author = :author, image = :image WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $brand_name);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':keyword', $keyword);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':image', $image_to_save);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Brand updated successfully!'); window.location.href='brandlist.php';</script>";
        } else {
            echo "<script>alert('Error updating brand');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
    }
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
                        <h1>Update Brand Details
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
                                        <h3 style="padding:5px 0px;font-weight: 500;">Brand Details</h3>

                                        <div class="form-group">
                                            <label for="brand_name">Brand Name</label>
                                            <input class="form-control" type="text" name="brand_name" value="<?= $brand['name'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="priority">Priority</label>
                                            <input class="form-control" type="text" name="priority" value="<?= $brand['priority'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Current Image</label><br>
                                            <img src="../pages/uploads/brand/<?= $brand['image'] ?>" alt="Brand Image" style="width: 100px; height: auto;"><br><br>
                                            <label for="image">Upload New Image</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <h3 style="padding:5px 0px;font-weight: 500;">SEO Details</h3>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input class="form-control" type="text" name="slug" value="<?= $brand['slug'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input class="form-control" type="text" name="title" value="<?= $brand['title'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="discription">Description</label>
                                            <textarea class="form-control" name="discription"><?= $brand['discription'] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="keyword">Keyword</label>
                                            <textarea class="form-control" name="keyword"><?= $brand['keyword'] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input class="form-control" type="text" name="author" value="<?= $brand['author'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" name="update" class="btn blue" style="margin-left: 1.5%;">Update Brand</button>
                                        <button type="button" class="btn default" onclick="window.location.href='brandlist.php';">Cancel</button>
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