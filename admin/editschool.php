<?php

session_start();
require_once "../config/db.php";
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $schoolname = $_POST['schoolname'];
  $schooladrees = $_POST['schooladrees'];
  $img = $_FILES['img'];

  $img2 = $_POST['img2'];
  $upload = $_FILES['img'];

  if ($upload) {
    $allow = array('jpg', 'jpec', 'png');
    $extension = explode(".", $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "uploads/" . $fileNew;

    if (in_array($fileActExt, $allow)) {
      if ($img['size'] > 0 && $img['error'] == 0) {
        (move_uploaded_file($img['tmp_name'], $filePath));
      }
    } else {
      $fileNew = $img2;
    }

    $sql = $conn->prepare("UPDATE school SET schoolname = :schoolname, schooladrees = :schooladrees, img = :img WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":schoolname", $schoolname);
    $sql->bindParam(":schooladrees", $schooladrees);
    $sql->bindParam(":img", $fileNew);
    $sql->execute();

    if ($sql) {
      $_SESSION['success'] = "แก้ไขเพิ่มข้อมูลเสร็จสิ้น";
      header("location: school.php");
    } else {
      $_SESSION['error'] = "แก้ไขข้อมูลล้มเหลว";
      header("location: school.php");
    }
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
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 1000px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #cdcd;
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

    .container {
      max-width: 550px;
      border-radius: 25px;
    }
  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <br>
        <div align="center">
          <img src="https://png.pngtree.com/element_our/20190524/ourmid/pngtree-elementary-school-girl-going-to-school-cartoon-can-decorate-elements-image_1094339.jpg" height="150" class="img-circle" alt="Cinque Terre">
        </div><br>
        <div align="center">
          <h4>ชื่อของใช้งาน</h4>
        </div><br>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="admin.php">หน้าแรก</a></li>
          <li class="active"><a href="school.php">โรงเรียน</a></li>
          <li><a href="#section3">ตัวชี้วัดสมรรถนะ</a></li>
          <li><a href="#section3">ช่วงเวลาประเมิน</a></li>
          <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
        </ul><br>
      </div><br>

      <div class="col-sm-9">
        <div class="container" style="background-color: #cdcdcd;">
          <div class="card" style="background-color: #5d8d73;" style="border-radius: 25px;">
            <h1 class="container-">แก้ไขโรงเรียน</h1>
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
              <input type="hidden" value="<?= $data['img']; ?>" class="form-control" name="img2">
            </div>
            <div class="form-group">
              <label for="schooladrees">ที่อยู่โรงเรียน:</label>
              <input type="text" value="<?= $data['schooladrees']; ?>" class="form-control" name="schooladrees">
            </div>
            <div class="form-group">
              <label for="img">รูปภาพ:</label>
              <input type="file" class="form-control" id="imgInput" name="img">
              <img width="100%" src="uploads/<?= $data['img']; ?>" id="previewImg" alt="">
            </div>
            <a class="btn btn-danger" href="school.php">ปิด</a>
            <button type="submit" name="update" class="btn btn-default">บันทึก</button>
            <hr>
          </form>



        </div>
      </div>


    </div>
  </div>

  <footer class="container-fluid">
    <p>Footer Text</p>
  </footer>

  <script>
    let imgInput = document.getElementById('imgInput');
    let previewImg = document.getElementById('previewImg');

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file) {
        previewImg.src = URL.createObjectURL(file);
      }
    }
  </script>

</body>

</html>