<?php

session_start();
require_once "../../config/db.php";

if (isset($_SESSION['school_id'])) {
    $school_id = $_SESSION['school_id'];
    $stmt = $conn->prepare("SELECT * FROM class_room INNER JOIN school on school.id = class_room.id_school WHERE class_room.id_school = $school_id");
    $stmt->execute();
    $rs = $stmt->fetch();

    $id_room = $rs['id_room'];
    $class_name = $rs['class_name'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Class Room Result</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../style.css" type="text/css" />
    <link rel="stylesheet" href="../../newstyle.css" type="text/css" />
</head>

<body style="background-color: #F5F5DC;">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ระบบประเมินสมรรถนะของผู้เรียน</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <div align="center"><br>
                    <img src="../../images/icon2.png" height="100" class="img-circle" alt="Cinque Terre">
                </div>
                <div align="center">
                    <?php
                    if (isset($_SESSION['director_login'])) {
                        $user_id = $_SESSION['director_login'];
                        $stmt = $conn->query("SELECT u.*, s.schoolname FROM users as u INNER JOIN school as s on s.id = u.school_id WHERE u.id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <h4 class="mt-4"> <?php echo  $row['schoolname']; ?></h4>
                    <h4 class="mt-4">ผู้อำนวยการ <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h4>
                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../director.php">หน้าแรก</a></li>
                    <li><a href="../teacher.php">รายชื่อครูประจำชั้น</a></li>
                    <li><a href="../capacity/form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li class="active"><a href="result.php">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="../resultclass/result.php">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="../resultschool.php">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class="col-sm-11 text-left">
                    <h3 align="center">ภาพรวมสมรรถนะผู้เรียน/ห้องเรียน</h3> <br>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>คำนำหน้า</th>
                                <th>ชื่่อ</th>
                                <th>นามสกุล</th>
                                <th>ห้องเรียน</th>
                                <th>ข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['school_id'])) {
                                $index = 1;
                                $id_school = $_SESSION['school_id'];
                                $stmt = $conn->query("SELECT u.*, c.class_name FROM users as u INNER JOIN class_room as c on c.id_room = u.id_room WHERE u.school_id = $id_school AND urole = 'teacher'");
                                $stmt->execute();
                                $data = $stmt->fetchAll();

                                if (!$data) {
                                    echo "ไม่มี";
                                } else {
                                    foreach ($data as $a) {

                            ?>
                                        <tr>
                                            <td><?= $index++; ?></td>
                                            <td><?= $a['title']; ?></td>
                                            <td><?= $a['firstname']; ?></td>
                                            <td><?= $a['lastname']; ?></td>
                                            <td><?= $a['class_name']; ?></td>
                                            <td><a href="resultroom.php?id=<?= $a['id_room']; ?>" class="btn btn-info btn-sm">ภาพรวม</a></td>
                                        </tr>
                            <?php }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>