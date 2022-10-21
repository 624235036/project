<?php

session_start();
require_once "../../config/db.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM form_question WHERE id_queustion = $delete_id");
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
            width: 990px;
            /* height: 200px; */
            position: absolute;
            top: 20%;
            left: 25%;
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

<body style="background-color: #ffff;">

    <div class="container-fluid">
        <div class="row content">
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0">
                    <form action="save.php" method="post">
                        <table class="table  table-bordered">
                            <tr bgcolor="#F5FFFA">
                                <!-- <td width="25">&nbsp;</td> -->
                                <td colspan="10" align="center">ระบบประเมินสมรรถนะของผู้เรียนพื้นที่นวัตกรรมจังหวัดสตูล</td>
                            </tr><br>
                            <tr>
                                <th width="5%" scope="col">ลำดับ</th>
                                <th width="40%" scope="col">รายการประเมินตัวชี้วัด</th>
                                <th width="5%" scope="col">มากที่สุด</th>
                                <th width="5%" scope="col">มาก</th>
                                <th width="5%" scope="col">ปานกลาง</th>
                                <th width="5%" scope="col">น้อย</th>
                                <th width="5%" scope="col">น้อยที่สุด</th>
                                <!-- <th width="10%" scope="col">เครื่องมือ</th> -->
                            </tr>
                            
                            <tbody>
                                <?php
                                if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $check = array();
                                $index_h = 0;
                                $select_stmt = $conn->prepare("SELECT c.*, q.*, s.* FROM score as c INNER JOIN form_question as q on q.id_queustion = c.id_question 
                                                                INNER JOIN student as s on s.id_student = c.id_student 
                                                                WHERE c.id_student = $id");
                                $select_stmt->execute();
                                while ($data = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $index_h++;
                                    $question = $data['question'];
                                    $id_queustion = $data['id_queustion'];
                                    $check = array('', '', '', '', '','');
                                    $check[$data['score']] = "checked=checked";

                                ?>
                                    
                                        <tr>
                                            <td><?= $index_h; ?></td>
                                            <td><?= $question; ?></td>
                                            <td width="5%" align="center"><input type="radio" name="radionNo<?= $id_queustion; ?>"  <?=$check[5]; ?> ></td>
                                            <td width="5%" align="center"><input type="radio" name="radionNo<?= $id_queustion; ?>"  <?=$check[4]; ?> ></td>
                                            <td width="5%" align="center"><input type="radio" name="radionNo<?= $id_queustion; ?>"  <?=$check[3]; ?> ></td>
                                            <td width="5%" align="center"><input type="radio" name="radionNo<?= $id_queustion; ?>"  <?=$check[2]; ?> ></td>
                                            <td width="5%" align="center"><input type="radio" name="radionNo<?= $id_queustion; ?>"  <?=$check[1]; ?> ></td>

                                    <?php }                         
                                }
                                  ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>