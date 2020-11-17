<?php
  session_start();
  if(!isset($_SESSION['_IDCARD'])){
    header('Location: http://'.$_SERVER['SERVER_NAME'].'/main');
  }
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
    <nav class='navbar navbar-expand-lg navbar-light bg-white border-bottom' ng-controller='menuPage'>
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
            <a href='http://203.131.209.137/main' class='nav-link'> กลับสู่เมนูหลัก</a>
          </li>
        </ul>
        <span class='navbar-text text-uppercase border-left pl-3 text-success'>
        {{fullname}}
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/app.js"></script>
    <script src='js/controller.js'></script>
  </body>
</html>
