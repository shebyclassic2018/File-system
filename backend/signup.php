<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
 require_once FS_ROOT_URi . "/fs.php";
 $obj = new fs();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$prog = $_POST['prog'];
$marital = $_POST['marital'];
$dob = $_POST['dob'];
$pwd = $_POST['pwd'];
$cpwd = $_POST['cpwd'];
$regno = $_POST['regno'];
$role_id = 1;
$des_id = 12;
$name = $fname . " " . $lname;

foreach($obj->getDepByProgId($prog) as $row) {
    $dep_id = $row['dep_id'];
}

$stmt = "INSERT INTO user VALUES (null,'$name', '$regno', '$dob','$marital','$gender', '$pwd',now(),'$role_id','$dep_id','$prog','$des_id')";
$obj->conn->query($stmt);
$user_id = $obj->conn->insert_id;

$stmt = "INSERT INTO file VALUES (null, 'open', now(), '$user_id')";
$obj->conn->query($stmt);

$stmt = "INSERT INTO phone VALUES (null, '$phone', '$user_id')";
$obj->conn->query($stmt);

$stmt = "INSERT INTO email VALUES (null, '$email', '$user_id')";
$obj->conn->query($stmt);
echo mysqli_error($obj->conn);

// $psize_name = $_FILES['psize']['name'];
// $psize_type = $_FILES['psize']['type'];
// $psize_type = $_FILES['psize']['type'];
$obj->uploadCertificate($_FILES['psize'],'Passport Size', $user_id);

// $bcert_name = $_FILES['bcert']['name'];
// $bcert_type = $_FILES['bcert']['type'];
$obj->uploadCertificate($_FILES['bcert'],'Birth', $user_id);

// $fsix_name = $_FILES['fsix']['name'];
// $fsix_type = $_FILES['fsix']['type'];
$obj->uploadCertificate($_FILES['fsix'],'Advanced level', $user_id);

$_SESSION['success'] = "Registration complete";

header('location: ../signup.php');

