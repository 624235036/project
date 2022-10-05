<?php

session_start();
require_once "../../config/db.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM tb_question WHERE id_question = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
        header("location:form.php");
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

<body style="background-color: #00008B;">

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <div align="center"><br>
                    <img src="../../images/icon.jpg" height="150" class="img-circle" alt="Cinque Terre">
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
                    <?php
                    if (isset($errorMsg)) {
                    ?>
                        <div class="alert alert-danger">
                            <strong>Wrong! <?php echo $errorMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($insertMsg)) {
                    ?>
                        <div class="alert alert-success">
                            <strong>Success! <?php echo $insertMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <h2>เพิ่มตัวชี้วัด</h2>
                                <form action="add.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="id_question">ลำดับ</label>
                                        <input type="text" class="form-control" name="id_question">
                                    </div>
                                    <div class="form-group">
                                        <label for="question">ตัวชี้วัด</label>
                                        <input type="text" class="form-control" name="question">
                                    </div>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-target="#myModal">ปิด</button>
                                    <button type="btn_insert" name="btn_insert" class="btn btn-default">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table  table-bordered">
                        <tr bgcolor="#F5FFFA">
                            <td width="20">&nbsp;</td>
                            <td colspan="8" align="center">ระบบประเมินสมรรถนะของผู้เรียนพื้นที่นวัตกรรมจังหวัดสตูล</td>
                        </tr><br>
                        <tr>
                            <th width="15" scope="col">ลำดับ</th>
                            <th width="350" scope="col">รายการประเมินตัวชี้วัด</th>
                            <th width="15" scope="col">มากที่สุด</th>
                            <th width="15" scope="col">มาก</th>
                            <th width="15" scope="col">ปานกลาง</th>
                            <th width="15" scope="col">น้อย</th>
                            <th width="15" scope="col">น้อยที่สุด</th>
                            <th width="75" scope="col">เครื่องมือ</th>
                        </tr>
                        <tbody>
                            <?php
                            $index = 1;
                            $select_stmt = $conn->prepare("SELECT q.*, h.name_header FROM form_question as q INNER JOIN form_header as h on h.id_header = q.id_header WHERE h.id_header = h.id_header  ");
                            $select_stmt->execute();
                            $data = $select_stmt->fetchAll();
                            if (!$data) {
                                echo "ไม่มี";
                            } else {
                                foreach ($data as $a) {
                            ?>

                                    <tr bgcolor="#cdcd">
                                        <td colspan="8" align="center"><?php echo $a["name_header"]; ?></td>
                                    </tr>

                                    <td><?php ["id_question == id_header"]; ?></td>
                                    <td><?php echo $a["question"]; ?></td>
                                    <td width="70" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_1" type="radio" value="5"></td>
                                    <td width="63" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_2" type="radio" value="4"></td>
                                    <td width="71" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_3" type="radio" value="3"></td>
                                    <td width="65" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_4" type="radio" value="2"></td>
                                    <td width="81" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_5" type="radio" value="1"></td>

                                    <td>
                                        <a href="edit.php?id_question=<?= $a['id_header']; ?>" title="Edit Data" class="btn btn-dark btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <!-- <a href="password.php?nik='.$row['nik'].'" title="Ganti Password" data-placement="bottom" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a> -->
                                        <a href="?delete=<?= $a['id_header']; ?>" title="Hapus Data" class="btn btn-dark btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    </td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button type="btn_insert" name="submit" class="btn btn-warning ">บันทึก</button>
            </div>
        </div>
    </div>




</body>

</html>