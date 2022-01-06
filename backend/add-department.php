<?php
    require "fs.php";
    $obj = new fs();

    $obj->addDepartment($_POST);

    header('location: ../department.php');