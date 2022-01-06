<?php
    require "custodian.php";
    $content = $_POST['content'];

    $obj = new Custodian();
    $data = $obj->student_files($content);
    $found = mysqli_num_rows($data);
    

if ($found > 0) {
    $arr = array();
    $i = 0;
    foreach ($data as $row){
        $countPending = $obj->countPending($row['fid']);
        $arr['regno'][] = $row['regno'];
        $arr['uid'][] = $row['uid'];
        $arr['count'][] = $countPending;
        $i++;
    }
    echo json_encode($arr);
} else {
    echo "null";
}