<?php
session_start();
require_once "../../config/db.php";

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deletestmt = $conn->query("DELETE FROM class_room WHERE id_room = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
        header("refresh:1; url=class.php");
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
    <title>Class</title>
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
                </div><hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../admin.php">หน้าแรก</a></li>
                    <li><a href="../school.php">ข้อมูลโรงเรียน</a></li>
                    <li><a href="../director/director.php">ข้อมูลผู้อำนวยการ</a></li>
                    <li><a href="../teacher/teacher.php">ข้อมูลคุณครู</a></li>
                    <li class="active"><a href="class.php">เพิ่มห้อง</a></li>
                    <li><a href="../capacity/form.php">ตัวชี้วัดสมรรถนะ</a></li>
                    <li><a href="../date/t_date.php">ช่วงเวลาประเมิน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0"><br>
                    <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มห้อง</button>
                    <h2>ห้องเรียน</h2>
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
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM class_group");
                    $stmt->execute();
                    $class_g = $stmt->fetchAll();
                    ?>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM class");
                    $stmt->execute();
                    $class = $stmt->fetchAll();
                    ?>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <h2>เพิ่มห้อง</h2>
                                <form action="addclass.php" method="post" >
                                    <div class="form-group">
                                        <label for="schoolname">ห้องเรียน:</label>
                                        <input type="text" class="form-control" name="schoolname">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_class">ประถมศึกปีที่</label>
                                        <select name="id_class" class="form-control" required>
                                            <option value="">เลือก</option>
                                            <?php
                                            foreach ($class as $row) { ?>
                                                <option value="<?= $row['id_class']; ?>"><?= $row['name_class']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="class_group">ระดับ</label>
                                        <select name="class_group" class="form-control" required>
                                            <option value="">เลือก</option>
                                            <?php
                                            foreach ($class_g as $row) { ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['name_group']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="school_id">โรงเรียน</label>
                                        <select name="school_id" class="form-control" required>
                                            <option value="">เลือก</option>
                                            <?php
                                            foreach ($schools as $row) { ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['schoolname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-target="#myModal">ปิด</button>
                                    <button type="submit" name="submit" class="btn btn-default">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="8%">ลำดับที่</th>
                                <th>ห้องเรียน</th>
                                <th>ชั้นปี</th>
                                <th>โรงเรียน</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="school.php" method="get"> 
                                <?php
                                $index = 1;
                                $stmt = $conn->query("SELECT c.*, s.schoolname , g.name_class FROM class_room as c 
                                INNER JOIN school as s ON s.id = c.id_school 
                                INNER JOIN class as g on g.id_class = c.id_class");
                                $stmt->execute();
                                $class = $stmt->fetchAll();

                                if (!$class) {
                                    echo "<tr><td COLSPAN='5' align= 'center' >ไม่มีข้อมูล</td></tr>";
                                } else {
                                    foreach ($class as $room) {

                                ?>
                            </form>
                            <tr>
                                <th><?= $index++;
                                        ['id']; ?></th>
                                <td><?= $room['class_name']; ?></td>
                                <td><?= $room['name_class']; ?></td>
                                <td><?= $room['schoolname']; ?></td>
                                <td><a href="?delete_id=<?php echo $room['id_room']; ?>" onclick="return confirm('ยืนยันการลบ')" class="btn btn-danger btn-xs">ลบ</a></td>
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