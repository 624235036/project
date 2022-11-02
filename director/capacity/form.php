<?php

session_start();
require_once "../../config/db.php";


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../style.css" type="text/css" />
    <link rel="stylesheet" href="../../newstyle.css" type="text/css" />
</head>

<body style="background-color: #F5F5DC;">

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
                    <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <div align="center"><br>
                    <img src="../../images/icon2.png" height="100" class="img-circle" alt="Cinque Terre">
                </div>
                <div align="center">
                    <?php
                    if (isset($_SESSION['director_login'])) {
                        $user_id = $_SESSION['director_login'];
                        $stmt = $conn->query("SELECT u.*, s.schoolname FROM users as u INNER JOIN school as s on s.id = u.school_id WHERE u.id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <h4 class="mt-4"> <?php echo  $row['schoolname']; ?></h4>
                    <h4 class="mt-4">ผู้อำนวยการ <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h4>
                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../director.php">หน้าแรก</a></li>
                    <li><a href="../teacher.php">รายชื่อครูประจำชั้น</a></li>
                    <li class="active"><a href="form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li><a href="../result/result.php">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="../resultclass/result.php">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="../resultschool.php">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0">
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                            </div>
                        </div>
                    </div>
                    <table class="table  table-bordered">
                        <tr bgcolor="#F5FFFA">
                            <!-- <td width="25">&nbsp;</td> -->
                            <td colspan="10" align="center">ระบบประเมินสมรรถนะของผู้เรียนพื้นที่นวัตกรรมจังหวัดสตูล</td>
                        </tr><br>
                        <tr>

                            <!-- <th width="25%" scope="col">หัวข้อตัวชี้วัด</th> -->
                            <th width="5%" scope="col">ลำดับ</th>
                            <th width="40%" scope="col">รายการประเมินตัวชี้วัด</th>
                            <th width="5%" scope="col">มากที่สุด</th>
                            <th width="5%" scope="col">มาก</th>
                            <th width="5%" scope="col">ปานกลาง</th>
                            <th width="5%" scope="col">น้อย</th>
                            <th width="5%" scope="col">น้อยที่สุด</th>
                            <th width="5%" scope="col">เครื่องมือ</th>
                        </tr>
                        <?php
                        $index_h = 0;
                        $index = 1;
                        $select_stmt = $conn->prepare("SELECT * FROM form_header");
                        $select_stmt->execute();
                        $data1 = $select_stmt->fetchAll();
                        foreach ($data1 as $h) {
                            $index_h++;

                            $id_header = $h["id_header"];
                        ?>
                            <tr>
                                <td BGCOLOR=#E0E0E0 COLSPAN='8'><?php echo $h["name_header"]; ?></td>
                            </tr>
                            <th hidden>
                                <a href="edit_h.php?id_header=<?= $h['id_header']; ?>" title="Edit Data" class="btn btn-dark btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="?delete=<?= $h['id_header']; ?>" title="Hapus Data" class="btn btn-dark btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            </th>


                            <tbody>
                                <?php
                                $index_h = $index;
                                $select_stmt = $conn->prepare("SELECT * FROM form_question WHERE id_header = '$id_header'");
                                $select_stmt->execute();
                                $data = $select_stmt->fetchAll();
                                if (!$data) {
                                    echo "ไม่มี";
                                } else {

                                    foreach ($data as $a) {
                                        $index++;

                                ?>
                                        <!-- วนสloop หัวข้อย่อย -->
                                        <tr>
                                            <td><?= $index_h++;
                                                ["id_queustion"]; ?></td>
                                            <td><?php echo $a["question"]; ?></td>
                                            <td width="5%" align="center"><input name="radionNo<?= $a['id_queustion']; ?>" id="radionNo1<?= $i; ?>_1" type="radio" value="5" required="required" /></td>
                                            <td width="5%" align="center"><input name="radionNo<?= $a['id_queustion']; ?>" id="radionNo2<?= $i; ?>_2" type="radio" value="4"></td>
                                            <td width="5%" align="center"><input name="radionNo<?= $a['id_queustion']; ?>" id="radionNo3<?= $i; ?>_3" type="radio" value="3"></td>
                                            <td width="5%" align="center"><input name="radionNo<?= $a['id_queustion']; ?>" id="radionNo4<?= $i; ?>_4" type="radio" value="2"></td>
                                            <td width="5%" align="center"><input name="radionNo<?= $a['id_queustion']; ?>" id="radionNo5<?= $i; ?>_5" type="radio" value="1"></td>
                                            <td>

                                                <a href="edit.php?id_queustion=<?= $a['id_queustion']; ?>" title="Edit Data" class="btn btn-dark btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        </tr>
                                        <?
                                        $i++;
                                        ?>

                                        </td>
                                        </tr>

                                <?php

                                    }
                                }
                                ?>
                            <?php
                        }
                            ?>
                            </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>








</body>