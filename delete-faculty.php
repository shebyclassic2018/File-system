<?php
require "backend/fs.php";
$fac_id = $_GET['id'];

$delete = $conn->query("DELETE FROM faculty WHERE id = '$fac_id'");

if ($delete) {
    $_SESSION['success'] = "Faculty deleted";
} else {
    $_SESSION['danger'] = "Faculty not deleted";
}

header("location: dashboard.php");