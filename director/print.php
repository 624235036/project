<?php

session_start();
require_once "../config/db.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM form_question WHERE id_queustion = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
        header("location:form.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        @media print {
            @page {
                size: 210mm 297mm;
                margin: 0;
            }

            #print {
                display: none;
                visibility: none;
            }

            #return {
                display: none;
                visibility: none;
            }
            .total{
                margin-top: 100%;
            }
        }
        body {
            margin: 0;
        }
        .container {
            background-color: #FFFFFF;
            width: 990px;
            /* height: 200px; */
        }
    </style>
</head>

<body style="background-color: gray;">

    <div class="container" style="border-radius: 20px;">
        <div class=" col-sm-15 col-sm-offset-0">
            <br>
            <a href="teacher.php" id="return" class="btn btn-warning">ย้อนกลับ</a>
            <button type="botton" name="botton" id="print" class="btn btn-primary" onclick="window.print();">ปริ้นฟอร์ม</button>
            <br>
            <form action="save.php" method="post">
                <table class="table table-striped table-bordered table-hover">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM student WHERE id_student = $id");
                        $stmt->execute();
                        $result = $stmt->fetch();
                    }
                    ?>
                    <tr bgcolor="#F5FFFA">
                        <td colspan="10" align="center">
                            <h5>คะแนนรวมสมรรถนะผู้เรียน</h5>
                        </td>
                    </tr><br>
                    <tr>
                        <td colspan="10" align="center">
                            <h5>ชื่อ <?php echo  $result['title'] . ' ' . $result['student_name'] . '&nbsp;&nbsp;&nbsp;นามสกุล ' . $result['student_lastname'] . '&nbsp;&nbsp;&nbsp;รหัสนักเรียน ' . $result['number_id'] ?></h5>
                        </td>
                    </tr>
                    <tr>
                        <th width="5%">ลำดับ</th>
                        <th width="45%">หัวข้อ</th>
                        <th width="5%">คะแนน</th>
                        <!-- <th width="10%" scope="col">เครื่องมือ</th> -->
                    </tr>

                    <?php
                    $index_h = 0;
                    //$index = 1.1;
                    $select_stmt = $conn->prepare("SELECT * FROM form_header");
                    $select_stmt->execute();
                    $data1 = $select_stmt->fetchAll();
                    foreach ($data1 as $h) {
                        $index_h++;

                        $id_header = $h["id_header"];
                    ?>

                        <tr>
                            <td BGCOLOR=#E0E0E0 COLSPAN='4'><?php echo $h["name_header"]; ?></td>
                        </tr>
                        <tbody>
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $index_h = 0;
                                $select_stmt = $conn->prepare("SELECT s.*, q.* FROM score as s INNER JOIN form_question as q on q.id_queustion = s.id_question  WHERE q.id_header = $id_header AND s.id_student = $id ");
                                $select_stmt->execute();
                                while ($data = $select_stmt->fetch()) {
                                    $index_h++;

                            ?>
                                    <tr>
                                        <td><?= $index_h; ?></td>
                                        <td><?= $data['question']; ?></td>
                                        <td><?= $data['score']; ?></td>
                                    </tr>
                        <?php }
                            }
                        }

                        ?>
                        </tbody>
                </table><br>
                <div class="total">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td bgcolor="#E0E0E0" COLSPAN='4'></td>
                            </tr>
                            <tr>
                                <th width="5%"></th>
                                <th width="45%">สรุปคะแนนสมรรถนะ</th>
                                <th width="5%">คะแนน</th>
                            </tr>
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $index_h = 1;
                                $select_h = $conn->prepare("SELECT student.id_student,form_header.name_header,SUM(score.score) as total 
                                                            FROM score 
                                                            INNER JOIN form_header on score.id_h_question = form_header.id_header 
                                                            INNER JOIN student on student.id_student = score.id_student
                                                            WHERE score.id_student = $id GROUP BY student.id_student, form_header.name_header");
                                $select_h->execute();
                                $data_h = $select_h->fetchAll();


                                if (!$data_h) {
                                    echo "ไม่มี";
                                } else {
                                    foreach ($data_h as $q_h) {
                            ?>
                                        <tr>
                                            <td><?= $index_h++; ?></td>
                                            <td><?= $q_h['name_header']; ?></td>
                                            <td><?= $q_h['total']; ?></td>
                                        </tr>
                            <?php }
                                }
                            }
                            ?>
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $index_h = 1;
                                $select_h = $conn->prepare("SELECT SUM(`SUM(score.score)`) as total FROM `scoresum` WHERE `id_student` = $id");
                                $select_h->execute();
                                $data_h = $select_h->fetchAll();

                                if (!$data_h) {
                                    echo "ไม่มี";
                                } else {
                                    foreach ($data_h as $total_score) {

                            ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>คะแนนรวม <br>(<?= $total_score['total']; ?>)</td>
                                        </tr>
                            <?php }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form><br>
        </div>
    </div>

</body>

</html>