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
                        <h1>Add New Sub Category
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
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="col-md-6">
                                            <h3 style="padding:5px 0px;font-weight: 500;">Subcategory Details</h3>

                                            <div class="form-group">
                                                <label for="subcategory_name">Name</label>
                                                <input class="form-control" type="text" name="subcategory_name" placeholder="Sub Category Title" required>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Select Category</label>
                                                <div class="col-md-4">
                                                    <select class="bs-select form-control" data-live-search="true" name="category_id" data-size="8">
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        // include '../pages/db.php'; // Database connection
                                                        // $sql = "SELECT * FROM category";
                                                        // $stmt = $pdo->query($sql);
                                                        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        //     echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                        // }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <br> -->

                                            <!-- <div class="form-group">
                                                <label for="category_id">Select Category</label>
                                                <select class="form-control" name="category_id" required>
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    // include '../pages/db.php'; // Database connection
                                                    // $sql = "SELECT * FROM category";
                                                    // $stmt = $pdo->query($sql);
                                                    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    //     echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                    // }
                                                    ?>
                                                </select>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="category_id" class="control-label col-md-3" style="padding-left: 0;">Select Category :</label>
                                                <div class="col-md-9.5">
                                                    <select class="bs-select form-control" data-live-search="true" name="category_id" data-size="8">
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
                                                <label for="priority">Priority</label>
                                                <input class="form-control" type="text" name="priority" placeholder="Enter Priority" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="discription">Description</label>
                                                <textarea class="form-control" name="discription" placeholder="Description"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" class="form-control" name="image" accept="image/*" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                    </div>

                                    <div class="form-actions">
                                        <button style="margin-left: 1.5%;" type="submit" name="submit" class="btn blue">Add Subcategory</button>
                                        <button class="btn btn-success"><a href="sub_categorylist.php" style="text-decoration: none;color:white">Cancel</a></button>

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
    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>

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
            $("input[name='subcategory_name']").on("input", function() {
                var brandName = $(this).val();
                var slug = brandName.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $("input[name='slug']").val(slug);
            });
        });
    </script>
    <!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>

<?php
include '../pages/db.php'; // Ensure database connection

if (isset($_POST['submit'])) {
    try {
        // Get form data
        $subcategory_name = $_POST['subcategory_name'];
        $category_id = $_POST['category_id'];
        $priority = $_POST['priority'];
        $description = $_POST['discription'];
        $slug = $_POST['slug'];
        $title = $_POST['title'];
        $keyword = $_POST['keyword'];
        $author = $_POST['author'];

        // Handle Image Upload
        $target_dir = "../pages/uploads/subcategory/"; // Change to your image storage folder
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        // Validate image format
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Invalid image format. Allowed: JPG, JPEG, PNG, GIF');</script>";
        } else {
            // Move uploaded file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert into database
                $sql = "INSERT INTO subcategory (name, category_id, priority, description, image, slug, title, keyword, author) 
                        VALUES (:name, :category_id, :priority, :description, :image, :slug, :title, :keyword, :author)";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $subcategory_name);
                $stmt->bindParam(':category_id', $category_id);
                $stmt->bindParam(':priority', $priority);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image', $image_name);
                $stmt->bindParam(':slug', $slug);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':keyword', $keyword);
                $stmt->bindParam(':author', $author);

                if ($stmt->execute()) {
                    echo "<script>alert('Subcategory added successfully!'); window.location.href='sub_categorylist.php';</script>";
                } else {
                    echo "<script>alert('Error adding subcategory');</script>";
                }
            } else {
                echo "<script>alert('Error uploading image');</script>";
            }
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
    }
}
?>