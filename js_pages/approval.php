<?php

require "../config.php";
require STF_ROOT_URi . "/staff.php";
$obj = new staffController();

if (isset($_POST['reject'])) {
    $status = "Rejected";
}
if (isset($_POST['approve'])) {
    $status = "Approved";
}

$shortNotes = trim($_POST['short-notes']);

    $tid = $_POST['tid'];
    $doc_id = $_POST['doc_id'];

    $obj->conn->query("UPDATE docs SET status = '$status' WHERE id = '$doc_id'");

    $stmt = "UPDATE transfer SET descript= '$shortNotes', status = '$status' WHERE id = '$tid'";
    $update = $obj->conn->query($stmt);
    if($update) {
        $_SESSION['success'] = 'Document ' . $status;
        
    } else {
        $_SESSION['danger'] = 'Unknown error occured, Document not ' . $status;
    }

    header('location: ../staff-inbox.php');