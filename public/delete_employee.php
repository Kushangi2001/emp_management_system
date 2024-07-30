<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "../classes/Employee.php";

$id = $_GET["id"];
$employee = new Employee();
if($employee->deleteEmployee($id)){
    header("Location: dashboard.php");
    exit;
} else {
    echo "Failed to delete employee.";
}
?>
