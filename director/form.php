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
        body {

            line-height: 22px;
            margin: 0;

            -webkit-font-smoothing: antialiased !important;
        }

        .container {
            background-color: #FFFFFF;
            width: 850px;
            /* height: 200px; */
            position: absolute;
            top: 20%;
            left: 40%;
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
            margin-left: auto;
            margin-right: auto
        }
    </style>
</head>

<body style="background-color: #FAFAD2;">

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <div align="center"><br>
                    <img src="../images/icon2.png" height="150" class="img-circle" alt="Cinque Terre">
                </div>
                <h4>ชื่อของใช้งาน</h4>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="director.php">หน้าแรก</a></li>
                    <li><a href="#">รายชื่อครูประจำชั้น</a></li>
                    <li><a href="student.php">รายชื่อนักเรียน</a></li>
                    <li class="active"><a href="form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                    <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <!-- <form name="frmMain" method="post" action="save.php" OnSubmit="return fncSubmit();"> -->
                <table class="table  table-bordered">
                    <tr bgcolor="#F5FFFA">
                        <td width="20">&nbsp;</td>
                        <td colspan="8" align="center">ระบบประเมินสมรรถนะของผู้เรียนพื้นที่นวัตกรรมจังหวัดสตูล</td>
                    </tr><br>
                    <!-- <thead> -->
                    <tr>
                        <th width="20" scope="col">ลำดับ</th>
                        <!-- <th width="150"scope="col">หัวข้อ</th> -->
                        <th width="350" scope="col">รายการประเมินตัวชี้วัด</th>
                        <th width="20" scope="col">มากที่สุด</th>
                        <th width="20" scope="col">มาก</th>
                        <th width="20" scope="col">ปานกลาง</th>
                        <th width="20" scope="col">น้อย</th>
                        <th width="20" scope="col">น้อยที่สุด</th>
                    </tr>
                    <!-- </thead> -->
                    <tbody>
                        <?php
                        $select_stmt = $conn->prepare("SELECT * FROM tb_question");
                        $select_stmt->execute();

                        while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <!-- <tr bgcolor="#CCCCCC">
                                <td width="20">&nbsp;</td>
                                <td colspan="8" align="center">ระบบประเมินสมรรถนะของผู้เรียนพื้นที่นวัตกรรมจังหวัดสตูล</td>
                            </tr><br>
                            <tr> -->
                            <!-- <td scope="row"></td> -->
                            <td><?php echo $row["id_question"]; ?></td>
                            <!-- <td>#</td> -->
                            <td><?php echo $row["question"]; ?></td>
                            <td width="70" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_1" type="radio" value="5"></td>
                            <td width="63" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_2" type="radio" value="4"></td>
                            <td width="71" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_3" type="radio" value="3"></td>
                            <td width="65" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_4" type="radio" value="2"></td>
                            <td width="81" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_5" type="radio" value="1"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- <table width="950" border="0" align="center" cellpadding="2" cellspacing="2">
                  
                </table> -->

                <!-- <button type="button" href="save.php" class="btn btn-primary">เพิ่ม</button> -->
                <!-- <a href="add.php" class="btn btn-primary">เพิ่ม</a>
                <a href="#" class="btn btn-danger">ลบ</a>
                <a href="edit.php" class="btn btn-warning">แก้ไข</a> -->


                <!-- </form> -->
            </div>
        </div>
    </div>








</body>