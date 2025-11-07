<?php
require_once 'config/db.php';

$message = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT fullname FROM students WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $student = $stmt->fetch();

    if (!$student) {
        die("<p style='color:red; text-align:center;'>Student not found!</p>");
    }

    if (isset($_POST['confirm'])) {
        try {
            $deleteStmt = $conn->prepare("DELETE FROM students WHERE id = :id");
            $deleteStmt->execute([':id' => $id]);

            header("Location: read.php?deleted=true");
            exit;
        } catch (PDOException $e) {
            $message = "<p class='error'>Error deleting student: " . $e->getMessage() . "</p>";
        }
    }
} else {
    die("<p style='color:red; text-align:center;'>Invalid student ID!</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        h2 {
            color: #d32f2f;
        }
        p {
            color: #555;
        }
        .warning {
            color: #d32f2f;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
        }
        .confirm {
            background: #d32f2f;
        }
        .cancel {
            background: #757575;
        }
        .confirm:hover { background: #b71c1c; }
        .cancel:hover { background: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete <strong><?= htmlspecialchars($student['fullname']); ?></strong>?</p>
        <p class="warning">This action cannot be undone!</p>

        <form method="POST">
            <button type="submit" name="confirm" class="btn confirm">Yes, Delete</button>
            <a href="read.php" class="btn cancel">Cancel</a>
        </form>

        <?= $message ?>
    </div>
</body>
</html>
