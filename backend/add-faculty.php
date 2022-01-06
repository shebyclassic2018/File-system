<?php
    require "fs.php";
    $obj = new fs();

    $obj->addFaculty($_POST);

    header('location: ../dashboard.php');