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

  <style>
    body {

      line-height: 22px;
      margin: 0;

      -webkit-font-smoothing: antialiased !important;
    }

    .container {
      background-color: #FFFFFF;
      width: 980px;
      /* height: 200px; */
      position: absolute;
      top: 25%;
      left: 35%;
      margin-top: -100px;
      margin-left: -100px;

    }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 1500px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #FFFFFF;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }

      .row.content {
        height: auto;
      }
    }

    .modal-content {
      margin: 20px;
      padding: 20px;
    }

    .displayed {
      display: block;
      margin-left: 28%;
    }
  </style>


</head>

<body style="background-color: #8FBC8F;">

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <div align="center"><br>
          <img src="../../images/icon1.png" height="150" class="img-circle" alt="Cinque Terre">
        </div>
        <h4>ชื่อของใช้งาน</h4>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="../teacher.php">หน้าแรก</a></li>
          <li class="active"><a href="student.php">ข้อมูลนักเรียน</a></li>
          <li><a href="#">รายงานภาพรวมสมรรถนะของห้องเรียน</a></li>
          <li><a href="#">รายงานภาพรวมสมรรถนะของชั้นปี</a></li>
          <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
        </ul><br>
      </div><br>
      <div class="container">
        <div class=" col-sm-15 col-sm-offset-0">
          <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal">เพิ่มนักเรียน</button>
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
                  <div class="form-group">
                    <label for="class_years">ชั้นปี</label>
                    <input type="text" class="form-control" name="class_years">
                  </div>
                  <div class="form-group">
                    <label for="school_id">โรงเรียน</label>
                    <input type="text" class="form-control" name="school_id">
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
                <th>ลำดับที่</th>
                <th>ชื่่อ</th>
                <th>นามสกุล</th>
                <th>ชั้นปี</th>
                <th>โรงเรียน</th>
                <th>ฟอร์ม</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $index = 1;
              $stmt = $conn->query("SELECT * FROM student");
              $stmt->execute();
              $result = $stmt->fetchAll();

              if (!$result) {
                echo "ไม่มีข้อมูล";
              } else {
                foreach ($result as $a) {

              ?>
                  <tr>
                    <td><?= $index++; ?></td>
                    <td><?= $a['student_name']; ?></td>
                    <td><?= $a['student_lastname']; ?></td>
                    <td><?= $a['class_years']; ?></td>
                    <td><?= $a['school_id']; ?></td>
                    <td><a href="form.php" class="btn btn-info btn-xs">ฟอร์ม</a>
                    <td><a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">แก้ไข</a>
                    <td><a href="#" class="btn btn-danger btn-xs">ลบ</a></td>
                    </td>

                  </tr>

              <?php  }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- สิ้นสุด container -->









</body>

</html>