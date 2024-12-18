<?php
include "../config/db.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST["u-firstName"];
    $last_name = $_POST["u-lastName"];
    $age = $_POST["u-age"];
    $grade = $_POST["u-grade"];
    $id = $_POST['id'];

    $sql = "UPDATE student SET first_name='$first_name', last_name='$last_name', age='$age', grade='$grade' WHERE student_id=$id";
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
    <title>Update Student</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body>
<header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-2xl text-white font-bold">Student Management</h1>
        <nav class="flex gap-6">
            <a href="/student_management/student/students.php" class="text-white font-medium hover:underline">View Students</a>
            <a href="/student_management/student/create.php" class="text-white font-medium hover:underline">Add Student</a>
        </nav>
    </header>

    <div class="pt-16 px-6 ">
        <h1 class="pb-10 text-lg font-bold">Update Student</h1>
        <form action="update.php" method="POST" class="w-4xl mx-auto">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <label for="firstName" class="block font-medium">First Name:</label>
            <input type="text" name="u-firstName" placeholder="Enter first name" value="<?php echo $row['first_name']; ?>"  required
                class="w-full p-2 mb-4 border border-gray-300">

            <label for="lastName" class="block font-medium">Last Name:</label>
            <input type="text" name="u-lastName" placeholder="Enter last name" required
                class="w-full p-2 mb-4 border border-gray-300">

            <label for="age" class="block font-medium">Age:</label>
            <input type="number" name="u-age" placeholder="Enter age" required
                class="w-full p-2 mb-4 border border-gray-300">

            <label for="grade" class="block font-medium">Grade:</label>
            <input type="text" name="u-grade" placeholder="Enter grade (e.g., A, B+)" required
                class="w-full p-2 mb-4 border border-gray-300">

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update Student</button>
        </form>
    </div>
</body>

</html>