<?php
  session_start();
  $_session['user'] = 'รศ.พ สมคิด นามสมมุติ';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
    <title>Faculty Of Medicine Thammasat University</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel='stylesheet' href='../../css/fontawesome-all.css'>
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='css/style.css'>
  </head>
  <body ng-app='app'>
    <nav class='navbar navbar-expand-lg navbar-light bg-white border-bottom'>
      <a class='navbar-brand' href='#'>
        <img src='logomedtu.png' style='height:30px;'>
        ระบบขออนุมัติตัวบุคคล
      </a>

      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarbookno'>
        <span class='navbar-toggler-icon'>
      </button>
      <div class='collapse navbar-collapse' id='navbarbookno'>
        <ul class='navbar-nav ml-auto'>
          <li class='nav-item'>
            <a href='#' class='nav-link'> หน้าแรก</a>
          </li>
          <li class='nav-item'>
            <a href='#/add' class='nav-link'> เพิ่มข้อมูล</a>
          </li>
          <li class='nav-item'>
            <a href='#' class='nav-link'> ออกจากระบบ</a>
          </li>
        </ul>
        <span class='navbar-text text-uppercase border-left pl-3 text-success'>
          <?php
            echo $_session['user'];
          ?>
        </span>
      </div>
    </nav>

    <div class='container-fluid'>
      <div ng-view></div>
    </div>


    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src='../../js/angular.min.js'></script>
    <script src='../../js/angular-animate.min.js'></script>
    <script src='../../js/angular-touch.min.js'></script>
    <script src='../../js/angular-route.min.js'></script>
    <script src='../../js/angular-sanitize.min.js'></script>
    <script src='../../js/ui-bootstrap-3.0.6.min.js'></script>
    <script src="js/app.js"></script>
    <script src='js/controller.js'></script>
  </body>
</html>
