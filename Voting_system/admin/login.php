<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION["admin"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid credentials!";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Admin Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
