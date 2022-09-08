<?php

    session_start();
    require_once "../config/db.php";


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
    .modal-content{
      margin: 20px;
      padding: 20px;
    }

  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav" >
        <div align ="center">
        <img src="https://png.pngtree.com/element_our/20190524/ourmid/pngtree-elementary-school-girl-going-to-school-cartoon-can-decorate-elements-image_1094339.jpg" height="150" class="img-circle" alt="Cinque Terre">
        </div>
        <h4>ชื่อของใช้งาน</h4>
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="admin.php">หน้าแรก</a></li>
          <li><a href="school.php">โรงเรียน</a></li>
          <li><a href="#section3">ตัวชี้วัดสมรรถนะ</a></li>
          <li><a href="#section3">ช่วงเวลาประเมิน</a></li>
          <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
        </ul><br>
      </div><br>

      <div class="col-sm-9">
        <div class="container">
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">เพิ่มโรงเรียน</button>
          <hr>
          <?php if (isset($_SESSION['success'])) {?>
              <div class = "alert alert-succes">
                <?php 
                  echo $_SESSION['success'];
                  unset($_SESSION['succes']);
                ?>
              </div>
          <?php }?>
          <?php if (isset($_SESSION['error'])) {?>
              <div class = "alert alert-danger">
                <?php 
                  echo $_SESSION['error'];
                  unset($_SESSION['error']);
                ?>
              </div>
          <?php }?>

          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content" >
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
                  <div class="form-group">
                    <label for="img">รูปภาพ:</label>
                    <input type="file" class="form-control" id="imgInput" name="img">
                    <img width="100%" id="previewImg" alt="">
                  </div>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </form>
              </div>
            </div>
          </div>

          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>โรงเรียน</th>
                <th>ที่อยู่</th>
                <th>รูปภาพ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $stmt = $conn->query("SELECT * FROM school");
                $stmt->execute();
                $schools = $stmt->fetchAll();

                if (!$schools) {
                  echo "<tr><td> colspan='6' class='text-center'>NO school found</td></tr>";
                }else {
                  foreach ($schools as $school) {

                 
              ?>

              <tr>
                <th scope="row"><?= $school['id']; ?></th>
                <td><?= $school['schoolname']; ?></td>
                <td><?= $school['schooladrees']; ?></td>
                <td width="250px"><img width="100%" src="uploads/<?= $school['img']; ?>" class= "rounded" alt=""></td>
                <td>
                    <a href="editschool.php?id=<?= $school['id'];?>" class="btn btn-warning">แก้ไข</a>
                </td>
                <td>
                    <a href="?delete=<?= $school['id'];?>" class="btn btn-danger">ลบ</a>
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

  <footer class="container-fluid">
    <p>Footer Text</p>
  </footer>

  <script>
    let imgInput = document.getElementById('imgInput');
    let previewImg = document.getElementById('previewImg');

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file){
        previewImg.src = URL.createObjectURL(file);
      }
    }

  </script>

</body>

</html>