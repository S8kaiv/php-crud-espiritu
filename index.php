<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Branch Directory System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            color: #333;
            text-align: center;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
            width: 420px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        a {
            display: block;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            background: #0056b3;
            transform: scale(1.03);
        }

        footer {
            margin-top: 30px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Branch Directory System</h1>

    <div class="nav">
        <a href="create.php">Add Student</a>
        <a href="read.php">View Students</a>
        <a href="read.php">Update Student</a>
        <a href="read.php">Delete Student</a>
    </div>

    <footer>
        <p>CRUD System Project — PHP & MySQL</p>
    </footer>
</div>

</body>
</html>
