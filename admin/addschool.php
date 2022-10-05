<?php

    session_start();
    require_once "../config/db.php";

    if (isset($_POST['submit'])){
        $schoolname = $_POST['schoolname'];
        $schooladrees = $_POST['schooladrees'];
     
                $sql = $conn->prepare("INSERT INTO school(schoolname, schooladrees) VALUES(:schoolname, :schooladrees)");
                $sql->bindParam(":schoolname", $schoolname);
                $sql->bindParam(":schooladrees", $schooladrees);
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "เพิ่มข้อมูลเสร็จสิ้น";
                    header("refresh:1; url=school.php");
                }else {
                    $_SESSION['error'] = "ข้อมูลล้มเหลว";
                    header("refresh:1; url=school.php");
                }
            }
?>