<?php
require_once "../classes/User.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    
    $user = new User();
    if($user->register($username, $password, $role)){
        header("Location: login.php");
        exit;
    } else {
        $error = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Register</h2>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Role:</label>
        <input type="text" name="role" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
