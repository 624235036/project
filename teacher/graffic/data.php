<?php 
    header('Content-Type: application/json');

    session_start();
    require_once "../../config/db.php";

    $sqlQuery = $conn->query("SELECT * FROM student ORDER BY id");
    $sqlQuery->execute();
    $result = $sqlQuery->fetchAll();

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }


    echo json_encode($data);

?>