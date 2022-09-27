<?php
require_once('../config/db.php');

if (isset($_REQUEST['btn_insert'])) {
    // $id_question = $_REQUEST['id_question'];
    $question = $_REQUEST['question'];

  if (empty($question)) {
        $errorMsg = "กรุณาใส่ตัวชี้วัด";
    } else {
        try {
            if (!isset($errorMsg)) {
                $insert_stmt = $conn->prepare("INSERT INTO tb_question(question) VALUES (:question)");
                // $insert_stmt->bindParam(':id', $id_question);
                $insert_stmt->bindParam(':question', $question);

                if ($insert_stmt->execute()) {
                    $insertMsg = "Insert Successfully...";
                    header("location:form.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>





