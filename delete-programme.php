<?php
require "backend/fs.php";
$prog_id = $_GET['id'];

$delete = $conn->query("DELETE FROM programme WHERE id = '$prog_id'");

if ($delete) {
    $_SESSION['success'] = "Programme deleted";
} else {
    $_SESSION['danger'] = "Programme not deleted";
}

header("location: programme.php");