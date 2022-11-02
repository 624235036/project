<?php

session_start();
require_once "../config/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student</title>
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
                    <h4 class="mt-4"> <?php echo  $row['schoolname'];?></h4>
                    <h4 class="mt-4">ผู้อำนวยการ <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h4>
                    <hr>
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="director.php">หน้าแรก</a></li>
                    <li class="active"><a href="teacher.php">รายชื่อครูประจำชั้น</a></li>
                    <li><a href="capacity/form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li><a href="result/result.php">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="resultclass/result.php">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="resultschool.php">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0"><br>
                    <a href="teacher.php" class="btn btn-warning btn-m">ย้อนกลับ</a>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM users WHERE id = $id");
                        $stmt->execute();
                        $data_name = $stmt->fetch();
                    }
                    ?>
                    <h3>รายชื่อนักเรียนครูประจำชั้น <?php echo $data_name['title'] .' '. $data_name['firstname'] . ' ' . $data_name['lastname']; ?></h3>
                    <hr>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <h2>เพิ่มนักเรียน</h2>
                                <form action="addstudent.php" method="post">
                                    <div class="form-group">
                                        <label for="firstname">ชื่่อ</label>
                                        <input type="text" class="form-control" name="student_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">นามสกุล</label>
                                        <input type="text" class="form-control" name="student_lastname">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="class_years">ชั้นปี</label>
                                        <input type="text" readonly value="<?= $row['id_room']; ?>" class="form-control" name="id_room">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="school_id">โรงเรียน</label>
                                        <input type="text" readonly value="<?= $row['school_id']; ?>" class="form-control" name="school_id">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="school_id">คุณครูประจำชั้น</label>
                                        <input type="text" readonly value="<?= $row['id']; ?>" class="form-control" name="id_teacher">
                                    </div>
                                    <!-- <div class="form-group">
                    <label for="school">ชั้นปี</label>
                    <select name="school_id" class="form-control" required>
                      <option value="">เลือก</option>
                      <?php
                        foreach ($schools as $row) { ?>
                        <option value="<?= $row['id']; ?>"><?= $row['schoolname']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="school">โรงเรียน</label>
                    <select name="school_id" class="form-control" required>
                      <option value="">เลือก</option>
                      <?php
                        foreach ($schools as $row) { ?>
                        <option value="<?= $row['id']; ?>"><?= $row['schoolname']; ?></option>
                      <?php } ?>
                    </select>
                  </div> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                    <button type="submit" name="submit" class="btn btn-default">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%" scope="col">รหัสนักเรียน</th>
                                <th width="10%" scope="col">คำนำหน้า</th>
                                <th width="20%" scope="col">ชื่่อ</th>
                                <th width="20%" scope="col">นามสกุล</th>
                                <th width="10%" scope="col">ชั้นปี</th>
                                <th width="10%" scope="col">คะแนน</th>
                                <th width="10%" scope="col">พิมพ์รายงาน</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['id'])) {
                                $index = 1;
                                $class_id = $_GET['id'];
                                $stmt = $conn->query("SELECT t.*,c.class_name FROM student as t INNER JOIN class_room as c on c.id_room = t.id_room  WHERE t.id_teacher = $class_id ");
                                $stmt->execute();
                                $data = $stmt->fetchAll();

                                if (!$data) {
                                    echo "<tr><td COLSPAN='7' align= 'center' >ไม่มีข้อมูล</td></tr>";
                                } else {
                                    foreach ($data as $student) {

                            ?>
                                        <tr>
                                            <td><?= $student['number_id']; ?></td>
                                            <td><?= $student['title']; ?></td>
                                            <td><?= $student['student_name']; ?></td>
                                            <td><?= $student['student_lastname']; ?></td>
                                            <td><?= $student['class_name']; ?></td>
                                            <td>
                                                <a href="studentform.php?id=<?= $student['id_student']; ?>" class="btn btn-info btn-sm">ฟอร์ม</a>
                                            </td>
                                            <td>
                                                <a href="print.php?id=<?= $student['id_student']; ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
                                            </td>
                                        </tr>

                            <?php  }
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