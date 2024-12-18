<?php 
include "../config/db.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST["firstName"];
        $last_name = $_POST["lastName"];
        $age = $_POST["age"];
        $grade = $_POST["grade"];

        $sql = "INSERT INTO student (first_name, last_name, age, grade) VALUES ('$first_name', '$last_name', '$age', '$grade')";
        if($conn->query($sql) == true) {
            header("location:/student_management/student/students.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #1e2532;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #1e2532;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3b4a61;
        }
    </style>
</head>

<body>
<header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-2xl text-white font-bold">Student Management</h1>
        <nav class="flex gap-6">
            <a href="/student_management/student/students.php" class="text-white font-medium hover:underline">View Students</a>
            <a href="/student_management/student/create.php" class="text-white font-medium hover:underline">Add Student</a>
        </nav>
    </header>
    <div class="pt-16">

        <h1 class="pb-10 text-lg font-bold">Add New Student</h1>
        <form action="create.php" method="post" id="studentForm">
            <!-- <label for="studentId">Student ID:</label>
            <input type="number" id="studentId" name="studentId" placeholder="Enter student ID" required> -->

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="Enter first name" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Enter last name" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" placeholder="Enter age" required>

            <label for="grade">Grade:</label>
            <input type="text" id="grade" name="grade" placeholder="Enter grade (e.g., A, B+)" required>

            <button type="submit">Add Student</button>
        </form>
    </div>
</body>

</html>