<nav class='navbar navbar-expand-lg navbar-light bg-white border-bottom'>
    <a class='navbar-brand' href='#'>
        <img src='img/med_logo.png' style='height:30px;'>
        ระบบขออนุมัติตัวบุคคล
    </a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarbookno'>
        <span class='navbar-toggler-icon'>
    </button>
    <div class='collapse navbar-collapse' id='navbarbookno'>
        <ul class='navbar-nav ml-auto'>
            <li class='nav-item'>
                <a href='./' class='nav-link'> หน้าแรก</a>
            </li>
            <li class='nav-item'>
                <a href='./_index.php#/add' class='nav-link'> เพิ่มข้อมูล</a>
            </li>
            <li class='nav-item'>
                <a href='./' class='nav-link'> ออกจากระบบ</a>
            </li>
        </ul>
        <span class='navbar-text text-uppercase border-left pl-3 text-success'>
            <?php
            echo $_SESSION['user'];
          ?>
        </span>
    </div>
</nav>