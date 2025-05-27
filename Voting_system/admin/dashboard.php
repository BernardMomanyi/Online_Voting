<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

include("../db.php");

$candidates = $conn->query("SELECT * FROM candidates");
$voters = $conn->query("SELECT * FROM voters");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>

<h2>Admin Dashboard</h2>

<h3>Candidates</h3>
<table>
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

<h3>Voters</h3>
<table>
    <tr>
        <th>Voter Name</th>
        <th>Voter ID</th>
        <th>Voted</th>
    </tr>
    <?php while ($row = $voters->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['voter_id'] ?></td>
            <td><?= $row['has_voted'] ? "Yes" : "No" ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Admin Actions</h3>
<a href="candidates.php">Manage Candidates</a>
<a href="voters.php">Manage Voters</a>
<a href="results.php">View Results</a>
<a href="logout.php">Logout</a>

</body>
</html>
