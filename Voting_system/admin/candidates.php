<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $conn->query("INSERT INTO candidates (name) VALUES ('$name')");
}

header("Location: dashboard.php");
exit();
?>

<form method="POST">
    <input type="text" name="name" placeholder="Candidate Name" required>
    <button type="submit">Add Candidate</button>
</form>
