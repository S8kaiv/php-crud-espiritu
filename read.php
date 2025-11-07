<?php
require_once 'config/db.php'; // include your PDO connection file

try {
    $stmt = $conn->query("SELECT * FROM students ORDER BY id DESC");
    $students = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 40px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        th {
            background: #007bffff;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        a.btn {
            text-decoration: none;
            color: white;
            background: #007bffff;
            padding: 6px 10px;
            border-radius: 4px;
            margin: 2px;
        }
        .delete {
            background: #f44336;
        }
        .top-links {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h1>Student Directory</h1>

<div class="top-links">
    <a href="create.php" class="btn">Add New Student</a>
    <a href="index.php" class="btn">Home</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student No</th>
            <th>Full Name</th>
            <th>Branch</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($students): ?>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['student_no']) ?></td>
                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                    <td><?= htmlspecialchars($row['branch']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td><?= htmlspecialchars($row['date_added']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn delete">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8" style="text-align:center;">No records found</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
