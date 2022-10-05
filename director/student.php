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
            /* background-color: #FFFFFF; */
            width: 1000px;
            /* height: 200px; */
            position: absolute;
            top: auto;
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
                    <li class="active"><a href="student.php">รายชื่อนักเรียน</a></li>
                    <li><a href="form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                    <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
                </ul><br>
            </div>
        </div>
    </div>

</body>