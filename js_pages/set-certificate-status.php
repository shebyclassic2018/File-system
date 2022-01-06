<?php
require "../config.php";
require ROOT_URi . "/backend/custodian/custodian.php";

$cid = $_POST['cid'];
$status = $_POST['status'];

$obj = new Custodian();
$obj->setCertificateStatus($cid, $status);