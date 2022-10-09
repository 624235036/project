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
    $urole = $_POST['urole'];
    // $c_password = $_POST['c_password'];


    $sql = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname,  phone = :phone, email = :email, password = :password, urole = :urole  WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->bindParam(':firstname', $firstname);
    $sql->bindParam(':lastname', $lastname);
    $sql->bindParam(':phone', $phone);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':password', $password);
    $sql->bindParam(':urole', $urole);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "แก้ไขเพิ่มข้อมูลเสร็จสิ้น";
        header("location: teacher.php");
    } else {
        $_SESSION['error'] = "แก้ไขข้อมูลล้มเหลว";
        header("location: teacher.php");
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

    <div class="card" style="border-radius: 25px;">
        <h1>แก้ไขข้อมูลคุณครู</h1>
    </div><br>
    <form action="edit_teacher.php" method="post" enctype="multipart/form-data">
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
            <input type="text" hidden value="<?= $data['id']; ?>" class="form-control" name="id">
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
        <div class="form-group">
            <label for="urole">สถานะ:</label>
            <select name="urole">
                <option value="director">director</option>
                <option value="user">user</option>
            </select>
        </div>

        <a class="btn btn-danger" href="teacher.php">ปิด</a>
        <button type="submit" name="update" class="btn btn-default">บันทึก</button>
        <hr>
    </form>
</body>

</html>