<?php
include "../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            color: black;
        }

        th {
            background-color: #1e2532;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Student Management</h1>
        <nav class="flex gap-6">
            <a href="/live_coding/src/list.php" class="text-white font-medium hover:underline">View Students</a>
            <a href="/live_coding/src/add.php" class="text-white font-medium hover:underline">Add Student</a>
        </nav>
    </header>
    <div class="pt-16">
        <h1 class="pb-10 text-lg font-bold text-center">Add New Student</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Grade</th>
                    <th>Management</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM student";

                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['student_id'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['grade'] ?></td>
                        <td class='text-left py-3 px-4 flex justify-center gap-3'>
                            <span><a
                                    href='/student_management/student/update.php?id=<?= $row['student_id'] ?>?first_name=<?= $row['first_name'] ?>?last_name=<?= $row['last_name'] ?>?age=<?= $row['age'] ?>?grade=<?= $row['grade'] ?>'><i
                                        class='fa-solid fa-pen-to-square cursor-pointer text-green-600'></i></a></span>
                            <span><a href='/student_management/student/delete.php?id=<?= $row['student_id'] ?>'><i
                                        class='fa-solid fa-trash-can cursor-pointer text-red-600'></i></a></span>
                        </td>
                    </tr>
                    <?php
                endwhile;
                $conn->close();

                ?>


            </tbody>
        </table>

    </div>

</body>

</html>