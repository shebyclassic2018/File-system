<?php
require_once 'fs.php';

$email = $_POST['email'];
$pwd = $_POST['password'];

$stmt = "SELECT * FROM email e, user u, role r WHERE r.id = u.role_id AND u.id = e.user_id AND e.address = '$email' AND password = '$pwd'";
$select = $conn->query($stmt);
echo mysqli_error($conn);
echo $found = mysqli_num_rows($select);
if( $found == 1) {
    foreach ($select as $key => $row) {
        $_SESSION['user_id'] = $row['user_id'];
        $user_id = $row['user_id'];
        $_SESSION['username'] = $row['name'];
        $_SESSION['dep_id'] = $row['dep_id'];
        $_SESSION['role'] = $row['role'];
        $role = $row['role'];
    }

    // get user designation
    $des = $conn->query("SELECT * FROM designation d, user u WHERE u.des_id = d.id AND u.id = '$user_id'");
    if (mysqli_num_rows($des) == 1) {
        foreach($des as $row) {
            $_SESSION['designation'] = $row['type'];
        }
    }else{
        $_SESSION['designation'] = 'empty';
    }
    // echo $_SESSION['designation']; exit;

    if ($role == 'student') {
        header('location: ../send-request.php');
    } else if ($role == 'custodian') {
        header('location: ../std-file.php');
    } else if ($role == 'admin') {
        header('location: ../dashboard.php');
    } else {
        header('location: ../staff-inbox.php');
    }
} else {
    $_SESSION['danger'] = 'Either email or password is incorrect';
    header('location: ../index.php');
}