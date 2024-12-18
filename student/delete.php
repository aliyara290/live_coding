<?php
include "../config/db.php";
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM student WHERE student_id=$id";
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
        <a href="/live_coding/src/list.php" class="text-white font-medium hover:underline">View Students</a>
        <a href="/live_coding/src/add.php" class="text-white font-medium hover:underline">Add Student</a>
    </nav>
</header>

<div class="pt-16 px-6">
    <h1 class="pb-10 text-lg font-bold">Delete Student</h1>
    <form action="delete.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <h1 class="text-lg font-medium mb-6">Are you sure you want to delete this data?</h1>
        <button type="submit" class="py-3 px-10 bg-red-700 rounded-medium text-white font-medium mr-3">Delete</button>
        <a href="/live_coding/src/list.php" class="py-3 px-10 bg-green-700 rounded-medium text-white font-medium">Cancel</a>
    </form>
</div>
</body>
</html>
