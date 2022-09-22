<?php

session_start();
require_once "../../config/db.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $c_password = $_POST['c_password'];
    

$sql = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname,  phone = :phone, email = :email, password = :password  WHERE id = :id");
$sql->bindParam(':id', $id);
$sql->bindParam(':firstname', $firstname);
$sql->bindParam(':lastname', $lastname);
$sql->bindParam(':phone', $phone);
$sql->bindParam(':email', $email);
$sql->bindParam(':password', $password);
$sql->execute();

if ($sql) {
    $_SESSION['success'] = "แก้ไขเพิ่มข้อมูลเสร็จสิ้น";
    header("location: director.php");
  } else {
    $_SESSION['error'] = "แก้ไขข้อมูลล้มเหลว";
    header("location: director.php");
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
                <div align="center">
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
                <div class="container" style="background-color: #cdcdcd;">
                    <div class="card" style="border-radius: 25px;">
                        <h1 class="container-">แก้ไขข้อมูลผู้อำนวยการ</h1>
                    </div><br>
                    <form action="edit_director.php" method="post" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $stmt = $conn->query("SELECT * FROM users WHERE id = $id");
                            $stmt->execute();
                            $data = $stmt->fetch();
                        }
                        ?>
                        <div class="form-group">
                            <label for="firstname">ชื่่อ</label>
                            <input type="text" readonly value="<?= $data['id']; ?>" class="form-control" name="id">
                            <input type="text" value="<?= $data['firstname']; ?>" class="form-control" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname">นามสกุล</label>
                            <input type="text" value="<?= $data['lastname']; ?>" class="form-control" name="lastname">
                        </div>
                        <div class="form-group">
                            <label for="phone">เบอร์โทร</label>
                            <input type="text" value="<?= $data['phone']; ?>" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="text" value="<?= $data['email']; ?>" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน:</label>
                            <input type="text" value="<?= $data['password']; ?>" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password">ยืนยันรหัสผ่าน:</label>
                            <input type="text" value="<?= $data['password']; ?>" class="form-control" name="password">
                        </div>
                        <a class="btn btn-danger" href="director.php">ปิด</a>
                        <button type="submit" name="update" class="btn btn-default">บันทึก</button>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>