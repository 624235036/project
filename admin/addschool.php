<?php

    session_start();
    require_once "../config/db.php";

    if (isset($_POST['submit'])){
        $schoolname = $_POST['schoolname'];
        $schooladrees = $_POST['schooladrees'];
        $img = $_FILES['img'];

        $allow = array('jpg', 'jpec', 'png');
        $extension = explode(".", $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/".$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath))
                $sql = $conn->prepare("INSERT INTO school(schoolname, schooladrees, img) VALUES(:schoolname, :schooladrees, :img)");
                $sql->bindParam(":schoolname", $schoolname);
                $sql->bindParam(":schooladrees", $schooladrees);
                $sql->bindParam(":img", $fileNew);
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "เพิ่มข้อมูลเสร็จสิ้น";
                    header("location: school.php");
                }else {
                    $_SESSION['error'] = "ข้อมูลล้มเหลว";
                    header("location: school.php");
                }
            }
        }
    }
?>