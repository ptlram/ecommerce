<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $age = (int)$_POST["age"];
    $state_id = (int)$_POST["state"];
    $city_id = (int)$_POST["city"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : ""; // Capture gender
    $hobbies = isset($_POST["hobbies"]) ? implode(",", $_POST["hobbies"]) : ""; // Convert array to string
    $uploadDir = "uploads/";

    // Variables for storing the file paths
    $profilePicPath = "";
    $assignmentPaths = [];

    // Process the profile picture
    if (!empty($_FILES["profile_pic"]["name"])) {
        $profilePicName = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $profilePicPath = $uploadDir . $profilePicName;
        $profilePicType = strtolower(pathinfo($profilePicPath, PATHINFO_EXTENSION));

        if (in_array($profilePicType, ["jpg", "jpeg", "png", "gif"]) && $_FILES["profile_pic"]["size"] <= 5000000) {
            if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profilePicPath)) {
                echo "Error uploading profile picture.";
                exit();
            }
        } else {
            echo "Invalid profile picture format or size exceeds 5MB.";
            exit();
        }
    }

    // Process the assignments (multiple images)
    if (!empty($_FILES["assignments"]["name"][0])) {
        $totalFiles = count($_FILES["assignments"]["name"]);

        for ($i = 0; $i < $totalFiles; $i++) {
            $assignmentFileName = time() . "_" . basename($_FILES["assignments"]["name"][$i]);
            $assignmentFilePath = $uploadDir . $assignmentFileName;
            $assignmentFileType = strtolower(pathinfo($assignmentFilePath, PATHINFO_EXTENSION));

            if (in_array($assignmentFileType, ["jpg", "jpeg", "png", "gif"]) && $_FILES["assignments"]["size"][$i] <= 5000000) {
                if (move_uploaded_file($_FILES["assignments"]["tmp_name"][$i], $assignmentFilePath)) {
                    $assignmentPaths[] = $assignmentFilePath;
                } else {
                    echo "Error uploading assignment: $assignmentFileName";
                    exit();
                }
            } else {
                echo "Invalid assignment format or size exceeds 5MB.";
                exit();
            }
        }
    }

    // Convert assignment paths array to a comma-separated string
    $assignmentPathsString = implode(",", $assignmentPaths);

    // Insert data into the database
    if (!empty($name) && !empty($email) && !empty($age) && !empty($state_id) && !empty($city_id) && !empty($gender)) {
        try {
            $sql = "INSERT INTO students (name, email, age, state_id, city_id, profile_pic, assignments, hobby, gender) 
                    VALUES (:name, :email, :age, :state_id, :city_id, :profile_pic, :assignments, :hobbies, :gender)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":age", $age, PDO::PARAM_INT);
            $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
            $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
            $stmt->bindParam(":profile_pic", $profilePicPath);
            $stmt->bindParam(":assignments", $assignmentPathsString);
            $stmt->bindParam(":hobbies", $hobbies);
            $stmt->bindParam(":gender", $gender);

            if ($stmt->execute()) {
                header("Location: ../admin/addstudent.php");
                exit();
            } else {
                echo "Failed to upload student data.";
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required!";
    }
}
