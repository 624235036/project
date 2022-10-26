<?php 
    header('Content-Type: application/json');

    session_start();
    require_once "../../config/db.php";

    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlQuery = $conn->query("SELECT `id_room`,`name_header`,avg(avgscore) as avgscore FROM scorestudent WHERE scorestudent.`id_room` = $id GROUP BY `id_room`,`name_header`");
    $sqlQuery->execute();
    $result = $sqlQuery->fetchAll();

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
}
    echo json_encode($data);

?>
