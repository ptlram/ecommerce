<?php
include 'db.php';

if (isset($_GET["id"])) {
    $student_id = $_GET["id"];

    try {
        // Fetch the student record including profile and assignment images
        $sql = "SELECT profile_pic, assignments FROM students WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $student_id, PDO::PARAM_INT);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            // Delete the profile picture file
            if (file_exists($student["profile_pic"])) {
                unlink($student["profile_pic"]);
            }

            // Delete assignment images if they exist
            $assignments = explode(",", $student["assignments"]);
            foreach ($assignments as $assignment) {
                if (file_exists($assignment)) {
                    unlink($assignment);  // Remove assignment image from the folder
                }
            }

            // Now delete the student record from the database
            $sql = "DELETE FROM students WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $student_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "Student and associated images deleted successfully!";
                header("Location: ../admin/studentlist.php");
                exit();
            } else {
                echo "Failed to delete student.";
            }
        } else {
            echo "Student not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
