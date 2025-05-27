<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $voter_id = uniqid();
    $conn->query("INSERT INTO voters (name, voter_id) VALUES ('$name', '$voter_id')");
}

header("Location: dashboard.php");
exit();
?>

<form method="POST">
    <input type="text" name="name" placeholder="Voter Name" required>
    <button type="submit">Add Voter</button>
</form>
