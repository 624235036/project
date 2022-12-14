<?php
session_start();
require_once "../../config/db.php";

if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $select_stmt->bindParam(':id', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    // Delete an original record from db
    $delete_stmt = $conn->prepare('DELETE FROM users WHERE id = :id');
    $delete_stmt->bindParam(':id', $id);
    $delete_stmt->execute();

    if ($delete_stmt) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
        header("refresh:1; url=director.php");
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
    <title>Director</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../style.css" type="text/css" />
    <link rel="stylesheet" href="../../newstyle.css" type="text/css" />
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
                    <li><a href="../../index.php"><span class="glyphicon glyphicon-log-out"></span> ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <div align="center"><br>
                    <img src="../../images/icon.jpg" height="100" class="img-circle" alt="Cinque Terre">
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
                    <li><a href="../admin.php">หน้าแรก</a></li>
                    <li><a href="../school.php">ข้อมูลโรงเรียน</a></li>
                    <li class="active"><a href="director.php">ข้อมูลผู้อำนวยการ</a></li>
                    <li><a href="../teacher/teacher.php">ข้อมูลคุณครู</a></li>
                    <li><a href="../class/class.php">เพิ่มห้อง</a></li>
                    <li><a href="../capacity/form.php">ตัวชี้วัดสมรรถนะ</a></li>
                    <li><a href="../date/t_date.php">ช่วงเวลาประเมิน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0"><br>
                    <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มผู้อำนวยการ</button>
                    <h2>ข้อมูลผู้อำนวยการ</h2>
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
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM school");
                    $stmt->execute();
                    $schools = $stmt->fetchAll();
                    ?>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <h2>เพิ่มผู้อำนวยการ</h2>
                                <form action="add_director.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">คำนำหน้า:</label>
                                        <select name="title" class="form-control">
                                            <option value="">เลือก</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
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
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">ยืนยันรหัสผ่าน:</label>
                                        <input type="password" class="form-control" name="c_password">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="urole">ตำแหน่ง:</label>
                                        <select name="urole" class="form-control">
                                            <option value="director">director</option>
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
                                    </div>
                                    <a class="btn btn-danger" href="director.php">ปิด</a>
                                    <button type="submit" name="signup" class="btn btn-primary">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>คำนำหน้า</th>
                                <th>ชื่่อ</th>
                                <th>นามสกุล</th>
                                <th>เบอร์โทร</th>
                                <th>อีเมล</th>
                                <!-- <th>รหัสผ่าน</th> -->
                                <!-- <th>ตำแหน่ง</th> -->
                                <th>โรงเรียน</th>
                                <th>แก้ไข</th>
                                <th width="10" scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            $stmt = $conn->query("SELECT u.*, s.schoolname FROM users as u INNER JOIN school as s ON s.id = u.school_id  WHERE urole = 'director'");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            if (!$result) {
                                echo "<tr><td COLSPAN='9' align= 'center' >ไม่มีข้อมูล</td></tr>";
                            } else {
                                foreach ($result as $a) {
                                    // $stmt = $conn->query("SELECT u.*, s.schoolname FROM users as u INNER JOIN school as s ON s.id = u.school_id WHERE s.id = $id ORDER BY s.id asc ");


                            ?>
                                    <tr>
                                        <td><?= $index++; ?></td>
                                        <td><?= $a['title']; ?></td>
                                        <td><?= $a['firstname']; ?></td>
                                        <td><?= $a['lastname']; ?></td>
                                        <td><?= $a['phone']; ?></td>
                                        <td><?= $a['email']; ?></td>
                                        <!-- <td><?= strlen($a['password']); ?></td> -->
                                        <!-- <td><?= $a['urole']; ?></td> -->
                                        <td><?= $a['schoolname']; ?></td>

                                        <td>
                                            <a href="edit_director.php?id=<?= $a['id']; ?>" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">แก้ไข</a>
                                        <td><a href="?delete_id=<?php echo $a["id"]; ?>" onclick="return confirm('ยืนยันการลบ')" class="btn btn-danger btn-xs">ลบ</a></td>
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

</body>

</html>