<?php
require "../config.php";
require ROOT_URi . "/backend/custodian/custodian.php";

$obj = new Custodian();

$recipient = $_POST['des'];
$doc_id = $_POST['doc_id'];
$descript = $_POST['short-notes'];
$uid = $_POST['uid'];
$dep_id = $_POST['dep'];

$obj->conn->query("UPDATE docs SET status = 'Waiting for approval' WHERE id = '$doc_id'");

if ($alert = $obj->forwardDocument($recipient, $descript, $doc_id, $dep_id) == "Document sent ..."){
    $_SESSION['success'] =  "Document delivered";
} else {
    $_SESSION['danger'] =  "Document not delivered - error: " . mysqli_error($obj->conn);
}
echo mysqli_error($obj->conn);
header('location: ../open-file.php?uid=' . $uid);