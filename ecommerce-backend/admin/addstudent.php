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
                                <form action="../pages/upload.php" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input class="form-control" type="text" name="name" placeholder="Enter Student Name" required>
                                            <label for="form_control_1">Regular input</label>
                                            <span class="help-block">Some help goes here...</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Student Age</label>
                                            <input class="form-control spinner" type="number" name="age" placeholder="Enter Student Age" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select class="form-control" id="state" name="state" required>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select class="form-control" id="city" name="city" required>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>

                                        <!-- Gender Selection -->
                                        <div class="form-group">
                                            <label>Gender</label><br>
                                            <label><input type="radio" name="gender" value="male" required> Male</label>
                                            <label><input type="radio" name="gender" value="female"> Female</label>
                                            <label><input type="radio" name="gender" value="other"> Other</label>
                                        </div>

                                        <div class="form-group">
                                            <label for="profile_pic">Profile Picture</label>
                                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*">
                                        </div>

                                        <div class="form-group">
                                            <label for="assignments">Assignment Images (multiple allowed)</label>
                                            <input type="file" class="form-control" id="assignments" name="assignments[]" accept="image/*" multiple>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Select Hobbies</label>
                                            <select multiple class="form-control" name="hobbies[]">
                                                <option value="reading">Reading</option>
                                                <option value="sports">Sports</option>
                                                <option value="music">Music</option>
                                                <option value="traveling">Traveling</option>
                                                <option value="gaming">Gaming</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" name="submit" class="btn blue">Add Student</button>
                                        <button class="btn btn-success"><a href="studentlist.php" style="text-decoration: none;color:white">Cancel</a></button>

                                    </div>
                                </form>


                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <i class="icon-check font-red-sunglo"></i>
                                            <span class="caption-subject bold uppercase"> Checkboxes</span>
                                        </div>
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn btn-sm red dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Settings
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-ban"></i> Ban </a>
                                                    </li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;"> Make admin </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-group form-md-checkboxes">
                                                <label>Checkboxes</label>
                                                <div class="md-checkbox-list">
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox1" class="md-check">
                                                        <label for="checkbox1">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 1 </label>
                                                    </div>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox2" class="md-check" checked>
                                                        <label for="checkbox2">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 2 </label>
                                                    </div>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox3" class="md-check">
                                                        <label for="checkbox3">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 3 </label>
                                                    </div>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox4" disabled class="md-check">
                                                        <label for="checkbox4">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Disabled </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-checkboxes">
                                                <label>Inline Checkboxes</label>
                                                <div class="md-checkbox-inline">
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox6" class="md-check">
                                                        <label for="checkbox6">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 1 </label>
                                                    </div>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox7" class="md-check" checked>
                                                        <label for="checkbox7">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 2 </label>
                                                    </div>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox8" class="md-check">
                                                        <label for="checkbox8">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 3 </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-checkboxes">
                                                <label>Checkboxes</label>
                                                <div class="md-checkbox-list">
                                                    <div class="md-checkbox has-success">
                                                        <input type="checkbox" id="checkbox9" class="md-check">
                                                        <label for="checkbox9">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 1 </label>
                                                    </div>
                                                    <div class="md-checkbox has-error">
                                                        <input type="checkbox" id="checkbox10" class="md-check" checked>
                                                        <label for="checkbox10">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 2 </label>
                                                    </div>
                                                    <div class="md-checkbox has-warning">
                                                        <input type="checkbox" id="checkbox11" class="md-check">
                                                        <label for="checkbox11">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 3 </label>
                                                    </div>
                                                    <div class="md-checkbox has-info">
                                                        <input type="checkbox" id="checkbox12" disabled class="md-check">
                                                        <label for="checkbox12">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Disabled </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-checkboxes">
                                                <label>Inline Checkboxes</label>
                                                <div class="md-checkbox-inline">
                                                    <div class="md-checkbox has-success">
                                                        <input type="checkbox" id="checkbox14" class="md-check">
                                                        <label for="checkbox14">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 1 </label>
                                                    </div>
                                                    <div class="md-checkbox has-error">
                                                        <input type="checkbox" id="checkbox15" class="md-check" checked>
                                                        <label for="checkbox15">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 2 </label>
                                                    </div>
                                                    <div class="md-checkbox has-info">
                                                        <input type="checkbox" id="checkbox16" class="md-check">
                                                        <label for="checkbox16">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Option 3 </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


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
            // Fetch States
            $.ajax({
                url: "../pages/fetch_states.php",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, state) {
                        $("#state").append("<option value='" + state.id + "'>" + state.state_name + "</option>");
                    });
                }
            });

            // Fetch Cities based on Selected State
            $("#state").change(function() {
                var stateId = $(this).val();
                $("#city").html("<option value=''>Select City</option>"); // Reset city dropdown

                if (stateId) {
                    $.ajax({
                        url: "../pages/fetch_cities.php",
                        method: "POST",
                        data: {
                            state_id: stateId
                        },
                        dataType: "json",
                        success: function(data) {
                            $.each(data, function(index, city) {
                                $("#city").append("<option value='" + city.id + "'>" + city.city_name + "</option>");
                            });
                        }
                    });
                }
            });
        });
    </script>
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>