<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-image: url(images/bg2.jpg);
    background-repeat: no-repeat;
    background-size: cover;">
  <div class="container-sm p-5 my-5 bg-white text-dark">
    <h3 class="mt-5">Login</h3>
    <hr>
    <form action="signin_db.php" method="post">
      <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
      <?php } ?>
      <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
          <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
          ?>
        </div>
      <?php } ?>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" aria-describedby="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
      </div>
      <button type="submit" name="signin" class="btn btn-primary">Signin</button>
    </form><br>
    <p>Click here to <a href="index.php">register</a></p>
    <hr>

    <div class="row">
      <div class="col-md">
        <div class="br-15"></div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">ปฏิทินการประเมินสมรรถนะ</a>
          </li>
        </ul>

        <div class="tab-pane fade li-title" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <li><a href="file/student_system.pdf" target="_blank">1. ปฏิทินการดำเนินการประเมินสมรรถนะ ประจำภาคการศึกษาที่ 1 ปีการศึกษา 2565</a></li>
          <li><a href="file/system.pdf" target="_blank">2. ปฏิทินการดำเนินการประเมินสมรรถนะ ประจำภาคการศึกษาที่ 2 ปีการศึกษา 2565</a></li>
        </div><br>
        <div class="col-md-5">
          <div class="br-15"></div>
          <div>
            <h5>ปฏิทิน</h5>
            <hr>
          </div>
          <iframe src="https://calendar.google.com/calendar/b/1/embed?height=316&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FBangkok&amp;src=Y29vcHNrcnVAZ21haWwuY29t&amp;src=dGgudGgjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%230B8043&amp;color=%23D50000&amp;showTitle=0&amp;showNav=1&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=1&amp;showTz=0" style="border-width:0" width="100%" height="316" frameborder="0" scrolling="no"></iframe>
        </div>
      </div>
    </div>

  </div>
</body>

</html>