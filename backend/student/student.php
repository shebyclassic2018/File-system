<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
require_once FS_ROOT_URi . "/fs.php";

class Student extends fs{
    public function compose($req = [], $reqfile = []) {
        $subject = $req['subject'];
        $description = $req['description'];
        $filename = $reqfile['attachment']['name'];
        $filesize = $reqfile['attachment']['size'];
        $filetype = $reqfile['attachment']['type'];
        $target = '../documents/request/' . basename($filename);

        if(move_uploaded_file($reqfile['attachment']['tmp_name'], $target)) {
            $yes = "yes";
        } else {
            echo "file not uploaded";
            return;
        }

        // INSERT INTO DOCS TABLE
        $file_id = $this->getFileByUserId()['fid'];
        $stmt = "INSERT INTO docs VALUES (null, '$subject', '$description', now(), 'Pending', '$file_id')";
        $insert = $this->conn->query($stmt);
        if($insert) {
            $insert = "insert";
        } else {
            echo mysqli_error($this->conn);
        }

        // INSERT INTO ATTACHMENT TABLE
        $doc_id = $this->conn->insert_id;
        $stmt = "INSERT INTO attachment VALUES (null, '$filename', '$filesize', '$filetype', '$doc_id') ";
        $attach = $this->conn->query($stmt);

        if($attach) {
            $attach = "attached";
        }

        if ($attach == 'attached' && $yes == "yes" && $insert == "insert") {
            $_SESSION['success'] = "Request sent ...";
        } else {
            $_SESSION['danger'] = "Request failed";
        }

        header('location: ../../send-request.php');
    }


    public function std_documents() {
        $stmt = "SELECT year(d.created_at ) as year, month(d.created_at ) as month, day(d.created_at) as day, descript, d.subject, d.id as folio, d.status FROM docs d, file f, user u WHERE d.file_id = f.id AND u.id = f.user_id AND user_id = '$this->user_id'";
        $select = $this->conn->query($stmt);
        return $select;
    }

    public function progress($doc_id) 
    {
        $stmt = "SELECT
        t.id AS _index,
        u.name AS sender_name,
        u.id as sender_id,
	    t.recipient AS recipient_id,
        subject,
        DATE(transferred_at) AS date_at,
        TIME(transferred_at) AS time_at,
        doc.descript AS doc_descript,
        t.descript AS short_note,
        doc.id AS folio,
        t.`status`  AS status,
        dp.name as dp_name,
        dp.abbr as dp_abbr,
        dp.id as dep_id,
        regno,
        t.status as tstatus
     FROM 
        user u, 
        transfer t, 
        designation d, 
        department dp, 
        docs doc 
     WHERE 
        doc.id = t.doc_id AND 
        t.sender = u.id AND 
        t.recipient = d.id AND 
        dp.id = t.dep_id AND
        doc.id = '$doc_id'
     ORDER BY t.id DESC";
        $select = $this->conn->query($stmt);
        return $select;
    }
}