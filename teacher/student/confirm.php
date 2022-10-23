<?php

session_start();
require_once '../../config/db.php';

if (isset($_POST['submit'])) {
    $total = $_POST['total'];
    $id_student = $_POST['id_student'];

    $stmt = $conn->prepare("INSERT INTO total_student( total, id_student ) 
                                        VALUES( :total, :id_student)");


        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":id_student", $id_student);
        $stmt->execute();
        $conn = null;

        if ($stmt) {
            $_SESSION['success'] = "ยืนยันสำเร็จ";
            header("refresh:1; url=student.php");
        } else {
            $_SESSION['error'] = "ยืนยันล้มเหลว";
            header("refresh:1; url=student.php");
        }
    }

?>