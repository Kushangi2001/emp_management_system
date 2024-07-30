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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $department = $_POST["department"];
    $role = $_POST["role"];
    $contact = $_POST["contact"];
    
    if($employee->editEmployee($id, $name, $department, $role, $contact)){
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Failed to edit employee.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Edit Employee</h2>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $employeeDetails['name']; ?>" required>
        <label>Department:</label>
        <input type="text" name="department" value="<?php echo $employeeDetails['department']; ?>" required>
        <label>Role:</label>
        <input type="text" name="role" value="<?php echo $employeeDetails['role']; ?>" required>
        <label>Contact:</label>
        <input type="text" name="contact" value="<?php echo $employeeDetails['contact']; ?>" required>
        <button type="submit">Edit</button>
    </form>
</body>
</html>
