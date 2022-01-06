<?php
session_start();

class fs {

    public $conn, $user_id, $dep_id;

    public function __construct() {
        $this->conn = $this->dbconn();
        @$this->user_id = $_SESSION['user_id'];
        @$this->dep_id = $_SESSION['dep_id'];
    }
    
    public function dbconn($host = 'localhost', $username = 'root', $password = '', $dbname = 'fs') {
        $conn = new mysqli($host, $username, $password, $dbname);
        return $conn;
    }

    public function dd($var) {
        echo "<pre>";
            var_dump($var);
        echo "</pre>";
    }

    function date_format($day, $month, $year, $sp = '-') {

        if ($day < 10) {
            $day = '0' . $day;
        }

        if ($month < 10) {
            $month =  '0' . $month;
        }
        return $day . $sp . $month . $sp . $year;
    }

    function doc_attachment($doc_id) {
        // Get document attachments
        $stmt = "SELECT * FROM attachment a, docs d WHERE a.doc_id = d.id AND d.id = '$doc_id'";
        return $this->conn->query($stmt);
    }

    public function std_info($std_id ) {
        
        $stmt = "SELECT
            u.id as uid,
            u.name as std_name, 
            regno, 
            title as prog_name, 
            p.abbr as prog_abbr, 
            pn.number as phone_number, 
            e.address as email, 
            d.name as dep_name, 
            d.abbr as dep_abbr,
            f.name as fac_name,
            f.abbr as fac_abbr
        FROM 
            department d, 
            phone pn, 
            user u, 
            programme p, 
            role r, 
            faculty f, 
            email e 
        WHERE 
            d.faculty_id = f.id AND
            pn.user_id = u.id AND
            u.prog_id = p.id AND
            u.role_id = r.id AND
            u.dep_id = d.id AND
            p.dep_id = d.id AND
            e.user_id = u.id AND 
            u.id = $std_id";
        return $select = $this->conn->query($stmt);
    }

    function std_certificates_folder($status = 'Pending') {
        $stmt = "SELECT 
            u.id as uid,
            regno,
            count(cid) as total
        FROM 
            certificate c, 
            user u, 
            role r 
        WHERE 
            c.user_id = u.id 
        AND 
            r.id = u.role_id AND 
            r.id = 1 AND 
            STATUS = '$status'
        GROUP BY c.user_id";
        return $this->conn->query($stmt);
    }

    function getCertificate($user_id) {
        // select certicate for custodian approval
        $stmt = "SELECT * FROM certificate c, user u WHERE user_id = u.id AND user_id = '$user_id' ORDER BY status DESC";
        return $this->conn->query($stmt);
    }

    function getDesignation() {
        //Get all designation
        return $this->conn->query("SELECT * FROM designation WHERE type != 'Null'");
    }

    function getFaculty() {
        // select certicate for custodian approval
        $stmt = "SELECT * FROM faculty WHERE abbr != 'Null'";
        return $this->conn->query($stmt);
    }

    function getDepartment() {
        // select certicate for custodian approval
        $stmt = "SELECT * FROM department WHERE abbr != 'Null'";
        return $this->conn->query($stmt);
    }

    function getProgramme() {
        $stmt = "SELECT * FROM programme WHERE title != 'Null'";
        return $this->conn->query($stmt);
    }

    function forwardDocument($recipient, $descript, $doc_id, $dep_id) {
        $sender = $this->user_id;
        $stmt = "INSERT INTO  transfer VALUES (null, '$sender', '$recipient', now() , '$descript', 'Pending', '$dep_id', '$doc_id')";
        if ($this->conn->query($stmt)) {
            return "Document sent ...";
        } else {
            echo "Failed " . mysqli_error($this->conn);
        }

    }

    function userDesignation($user_id) {
        foreach($this->conn->query("SELECT type FROM designation d, user u WHERE d.id = u.des_id AND u.id = '$user_id'") as $key => $row) {}
        return $row['type'];
    }

    function designation($des_id) {
        foreach($this->conn->query("SELECT type FROM designation WHERE id = '$des_id'") as $key => $row) {}
        return $row['type'];
    }

    function userRole($user_id) {
        foreach($this->conn->query("SELECT role FROM role r, user u WHERE r.id = u.role_id AND u.id = '$user_id'") as $key => $row) {}
        return $row['role'];
    }

    function srroleodes($sender_id){
        $role = $this->userRole($sender_id);
        if ($role == 'staff') {
            $role = $this->userDesignation($sender_id);
        }
        return $role;
    }

    function getFacultyByDepId($dep_id) {
        foreach ($this->conn->query("SELECT f.name as faculty_name, f.abbr as fac_abbr FROM faculty f, department d WHERE faculty_id = f.id AND d.id = '$dep_id'") as $row){}
        return $row['faculty_name'] . " (" . $row['fac_abbr'] .")";
    }

    function getDepByProgId($prog_id) {
        return $this->conn->query("SELECT d.id as dep_id,d.name as dep_name, d.abbr as dep_abbr FROM programme p, department d WHERE p.dep_id = d.id AND p.id = '$prog_id'");
    }

    function getDocSubject($doc_id) {
        foreach ($this->conn->query("SELECT subject FROM docs WHERE id = '$doc_id'") as $row){}
        return $row['subject'];
    }

    function getFileByUserId($user_id = ''){
        if(empty($user_id)){
            $user_id = $_SESSION['user_id'];
        }
        $stmt = "SELECT f.id as fid FROM file f, user u WHERE u.id = f.user_id AND u.id = '$user_id'";
        foreach($this->conn->query($stmt) as $row){}
        return $row;
    }

    function uploadCertificate($FILES, $cert_type, $user_id,$status = 'Pending') {
        $cert_name = $FILES['name'];
        $type = $FILES['type'];
        $cert_size = $FILES['size'];
        $stmt = "INSERT INTO certificate VALUES (null, '$cert_name', '$type', '$cert_size', '$status','$cert_type', '$user_id')";
        $this->conn->query($stmt);
        echo mysqli_error($this->conn);

        $target = "../image/certificate/" . basename($cert_name);

        if (move_uploaded_file($FILES['tmp_name'], $target)) {}
    }

    function count($table) {
        foreach($this->conn->query("SELECT count(id) as total FROM " . $table . " WHERE abbr != 'Null'") as $row){};
        return $row['total'];
    }

    function countDepartmentFacultyId($faculty_id) {
        foreach($this->conn->query("SELECT count(d.id) as total FROM department d, faculty f WHERE d.faculty_id = f.id AND faculty_id = '$faculty_id'") as $row){};
        return $row['total'];
    }

    function countProgrammeFacultyId($faculty_id) {
        foreach($this->conn->query("SELECT count(d.id) as total FROM department d, faculty f, programme p WHERE p.dep_id = d.id AND d.faculty_id = f.id AND faculty_id = '$faculty_id'") as $row){};
        return $row['total'];
    }

    function countProgrammeDepartmentId($dep_id) {
        foreach($this->conn->query("SELECT count(p.id) as total FROM department d, programme p WHERE p.dep_id = d.id AND dep_id = '$dep_id'") as $row){};
        return $row['total'];
    }

    function userByRole($role) {
        foreach($this->conn->query("SELECT count(u.id) as total FROM role r, user u WHERE u.role_id = r.id AND role = '$role'") as $row){};
        return $row['total'];
    }

    function getUserInfo($role_id) {
            $stmt = "SELECT
                u.id as uid,
                u.name as username, 
                regno, 
                title as prog_name, 
                p.abbr as prog_abbr, 
                pn.number as phone_number, 
                e.address as email, 
                d.name as dep_name, 
                d.abbr as dep_abbr,
                f.name as fac_name,
                f.abbr as fac_abbr,
                u.created_at as created_at,
                marital_status as marital,
                sex, dob, ds.type as designation
            FROM 
                department d, 
                phone pn, 
                user u, 
                programme p, 
                role r, 
                faculty f, 
                email e,
                designation ds
            WHERE 
                d.faculty_id = f.id AND
                pn.user_id = u.id AND
                u.prog_id = p.id AND
                u.role_id = r.id AND
                u.dep_id = d.id AND
                e.user_id = u.id AND 
                u.des_id = ds.id AND
                r.role = '$role_id'";
            return $select = $this->conn->query($stmt);
        
    }

    function addFaculty($POST) {
        $name = $POST['faculty'];
        $abbr = $POST['abbr'];
        if($this->conn->query("INSERT INTO faculty VALUES (null, '$name', '$abbr', now())")){
            $_SESSION['success'] = "Faculty (" . $name . ") added successfull";
        } else {
            $_SESSION['danger'] = "Faculty (" . $name . ") not added - " ;//. mysqli_error($this->conn);
        }
    }

    function addDepartment($POST) {
        $name = $POST['dep'];
        $abbr = $POST['abbr'];
        $faculty_id = $POST['faculty_id'];
        if($this->conn->query("INSERT INTO department VALUES (null, '$name', '$abbr', '$faculty_id', now())")){
            $_SESSION['success'] = "Department (" . $name . ") added successfull";
        } else {
            $_SESSION['danger'] = "Department (" . $name . ") not added - " . mysqli_error($this->conn);
        }
    }

    function addProgramme($POST) {
        $name = $POST['prog'];
        $abbr = $POST['abbr'];
        $dep_id = $POST['dep_id'];
        if($this->conn->query("INSERT INTO programme VALUES (null, '$name', '$abbr', '$dep_id', now())")){
            $_SESSION['success'] = "Programme (" . $name . ") added successfull";
        } else {
            $_SESSION['danger'] = "Programme (" . $name . ") not added";
        }
    }

}

$obj = new fs();
$conn = $obj->dbconn();