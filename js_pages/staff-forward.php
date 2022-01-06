<?php
require "../config.php";
require STF_ROOT_URi . "/staff.php";

$obj = new staffController();

$recipient = $_POST['des'];
$doc_id = $_POST['doc_id'];
$descript = $_POST['short-notes'];
$dep_id = $_POST['dep'];

if ($alert = $obj->forwardDocument($recipient, $descript, $doc_id, $dep_id) == "Document sent ..."){
    $_SESSION['success'] =  "Document delivered";
} else {
    $_SESSION['danger'] =  "Document not delivered";
}

header('location: ../staff-inbox.php');