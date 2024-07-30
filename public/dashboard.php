<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "../classes/Employee.php";
$employee = new Employee();
$employees = $employee->viewEmployees();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION["username"]; ?></p>
    <a href="logout.php">Logout</a>
    <a href="add_employee.php">Add Employee</a>
    <form method="get" action="search_employee.php">
        <input type="text" name="search" placeholder="Search employees...">
        <button type="submit">Search</button>
    </form>
    <h3>Employee List</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Role</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($employees)): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td>
                <a href="edit_employee.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_employee.php?id=<?php echo $row['id']; ?>">Delete</a>
                <a href="view_employee.php?id=<?php echo $row['id']; ?>">View</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
