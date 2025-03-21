<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Student Data</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Upload Student Data</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" required><br><br>

        <label for="state">State:</label>
        <select id="state" name="state" required>
            <option value="">Select State</option>
        </select><br><br>

        <label for="city">City:</label>
        <select id="city" name="city" required>
            <option value="">Select City</option>
        </select><br><br>

        <label for="profile_pic">Profile Picture:</label>
        <input type="file" name="profile_pic" accept="image/*"><br><br>

        <label for="assignments">Assignments (multiple images):</label>
        <input type="file" name="assignments[]" accept="image/*" multiple><br><br>

        <button type="submit" name="submit">Upload</button>
    </form>

    <script>
        $(document).ready(function() {
            // Fetch States
            $.ajax({
                url: "fetch_states.php",
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
                        url: "fetch_cities.php",
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
</body>

</html>