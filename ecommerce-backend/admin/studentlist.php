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
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-globe"></i>STUDENT LIST</div>
                                <div class="tools"></div>
                            </div>
                            <div class="portlet-body">
                                <table
                                    class="table table-striped table-bordered table-hover"
                                    id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Profile_pic</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Assignments</th>
                                            <th>Hobby</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "../pages/db.php";
                                        $students = $pdo->prepare("SELECT students.id, students.name, students.email, students.age,states.state_name, cities.city_name, students.profile_pic, students.assignments,students.hobby,students.gender
                                                                    FROM students
                                                                    JOIN states ON students.state_id = states.id
                                                                    JOIN cities ON students.city_id = cities.id
                                                                    order by students.id 
                                                                    ");
                                        $students->execute();
                                        $student = $students->fetchAll();

                                        foreach ($student as $std) {
                                            echo '<tr>';
                                            echo '<td>' . $std['name'] . '</td>';
                                            echo '<td>' . $std['email'] . '</td>';
                                            echo '<td>' . $std['age'] . '</td>';
                                            echo '<td><img src="../pages/' . $std['profile_pic'] . '" width="50" height="50" alt="default"></td>';
                                            echo '<td>' . $std['state_name'] . '</td>';
                                            echo '<td>' . $std['city_name'] . '</td>';

                                            echo '<td>';
                                            $assignmentPics = explode(",", $std["assignments"]);
                                            foreach ($assignmentPics as $pic) {
                                                echo "<img src='../pages/$pic' width='50' height='50' alt='Assignment'>";
                                            }
                                            echo '</td>';
                                            echo '<td>' . $std['hobby'] . '</td>';
                                            echo '<td>' . $std['gender'] . '</td>';
                                            echo '<td style="display: flex; justify-content: center; align-items: center; gap: 15px;">
                                            <a style="color:black;padding: 10px;" href="../admin/updatestudent.php?id=' . $std["id"] . '">
                                                <span style="font-size: 1.5em;" class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <a style="padding: 10px;" href="../pages/delete_student.php?id=' . $std["id"] . '" 
                                               onclick="return confirm(\'Are you sure you want to delete this student and all associated images?\');">
                                                <span style="font-size: 1.5em;" class="glyphicon glyphicon-trash"></span>
                                            </a>
                                          </td>';

                                            echo '</tr>';
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
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