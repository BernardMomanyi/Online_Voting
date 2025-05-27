<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

include("../db.php");

$candidates = $conn->query("SELECT * FROM candidates");
?>

<h2>Election Results</h2>

<table border="1">
    <tr>
        <th>Candidate Name</th>
        <th>Total Votes</th>
    </tr>
    <?php while ($row = $candidates->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['votes'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<a href="dashboard.php">Back to Dashboard</a>
<a href="logout.php">Logout</a>
