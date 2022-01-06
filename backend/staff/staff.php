<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
require_once FS_ROOT_URi . "/fs.php";

class staffController extends fs {

    public function inbox($des_id, $dep_id) {
        $stmt = "SELECT
                u.name AS sender_name,
                t.id AS _index,
                doc.id as doc_id,
                subject,
                DATE(transferred_at) AS date_at,
                TIME(transferred_at) AS time_at,
                doc.descript AS doc_descript,
                t.descript AS short_note,
                doc.id AS folio,
                t.`status`  AS stat
                FROM user u, 
                transfer t, 
                designation d, 
                department dp,
                docs doc
                WHERE t.sender = u.id 
                AND t.recipient = d.id 
                AND dp.id = u.dep_id 
                AND d.`type` = '$des_id' 
                AND doc.id = t.doc_id
                AND t.dep_id = '$dep_id'
                ORDER BY t.id DESC";
        $select = $this->conn->query($stmt);
        return $select;
    }
}