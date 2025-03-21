<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New City</title>
</head>

<body>
    <h2>Add New City</h2>
    <form action="save_city.php" method="post">
        <label for="state_id">Select State:</label>
        <select name="state_id" required>
            <option value="">Select State</option>
            <?php
            $sql = "SELECT * FROM states";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['state_name'] . "</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="city_name">City Name:</label>
        <input type="text" name="city_name" required>
        <br><br>

        <button type="submit">Add City</button>
    </form>
</body>

</html>