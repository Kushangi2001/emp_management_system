<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "../classes/Employee.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $department = $_POST["department"];
    $role = $_POST["role"];
    $contact = $_POST["contact"];
    
    $employee = new Employee();
    if($employee->addEmployee($name, $department, $role, $contact)){
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Failed to add employee.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Add Employee</h2>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Department:</label>
        <input type="text" name="department" required>
        <label>Role:</label>
        <input type="text" name="role" required>
        <label>Contact:</label>
        <input type="text" name="contact" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>
