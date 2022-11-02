<?php
session_start();
require_once "../config/db.php";

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $deletestmt = $conn->query("DELETE FROM school WHERE id = $delete_id");
  $deletestmt->execute();

  if ($deletestmt) {
    echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
    $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
    header("refresh:1; url=school.php");
  }
}

//สร้างเงื่อนไขตรวจสอบถ้ามีการค้นหาให้แสดงเฉพาะรายการค้นหา
if (isset($_GET['schoolname']) && $_GET['schoolname'] != '') {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $schoolname = "%{$_GET['schoolname']}%";

  //คิวรี่ข้อมูลมาแสดงจากการค้นหา
  $stmt = $conn->prepare("SELECT* FROM school WHERE schoolname LIKE ?");
  $stmt->execute([$schoolname]);
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {
  //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
  $stmt = $conn->prepare("SELECT* FROM school");
  $stmt->execute();
  $result = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>School</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style.css" type="text/css" />
  <link rel="stylesheet" href="../newstyle.css" type="text/css" />
  <script>
    function confirmDelete(delUrl) {
      if (confirm("Are you sure you want to delete")) {
        document.location = delUrl;
      }
    }
  </script>
</head>

<body style="background-color: #00008B;">
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

  <div class="container-fluid ">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <div align="center"><br>
          <img src="../images/icon.jpg" height="100" class="img-circle" alt="Cinque Terre">
        </div>
        <div align="center">
          <?php
          if (isset($_SESSION['admin_login'])) {
            $user_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
          }
          ?>
          <h4 class="mt-4"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h4>
        </div>
        <hr>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="admin.php">หน้าแรก</a></li>
          <li class="active"><a href="school.php">ข้อมูลโรงเรียน</a></li>
          <li><a href="../admin/director/director.php">ข้อมูลผู้อำนวยการ</a></li>
          <li><a href="teacher/teacher.php">ข้อมูลคุณครู</a></li>
          <li><a href="class/class.php">เพิ่มห้อง</a></li>
          <li><a href="capacity/form.php">ตัวชี้วัดสมรรถนะ</a></li>
          <li><a href="../admin/date/t_date.php">ช่วงเวลาประเมิน</a></li>
        </ul>
      </div><br>
      <div class="container">
        <div class=" col-sm-15 col-sm-offset-0"><br>
          <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มโรงเรียน</button>
          <h2>ข้อมูลโรงเรียน</h2>
          <hr>
          <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
              <?php
              echo $_SESSION['success'];
              unset($_SESSION['success']);
              ?>
            </div>
          <?php } ?>
          <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
              <?php
              echo $_SESSION['error'];
              unset($_SESSION['error']);
              ?>
            </div>
          <?php } ?>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <h2>เพิ่มโรงเรียน</h2>
                <form action="addschool.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="schoolname">ชื่อโรงเรียน:</label>
                    <input type="text" class="form-control" name="schoolname">
                  </div>
                  <div class="form-group">
                    <label for="schooladrees">ที่อยู่โรงเรียน:</label>
                    <input type="text" class="form-control" name="schooladrees">
                  </div>
                  <a class="btn btn-danger" href="school.php">ปิด</a>
                  <button type="submit" name="submit" class="btn btn-default">บันทึก</button>
                </form>
              </div>
            </div>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th width="8%">ลำดับที่</th>
                <th>โรงเรียน</th>
                <th>ที่อยู่</th>
                <th width="10%">แก้ไข</th>
                <th width="10%">ลบ</th>
              </tr>
            </thead>
            <tbody>
              <form action="school.php" method="get">
                <?php
                $index = 1;
                $stmt = $conn->query("SELECT * FROM school");
                $stmt->execute();
                $schools = $stmt->fetchAll();

                if (!$schools) {
                  echo "<tr><td COLSPAN='5' align= 'center' >ไม่มีข้อมูล</td></tr>";
                } else {
                  foreach ($schools as $school) {

                ?>
              </form>
              <tr>
                <th><?= $index++;
                    ['id']; ?></th>
                <td><?= $school['schoolname']; ?></td>
                <td><?= $school['schooladrees']; ?></td>
                <td>
                  <a href="editschool.php?id=<?= $school['id']; ?>" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">แก้ไข</a>
                </td>
                <td>
                  <a href="?delete=<?= $school['id']; ?>" onclick="return confirm('ยืนยันการลบ')" class="btn btn-danger btn-xs">ลบ</a>
                </td>
              </tr>

          <?php  }
                } ?>

            </tbody>
          </table>
        </div><br>
      </div>
    </div>
  </div>


</body>

</html>