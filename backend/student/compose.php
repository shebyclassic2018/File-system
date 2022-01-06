<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
require_once STD_ROOT_URi . "/student.php";

$obj = new Student();

$obj->compose($_POST, $_FILES);

