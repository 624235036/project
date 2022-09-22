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
            background-color: #cdcd;
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
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <br>
                <div align="center">
                    <img src="https://png.pngtree.com/element_our/20190524/ourmid/pngtree-elementary-school-girl-going-to-school-cartoon-can-decorate-elements-image_1094339.jpg" height="150" class="img-circle" alt="Cinque Terre">
                </div><br>
                <div align="center">
                    <h4>ชื่อของใช้งาน</h4>
                </div><br>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="admin.php">หน้าแรก</a></li>
                    <li class="active"><a href="school.php">โรงเรียน</a></li>
                    <li><a href="#section3">ตัวชี้วัดสมรรถนะ</a></li>
                    <li><a href="#section3">ช่วงเวลาประเมิน</a></li>
                    <li><a href="http://localhost/project/signin.php">ออกจากระบบ</a></li>
                </ul><br>
            </div><br>


            <div class="p-2 col-md-3 text-center">
                <a href="director/director.php">
                    <!-- ยังคลิ็กไปไม่ได้ -->
                    <div class="btn-info box-container" style="padding-bottom:50%;"><br>
                        <div>ข้อมูลผู้อำนวยการ</div>
                    </div>
                </a>
            </div>
            <div class="p-2 col-md-3 text-center">   
            <?php
             if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = $conn->query("SELECT * FROM school WHERE id = $id");
                $stmt->execute();
                $data = $stmt->fetch();
              }
              ?>         
                <a href="teacher/teacher.php?id=<?= $data['id']; ?>" name="next">
                    <div class="btn-warning box-container" style="padding-bottom:50%;"><br>
                        <div>ข้อมูลคุณครู</div>
                    </div>
                </a> 
               
            </div>



</body>

</html>