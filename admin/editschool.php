<?php

session_start();
require_once "../config/db.php";
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $schoolname = $_POST['schoolname'];
  $schooladrees = $_POST['schooladrees'];


  $sql = $conn->prepare("UPDATE school SET schoolname = :schoolname, schooladrees = :schooladrees WHERE id = :id");
  $sql->bindParam(":id", $id);
  $sql->bindParam(":schoolname", $schoolname);
  $sql->bindParam(":schooladrees", $schooladrees);

  $sql->execute();

  if ($sql) {
    $_SESSION['success'] = "แก้ไขเพิ่มข้อมูลเสร็จสิ้น";
    header("location:school.php");
  } else {
    $_SESSION['error'] = "แก้ไขข้อมูลล้มเหลว";
    header("location:school.php");
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

<body>
      <div class="card">
        <h1>แก้ไขโรงเรียน</h1>
      </div><br>
      <form action="editschool.php" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $stmt = $conn->query("SELECT * FROM school WHERE id = $id");
          $stmt->execute();
          $data = $stmt->fetch();
        }
        ?>
        <div class="form-group">
          <label for="schoolname">ชื่อโรงเรียน:</label>
          <input type="text" readonly value="<?= $data['id']; ?>" class="form-control" name="id">
          <input type="text" value="<?= $data['schoolname']; ?>" class="form-control" name="schoolname">
        </div>
        <div class="form-group">
          <label for="schooladrees">ที่อยู่โรงเรียน:</label>
          <input type="text" value="<?= $data['schooladrees']; ?>" class="form-control" name="schooladrees">
        </div>

        <a class="btn btn-danger" href="school.php">ปิด</a>
        <button type="submit" name="update" class="btn btn-default">บันทึก</button>
        <hr>
      </form>


</body>

</html>