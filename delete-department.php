<?php
require "backend/fs.php";
$dep_id = $_GET['id'];

$delete = $conn->query("DELETE FROM department WHERE id = '$dep_id'");

if ($delete) {
    $_SESSION['success'] = "Department deleted";
} else {
    $_SESSION['danger'] = "Department not deleted";
}

header("location: department.php");