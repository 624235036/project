<?php

session_start();
require_once "../../config/db.php";

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
    <link rel="stylesheet" href="../../style.css" type="text/css" />
    <link rel="stylesheet" href="../../newstyle.css" type="text/css" />
</head>

<body style="background-color: #8FBC8F;">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ระบบประเมินสมรรถนะผู้เรียนจังหวัดสตูล</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <div align="center"><br>
                    <img src="../../images/icon1.png" height="100" class="img-circle" alt="Cinque Terre">
                </div>
                <div align="center">
                    <?php
                    if (isset($_SESSION['tech_login'])) {
                        $user_id = $_SESSION['tech_login'];
                        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <h4 class="mt-4">คุณครู <?php echo $row['firstname'] . ' ' . $row['lastname'] . ' ' . $row['school_id'] . ' ' . $row['id_room'] ?></h4>
                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../teacher.php">หน้าแรก</a></li>
                    <li class="active"><a href="student.php">ข้อมูลนักเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของ/ห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของ/โรงเรียน</a></li>
                    <li><a href="../../index.php">ออกจากระบบ</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0">
                    <br>
                    <div class="col-2 col-sm-2">
                        <a href="student.php" class="btn btn-warning">ย้อนกลับ</a>
                    </div><br>
                    <form action="" method="post">
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
                                    <h4>คะแนนรวมสมรรถนะผู้เรียน</h4>
                                </td>
                            </tr><br>
                            <tr>
                                <td colspan="10" align="center">
                                    <h4>ชื่อ <?php echo  $result['title'] . ' ' . $result['student_name'] . '&nbsp;&nbsp;&nbsp;นามสกุล ' . $result['student_lastname'] .'&nbsp;&nbsp;&nbsp;รหัสนักเรียน '. $result['number_id'] ?></h4>
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
                                    $select_h = $conn->prepare("SELECT student.id_student,form_header.name_header,SUM(score.score) as total FROM score INNER JOIN form_header on score.id_h_question = form_header.id_header INNER JOIN student on student.id_student = score.id_student
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
                                    <td>คะแนนรวม <br>(<?= $total_score['total'];?>)</td>
                                </tr>
                                <?php }
                                    }
                                }
                                ?>
                                </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>