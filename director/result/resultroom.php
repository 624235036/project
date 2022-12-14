<?php

session_start();
require_once "../../config/db.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlQuery = $conn->query("SELECT `name_header`,class_room.id_room, class_room.class_name, users.firstname, users.lastname,avg(avgscore) as avgscore FROM scorestudent
    INNER JOIN class_room ON class_room.id_room = scorestudent.id_room
    INNER JOIN users ON users.id = scorestudent.id_teacher
    WHERE class_room.id_room = $id
    GROUP BY `name_header`, class_room.id_room, class_room.class_name, users.firstname, users.lastname");
    $sqlQuery->execute();
    $result = $sqlQuery->fetchAll();
}

//นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ 
$nameheardr = array();
$total = array();
foreach ($result as $rs) {
    $nameheardr[] = "\"" . $rs['name_header'] . "\"";
    $total[] = "\"" . $rs['avgscore'] . "\"";
}

//ตัด commar อันสุดท้ายโดยใช้ implode เพื่อให้โครงสร้างข้อมูลถูกต้องก่อนจะนำไปแสดงบนกราฟ
$nameheardr = implode(",", $nameheardr);
$total = implode(",", $total);


?>

<html>

<head>
  <title>Class Room CHART</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <!-- call js -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
  <style>
    body{
      margin: 0;
      margin-top: 50px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12"> <br>
      <a class="btn btn-warning" href="../result/result.php">ย้อนกลับ</a>
      <h3 align="center">รายงานภาพรวมสมรรถนะ 5 ด้าน</h3>
        <h5 align="center">(คุณครู <?php if(!$result) {echo'ไม่พบข้อมูล';}elseif($rs) {echo $rs['firstname'] .'&nbsp;'. $rs['lastname'] .'&nbsp;ห้องเรียน&nbsp;'. $rs['class_name']; }?>)</h5>
        <canvas id="myChart" width="800px" height="300px"></canvas>
        <script>
          var ctx = document.getElementById("myChart").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
              labels: [<?php echo $nameheardr; ?>

              ],
              datasets: [{
                label: 'รายงานภาพรวม แยกตามปี (บาท)',
                data: [<?php echo $total; ?>],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              }
            }
          });
        </script>
      </div>
    </div>
  </div>
</body>

</html>