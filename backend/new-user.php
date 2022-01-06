<?php
require "fs.php";
$user = $_GET['user'];

// common field
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mname = $_POST['mname'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$marital_status = $_POST['marital_status'];
$name = $fname . " " . $mname . " " . $lname;

if ($user == "custodian") {
    $role_id = 2;
    $dep_id = 3;
    $prog_id = 5;
    $des_id = 12;
    $url = "../new-user.php";
    $password = "cust12345";
} else if($user == "staff"){
    $des_id= $_POST['des_id'];
    $dep_id= $_POST['dep_id'];
    $role_id = 3;
    $prog_id = 5;
    $url = "../new-staff-form.php";
    $password = "staff12345";
} else {
    $role_id = 4;
    $dep_id = 3;
    $prog_id = 5;
    $des_id = 12;
    $url = "../new-admin-form.php";
    $password = "admin12345";
} 



$stmt = "INSERT INTO user VALUES (null, '$name', '', '$dob', '$marital_status', '$sex', '$password', now(), '$role_id', '$dep_id', '$prog_id', '$des_id')";
$insert = $conn->query($stmt);
$user_id = $conn->insert_id;

if ($insert) {
    $stmt = "INSERT INTO phone VALUES (null, '$phone', '$user_id')";
    $insert_phone = $conn->query($stmt);

    $stmt = "INSERT INTO email VALUES (null, '$email', '$user_id')";
    $insert_email = $conn->query($stmt);

    if ($insert_phone && $insert_email) {
        $_SESSION['success'] = "User added";
    } else {
        $_SESSION['danger'] = "User not added";
        $conn->query("DELETE FROM user WHERE id = '$user_id'");
    }
} else {
    $_SESSION['danger'] = "User not added";
}

// echo mysqli_error($conn);
header('location: ' . $url);