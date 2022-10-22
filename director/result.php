<?php

session_start();
require_once "../config/db.php";

if (isset($_SESSION['school_id'])) {
    $school_id = $_SESSION['school_id'];
    $stmt = $conn->prepare("SELECT * FROM class_room INNER JOIN school on school.id = class_room.id_school WHERE class_room.id_school = $school_id");
    $stmt->execute();
    $rs = $stmt->fetchAll();
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
    <link rel="stylesheet" href="../style.css" type="text/css" />
    <link rel="stylesheet" href="../newstyle.css" type="text/css" />
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
                <a class="navbar-brand" href="#">ระบบประเมินสมรรถนะผู้เรียนจังหวัดสตูล</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <div align="center"><br>
                    <img src="../images/icon2.png" height="100" class="img-circle" alt="Cinque Terre">
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
                    <td><a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="director.php">หน้าแรก</a></li>
                    <li><a href="teacher.php">รายชื่อครูประจำชั้น</a></li>
                    <li><a href="form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li class="active"><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class="col-sm-11 text-left">
                    <h3 align="center">ภาพรวมสมรรถนะผู้เรียน/ห้องเรียน</h3> <br>
                    <form action="" method="get">
                        <div class="mb-3 row">
                            <!-- d-none d-sm-block คือซ่อนเมื่ออยู่หน้าจอโทรศัพท์ -->
                            <label class="col-3 col-sm-2 col-form-label d-none d-sm-block"></label>
                            <div class="col-7 col-sm-5">
                                <select name="id_room" class="form-control" required>
                                    <option value="">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</option>
                                    <?php foreach ($rs as $row) { ?>
                                        <!--value ที่จะส่งออกไปจากฟอร์มคือ p_id ซึ่งก็คือไอดีหรือรหัสของตำแหน่งครับ  -->
                                        <option value="<?= $row['id_room']; ?>"><?= $row['class_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-2 col-sm-2">
                                <button type="submit" class="btn btn-primary">ประมวลผล</button>
                            </div>
                            <div class="col-2 col-sm-1">
                                <a href="result.php" class="btn btn-success">รีเซต</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>