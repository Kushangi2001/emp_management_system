<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "../classes/Employee.php";

$id = $_GET["id"];
$employee = new Employee();
$employeeDetails = $employee->viewEmployeeById($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employee</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Employee Details</h2>
    <p>Name: <?php echo $employeeDetails['name']; ?></p>
    <p>Department: <?php echo $employeeDetails['department']; ?></p>
    <p>Role: <?php echo $employeeDetails['role']; ?></p>
    <p>Contact: <?php echo $employeeDetails['contact']; ?></p>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
