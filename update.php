<?php
require 'config/db.php';

if (!isset($_GET['id'])) {
    die("Error: Student ID not provided.");
}

$id = $_GET['id'];
$message = "";

try {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        die("Error: Student not found.");
    }
} catch (PDOException $e) {
    die("Error fetching student: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_no = $_POST['student_no'];
    $fullname = $_POST['fullname'];
    $branch = $_POST['branch'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    try {
        $sql = "UPDATE students 
                SET student_no = :student_no, fullname = :fullname, branch = :branch, 
                    email = :email, contact = :contact 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':student_no' => $student_no,
            ':fullname' => $fullname,
            ':branch' => $branch,
            ':email' => $email,
            ':contact' => $contact,
            ':id' => $id
        ]);

        $message = "<p class='success message'>Student record updated successfully!</p>";

        // Redirect after 2 seconds
        header("refresh:2;url=read.php");
    } catch (PDOException $e) {
        $message = "<p class='error message'>Error updating student: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
        }
        select {
            background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 30px;
        }
        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #007bffff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0161c7ff;
        }
        .success { color: green; text-align: center; font-weight: bold; }
        .error { color: red; text-align: center; font-weight: bold; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
        }
        .back-link:hover {
            text-decoration: underline;
        }

        .message {
            transition: opacity 0.5s ease;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Student</h2>
    <?= $message; ?>

    <form method="POST" action="">
        <label>Student Number:</label>
        <input type="text" name="student_no" value="<?= htmlspecialchars($student['student_no']); ?>" required>

        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($student['fullname']); ?>" required>

        <label>Branch:</label>
        <select name="branch" required>
            <option value="">-- Select Branch --</option>
            <option value="Quezon City" <?= $student['branch'] === 'Quezon City' ? 'selected' : ''; ?>>Quezon City</option>
            <option value="Antipolo" <?= $student['branch'] === 'Antipolo' ? 'selected' : ''; ?>>Antipolo</option>
            <option value="Guimba" <?= $student['branch'] === 'Guimba' ? 'selected' : ''; ?>>Guimba</option>
        </select>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" required>

        <label>Contact:</label>
        <input type="text" name="contact" value="<?= htmlspecialchars($student['contact']); ?>">

        <button type="submit">Update Student</button>
    </form>

    <a href="read.php" class="back-link">← Back to Student List</a>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const msg = document.querySelector(".message");
    if (msg) {
        setTimeout(() => {
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    }
});
</script>

</body>
</html>
