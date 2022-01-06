<?php
    require "fs.php";
    $obj = new fs();

    $obj->addProgramme($_POST);

    header('location: ../programme.php');