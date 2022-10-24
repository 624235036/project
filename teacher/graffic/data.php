<?php 
    header('Content-Type: application/json');

    session_start();
    require_once "../../config/db.php";

    
    if (isset($_SESSION['tech_login'])) {
    $user_id = $_SESSION['tech_login'];
    $sqlQuery = $conn->query("SELECT `id_teacher`,`name_header`,`avgscore` FROM scorestudent WHERE scorestudent.`id_teacher` = $user_id GROUP BY `id_teacher`,`name_header`");
    $sqlQuery->execute();
    $result = $sqlQuery->fetchAll();

    }

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }


    echo json_encode($data);

?>