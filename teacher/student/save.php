<?php

session_start();
require_once '../../config/db.php';

if (isset($_POST['submit'])) {
    $id_student = $_POST['id_student'];
    $D02 = $_POST['D02'];
    $Q02 = $_POST['Q02'];
    $D03 = $_POST['D03'];
    $Q03 = $_POST['Q03'];
    $D04 = $_POST['D04'];
    $Q04 = $_POST['Q04'];
    $D05 = $_POST['D05'];
    $Q05 = $_POST['Q05'];
    $D06 = $_POST['D06'];
    $Q06 = $_POST['Q06'];
    $Q08 = $_POST['Q08'];
    $D08 = $_POST['D08'];
    $Q09 = $_POST['Q09'];
    $D09 = $_POST['D09'];
    $Q10 = $_POST['Q10'];
    $D10 = $_POST['D10'];
    $Q11 = $_POST['Q11'];
    $D11 = $_POST['D11'];
    $Q12 = $_POST['Q12'];
    $D12 = $_POST['D12'];
    $Q15 = $_POST['Q15'];
    $D15 = $_POST['D15'];
    $Q16 = $_POST['Q16'];
    $D16 = $_POST['D16'];
    $Q17 = $_POST['Q17'];
    $D17 = $_POST['D17'];
    $Q18 = $_POST['Q18'];
    $D18 = $_POST['D18'];
    $Q19 = $_POST['Q19'];
    $D19 = $_POST['D19'];
    $Q20 = $_POST['Q20'];
    $D20 = $_POST['D20'];
    $Q21 = $_POST['Q21'];
    $D21 = $_POST['D21'];
    $Q22 = $_POST['Q22'];
    $D22 = $_POST['D22'];
    $Q23 = $_POST['Q23'];
    $D23 = $_POST['D23'];
    $Q25 = $_POST['Q25'];
    $D25 = $_POST['D25'];
    $Q26 = $_POST['Q26'];
    $D26 = $_POST['D26'];
    $Q27 = $_POST['Q27'];
    $D27 = $_POST['D27'];
    $Q28 = $_POST['Q28'];
    $D28 = $_POST['D28'];
    $Q29 = $_POST['Q29'];
    $D29 = $_POST['D29'];
    $Q1 = $_POST['Q1'];
    $Q2 = $_POST['Q2'];
    $Q3 = $_POST['Q3'];
    $Q4 = $_POST['Q4'];
    $Q5 = $_POST['Q5'];

    if (empty($Q02)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D02)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q03)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่ ';
        header("location:student.php");
    } else if (empty($D03)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q04)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D04)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q05)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D05)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q06)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D06)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q08)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D08)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q09)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D09)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q10)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D10)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q11)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D11)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q12)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D12)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q15)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D15)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q16)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D16)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q17)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D17)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q18)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D18)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q19)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D19)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q20)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D20)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q21)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D21)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q22)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D22)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q23)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D23)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q25)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D25)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q26)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D26)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q27)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D27)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q28)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D28)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($Q29)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else if (empty($D29)) {
        $_SESSION['error'] = 'กรอกข้อแบบฟอร์มไม่ครบ กรุณากรอกใหม่';
        header("location:student.php");
    } else {

        $stmt = $conn->prepare("INSERT INTO score( score, id_h_question, id_question, id_student ) 
                                        VALUES( :score, :id_h_question, :id_question, :id_student)");


        $stmt->bindParam(":id_student", $id_student);
        $stmt->bindParam(":score", $Q02);
        $stmt->bindParam(":id_h_question", $Q1);
        $stmt->bindParam(":id_question", $D02);
        $stmt->execute();
        $stmt->bindParam(":score", $Q03);
        $stmt->bindParam(":id_h_question", $Q1);
        $stmt->bindParam(":id_question", $D03);
        $stmt->execute();
        $stmt->bindParam(":score", $Q04);
        $stmt->bindParam(":id_h_question", $Q1);
        $stmt->bindParam(":id_question", $D04);
        $stmt->execute();
        $stmt->bindParam(":score", $Q05);
        $stmt->bindParam(":id_h_question", $Q1);
        $stmt->bindParam(":id_question", $D05);
        $stmt->execute();
        $stmt->bindParam(":score", $Q06);
        $stmt->bindParam(":id_h_question", $Q1);
        $stmt->bindParam(":id_question", $D06);
        $stmt->execute();
        //จบหัวข้อที่1
        $stmt->bindParam(":score", $Q08);
        $stmt->bindParam(":id_h_question", $Q2);
        $stmt->bindParam(":id_question", $D08);
        $stmt->execute();
        $stmt->bindParam(":score", $Q09);
        $stmt->bindParam(":id_h_question", $Q2);
        $stmt->bindParam(":id_question", $D09);
        $stmt->execute();
        $stmt->bindParam(":score", $Q10);
        $stmt->bindParam(":id_h_question", $Q2);
        $stmt->bindParam(":id_question", $D10);
        $stmt->execute();
        $stmt->bindParam(":score", $Q11);
        $stmt->bindParam(":id_h_question", $Q2);
        $stmt->bindParam(":id_question", $D11);
        $stmt->execute();
        $stmt->bindParam(":score", $Q12);
        $stmt->bindParam(":id_h_question", $Q2);
        $stmt->bindParam(":id_question", $D12);
        $stmt->execute();
        //จบหัวข้อที่2
        $stmt->bindParam(":score", $Q15);
        $stmt->bindParam(":id_h_question", $Q3);
        $stmt->bindParam(":id_question", $D15);
        $stmt->execute();
        $stmt->bindParam(":score", $Q16);
        $stmt->bindParam(":id_h_question", $Q3);
        $stmt->bindParam(":id_question", $D16);
        $stmt->execute();
        $stmt->bindParam(":score", $Q17);
        $stmt->bindParam(":id_h_question", $Q3);
        $stmt->bindParam(":id_question", $D17);
        $stmt->execute();
        $stmt->bindParam(":score", $Q18);
        $stmt->bindParam(":id_h_question", $Q3);
        $stmt->bindParam(":id_question", $D18);
        $stmt->execute();
        //จบหัวข้อที่3
        $stmt->bindParam(":score", $Q19);
        $stmt->bindParam(":id_h_question", $Q4);
        $stmt->bindParam(":id_question", $D19);
        $stmt->execute();
        $stmt->bindParam(":score", $Q20);
        $stmt->bindParam(":id_h_question", $Q4);
        $stmt->bindParam(":id_question", $D20);
        $stmt->execute();
        $stmt->bindParam(":score", $Q21);
        $stmt->bindParam(":id_h_question", $Q4);
        $stmt->bindParam(":id_question", $D21);
        $stmt->execute();
        $stmt->bindParam(":score", $Q22);
        $stmt->bindParam(":id_h_question", $Q4);
        $stmt->bindParam(":id_question", $D22);
        $stmt->execute();
        $stmt->bindParam(":score", $Q23);
        $stmt->bindParam(":id_h_question", $Q4);
        $stmt->bindParam(":id_question", $D23);
        $stmt->execute();
        //จบหัวข้อที่4
        $stmt->bindParam(":score", $Q25);
        $stmt->bindParam(":id_h_question", $Q5);
        $stmt->bindParam(":id_question", $D25);
        $stmt->execute();
        $stmt->bindParam(":score", $Q26);
        $stmt->bindParam(":id_h_question", $Q5);
        $stmt->bindParam(":id_question", $D26);
        $stmt->execute();
        $stmt->bindParam(":score", $Q27);
        $stmt->bindParam(":id_h_question", $Q5);
        $stmt->bindParam(":id_question", $D27);
        $stmt->execute();
        $stmt->bindParam(":score", $Q28);
        $stmt->bindParam(":id_h_question", $Q5);
        $stmt->bindParam(":id_question", $D28);
        $stmt->execute();
        $stmt->bindParam(":score", $Q29);
        $stmt->bindParam(":id_h_question", $Q5);
        $stmt->bindParam(":id_question", $D29);
        $stmt->execute();
        $conn = null;
        //จบหัวข้อที่5

        if ($stmt) {
            $_SESSION['success'] = "กรอกข้อมูลสำเร็จ";
            header("refresh:1; url=student.php");
        } else {
            $_SESSION['error'] = "กรอกข้อมูลล้มเหลว";
            header("refresh:1; url=student.php");
        }
    }
}
