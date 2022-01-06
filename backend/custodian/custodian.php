<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
require_once FS_ROOT_URi . "/fs.php";

class Custodian extends fs {

    function countPending($file_id) {
        $stmt = "SELECT COUNT(d.id) as total FROM file f, docs d WHERE f.id = d.file_id AND d.`status` = 'Pending' AND f.id = '$file_id'";
        foreach($this->conn->query($stmt) as $row) {}
        return $row['total'];
    }
    
    public function student_files($regno = '') {
        $stmt = "SELECT regno, f.id as fid, u.id as uid FROM file f, user u WHERE u.id = f.user_id";
        if (!empty($regno)) {
            $stmt .= " AND regno LIKE '$regno%'";
        }
        $select = $this->conn->query($stmt);
        return $select;
    }

    public function std_documents() {
        $std_id = $_GET['uid'];
        $stmt = "SELECT year(d.created_at ) as year, 
            month(d.created_at ) as month, 
            day(d.created_at) as day, 
            descript, d.subject, 
            d.id as folio, 
            d.status,
            d.id as doc_id
        FROM 
            docs d, 
            file f, 
            user u 
        WHERE 
            d.file_id = f.id AND 
            u.id = f.user_id AND 
            user_id = '$std_id'";

        $select = $this->conn->query($stmt);
        return $select;
    }

    function setCertificateStatus($cid, $status) {
        $stmt = "UPDATE certificate SET status = '$status' WHERE cid = '$cid'";
        if($this->conn->query($stmt)) {
            setcookie('alert',  "Successfull " . $status, time() + 60);
            echo  "Successfull " . $status;
        } else {
            echo "Process failed";
        }
    }
}