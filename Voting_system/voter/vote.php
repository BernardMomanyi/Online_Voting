<?php
session_start();
if (!isset($_SESSION["voter_id"])) {
    header("Location: login.php");
    exit();
}

include("../db.php");

$voter_id = $_SESSION["voter_id"];
$voter_check = $conn->query("SELECT has_voted FROM voters WHERE voter_id = '$voter_id'")->fetch_assoc();

if ($voter_check["has_voted"]) {
    echo "<h3>You have already voted!</h3>";
    echo "<a href='logout.php'>Logout</a>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate_id = $_POST["candidate"];
    
    // Update vote count
    $conn->query("UPDATE candidates SET votes = votes + 1 WHERE id = '$candidate_id'");
    
    // Mark voter as voted
    $conn->query("UPDATE voters SET has_voted = 1 WHERE voter_id = '$voter_id'");
    
    echo "<h3>Thank you for voting!</h3>";
    echo "<a href='logout.php'>Logout</a>";
    exit();
}

$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Vote for Your Candidate</h2>
    <form method="post">
        <?php while ($row = $candidates->fetch_assoc()): ?>
            <input type="radio" name="candidate" value="<?= $row['id'] ?>" required> <?= $row['name'] ?><br>
        <?php endwhile; ?>
        <button type="submit">Submit Vote</button>
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
