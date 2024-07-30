<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "../classes/Employee.php";

$criteria = $_GET["search"];
$employee = new Employee();
$searchResults = $employee->searchEmployees($criteria);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Search Results</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <h3>Employees matching "<?php echo $criteria; ?>"</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Role</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($searchResults)): ?>
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
