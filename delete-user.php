<?php
require "backend/fs.php";
$user_id = $_GET['id'];
$user_type = $_GET['type'];

$delete = $conn->query("DELETE FROM user WHERE id = '$user_id'");

if ($delete) {
    $_SESSION['success'] = "User deleted";
} else {
    $_SESSION['danger'] = "User not deleted : " .mysqli_error($conn) ;
}

if ($user_type == "student") {
    header("location: registered-students.php");
} else if ($user_type == "custodian") {
    header("location: registered-custodian.php");
} else if ($user_type == "staff") {
    header("location: registered-staff.php");
} else {
    header("location: registered-admin.php");
}