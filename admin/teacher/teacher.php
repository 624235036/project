<?php

session_start();
require_once "../../config/db.php";

if (isset($_REQUEST['delete_id'])) {
  $id = $_REQUEST['delete_id'];

  $select_stmt = $conn->prepare("SELECT * FROM tbl_teacher WHERE id = :id");
  $select_stmt->bindParam(':id', $id);
  $select_stmt->execute();
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

  // Delete an original record from db
  $delete_stmt = $conn->prepare('DELETE FROM tbl_teacher WHERE id = :id');
  $delete_stmt->bindParam(':id', $id);
  $delete_stmt->execute();

  header('Location:director.php');
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
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 1500px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
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
  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <div align="center"><br>
          <img src="https://png.pngtree.com/element_our/20190524/ourmid/pngtree-elementary-school-girl-going-to-school-cartoon-can-decorate-elements-image_1094339.jpg" height="150" class="img-circle" alt="Cinque Terre">
        </div>
        <h4>ชื่อของใช้งาน</h4>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="../admin.php">หน้าแรก</a></li>
          <li class="active"><a href="../school.php">โรงเรียน</a></li>
          <li><a href="#section3">ตัวชี้วัดสมรรถนะ</a></li>
          <li><a href="#section3">ช่วงเวลาประเมิน</a></li>
          <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
        </ul><br>
      </div><br>

      <div class="col-sm-9">

        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">เพิ่มคุณครู</button>
        <hr>
        <?php if (isset($_SESSION['success'])) { ?>
          <div class="alert alert-succes">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['succes']);
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
              <h2>เพิ่มคุณครู</h2>
              <form action="add_teacher.php" method="post" >
                <div class="form-group">
                  <label for="firstname">ชื่่อ</label>
                  <input type="text" class="form-control" name="firstname">
                </div>
                <div class="form-group">
                  <label for="lastname">นามสกุล</label>
                  <input type="text" class="form-control" name="lastname">
                </div>
                <div class="form-group">
                  <label for="phone">เบอร์โทร</label>
                  <input type="text" class="form-control" name="phone">
                </div>
                <div class="form-group">
                  <label for="email">อีเมล</label>
                  <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                  <label for="password">รหัสผ่าน:</label>
                  <input type="text" class="form-control" name="password">
                </div>
                <div class="form-group">
                  <label for="password">ยืนยันรหัสผ่าน:</label>
                  <input type="text" class="form-control" name="c_password">
                </div>
                <div class="form-group">
                            <label for="urole">สถานะ:</label>
                            <select name="urole">
                                <option value="director">director</option>
                                <option value="user">user</option>
                            </select>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
          </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>ลำดับที่</th>
              <th>ตำแหน่ง</th>
              <th>ชื่อโรงเรียน</th>
              <th>ชื่่อ</th>
              <th>นามสกุล</th>
              <th>เบอร์โทร</th>
              <th>อีเมล</th>
              <th>รหัสผ่าน</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $index = 1;
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $stmt = $conn->query("SELECT u.*, s.schoolname FROM users as u INNER JOIN school as s ON s.id = u.school_id WHERE s.id = $id ORDER BY s.id asc ");
              $stmt->execute();
              $data = $stmt->fetchAll();

              if (!$data) {
                echo "ไม่มีข้อมูล";
              } else {
                foreach ($data as $school) {
            ?>
                  <tr>
                    <td><?= $index++; ?></td>
                    <td><?= $school['urole']; ?></td>
                    <td><?= $school['schoolname']; ?></td>
                    <td><?= $school['firstname']; ?></td>
                    <td><?= $school['lastname']; ?></td>
                    <td><?= $school['phone']; ?></td>
                    <td><?= $school['email']; ?></td>
                    <td><?= $school['password']; ?></td>
                    <td>
                      <a href="edit_teacher.php?id=<?= $school['id']; ?>" class="btn btn-warning">แก้ไข</a>
                    <td><a href="?delete_id=<?php echo $school["id"]; ?>" class="btn btn-danger">ลบข้อมูล</a></td>
                    </td>
                  </tr>
            <?php  }
              }
            } ?>
          </tbody>
        </table>

      </div>



</body>

</html>