<?php
$website_folder = "file_system";
$server_name = "http://localhost/";

define ('ROOT_URi', $_SERVER['DOCUMENT_ROOT'] . $website_folder);
define('STD_ROOT_URi', ROOT_URi . "/backend/student");
define('CST_ROOT_URi', ROOT_URi . "/backend/custodian");
define('STF_ROOT_URi', ROOT_URi . "/backend/staff");
define('FS_ROOT_URi', ROOT_URi . "/backend");

// ROOT DIRECTORY OF THE SYSTEM
$SERVER_URi = $server_name . $website_folder;
define('SERVER_URi', $SERVER_URi);

$conn = new mysqli('localhost','root','','fs');