<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voter_id = $_POST["voter_id"];
    $query = $conn->prepare("SELECT * FROM voters WHERE voter_id = ?");
    $query->bind_param("s", $voter_id);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows == 1) {
        $_SESSION["voter_id"] = $voter_id;
        header("Location: vote.php");
        exit();
    } else {
        $error = "Invalid Voter ID!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Login</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Voter Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <label>Voter ID:</label>
        <input type="text" name="voter_id" required>
        <button type="submit">Login</button>
    </form>
    <a href="../index.php">Back to Home</a>
</body>
</html>
