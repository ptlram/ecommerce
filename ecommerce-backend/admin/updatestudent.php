<?php
include '../pages/db.php';

if (!isset($_GET['id'])) {
    die("Student ID not provided.");
}

$id = (int)$_GET['id'];

// Fetch student data
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found.");
}

// Fetch all states
$states = $pdo->query("SELECT * FROM states")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $age = (int)$_POST["age"];
    $state_id = (int)$_POST["state"];
    $city_id = (int)$_POST["city"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : $student["gender"];
    $uploadDir = "../pages/uploads/";

    $hobby = isset($_POST["hobbies"]) ? implode(",", $_POST["hobbies"]) : $student["hobby"];

    // Profile Picture
    $profilePicPath = $student["profile_pic"];
    if (!empty($_FILES["profile_pic"]["name"])) {
        $profilePicName = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $profilePicPath = $uploadDir . $profilePicName;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profilePicPath)) {
            if (!empty($student["profile_pic"]) && file_exists("../pages/" . $student["profile_pic"])) {
                unlink("../pages/" . $student["profile_pic"]);
            }
        }
    }

    // Handle Assignment Deletion
    $assignmentPaths = explode(",", $student["assignments"]);
    if (!empty($_POST["delete_assignments"])) {
        foreach ($_POST["delete_assignments"] as $deletePic) {
            $deletePath = "../pages/" . $deletePic;
            if (in_array($deletePic, $assignmentPaths) && file_exists($deletePath)) {
                unlink($deletePath);
                $assignmentPaths = array_diff($assignmentPaths, [$deletePic]);
            }
        }
    }

    // Upload New Assignments
    if (!empty($_FILES["assignments"]["name"][0])) {
        foreach ($_FILES["assignments"]["tmp_name"] as $key => $tmp_name) {
            $assignmentFileName = time() . "_" . basename($_FILES["assignments"]["name"][$key]);
            $assignmentPath = $uploadDir . $assignmentFileName;

            if (move_uploaded_file($tmp_name, $assignmentPath)) {
                $assignmentPaths[] = $assignmentPath;
            }
        }
    }

    $assignments = implode(",", $assignmentPaths);

    $sql = "UPDATE students 
            SET name = ?, email = ?, age = ?, state_id = ?, city_id = ?, profile_pic = ?, assignments = ?, hobby = ?, gender = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $age, $state_id, $city_id, $profilePicPath, $assignments, $hobby, $gender, $id]);

    header("Location: ../admin/studentlist.php");
    exit();
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
                        <h1>Add New Student
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-6 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <form action="" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="name">Student Name</label>
                                            <input class="form-control spinner" type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Student Age</label>
                                            <input class="form-control spinner" type="number" name="age" value="<?= htmlspecialchars($student['age']) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select class="form-control" id="state" name="state" required>
                                                <option value="">Select State</option>
                                                <?php foreach ($states as $state): ?>
                                                    <option value="<?= $state['id'] ?>" <?= $student['state_id'] == $state['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($state['state_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select class="form-control" id="city" name="city" required>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>

                                        <!-- Gender Field -->
                                        <div class="form-group">
                                            <label>Gender</label><br>
                                            <label><input type="radio" name="gender" value="male" <?= $student['gender'] == 'male' ? 'checked' : '' ?>> Male</label>
                                            <label><input type="radio" name="gender" value="female" <?= $student['gender'] == 'female' ? 'checked' : '' ?>> Female</label>
                                            <label><input type="radio" name="gender" value="other" <?= $student['gender'] == 'other' ? 'checked' : '' ?>> Other</label>
                                        </div>

                                        <!-- Hobbies Field -->
                                        <div class="form-group">
                                            <label>Select Hobbies</label>
                                            <?php
                                            $selectedHobbies = explode(",", $student["hobby"]);
                                            $hobbiesList = ["Reading", "Sports", "Music", "Traveling", "Gaming"];
                                            ?>
                                            <select multiple class="form-control" name="hobbies[]">
                                                <?php foreach ($hobbiesList as $hobby): ?>
                                                    <option value="<?= strtolower($hobby) ?>" <?= in_array(strtolower($hobby), $selectedHobbies) ? 'selected' : '' ?>>
                                                        <?= $hobby ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="profile_pic">Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_pic" accept="image/*">
                                            <br>
                                            <img src="../pages/<?= htmlspecialchars($student['profile_pic']) ?>" width="50" height="50" alt="Current Profile">
                                        </div>

                                        <!-- Assignments with Delete Checkboxes -->
                                        <div class="form-group">
                                            <label for="assignments">Assignment Images (multiple allowed)</label>
                                            <input type="file" class="form-control" name="assignments[]" accept="image/*" multiple>
                                            <br>
                                            <?php
                                            $assignmentPics = explode(",", $student["assignments"]);
                                            foreach ($assignmentPics as $index => $pic) {
                                                echo "<div style='display: inline-block; margin-right: 10px;'>
                        <img src='../pages/$pic' width='50' height='50' alt='Assignment'>
                        <br>
                        <label><input type='checkbox' name='delete_assignments[]' value='$pic'> Delete</label>
                      </div>";
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" name="submit" class="btn blue">Update Student</button>
                                        <button class="btn btn-success"><a href="studentlist.php" style="text-decoration: none;color:white">Cancel</a></button>

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
    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            function loadCities(state_id, selected_city_id = null) {
                if (state_id) {
                    $.ajax({
                        url: "../pages/get_cities.php",
                        type: "POST",
                        data: {
                            state_id: state_id
                        },
                        success: function(data) {
                            $("#city").html(data);
                            if (selected_city_id) {
                                $("#city").val(selected_city_id);
                            }
                        }
                    });
                } else {
                    $("#city").html('<option value="">Select City</option>');
                }
            }

            // Load cities when the page loads if a state is already selected
            let selectedState = $("#state").val();
            let selectedCity = <?= json_encode($student["city_id"]) ?>;
            if (selectedState) {
                loadCities(selectedState, selectedCity);
            }

            // Load cities when state selection changes
            $("#state").change(function() {
                loadCities($(this).val());
            });
        });
    </script>
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>