<?php
    session_start();
    if(!isset($_SESSION['_IDCARD'])){
        header('Location: http://'.$_SERVER['SERVER_NAME'].'/main');
    }
    require_once('function.php');
    include "modal/view_modal.php";


  $data = new DB_con();

  // FETCH DATA SHOW
  $sql = $data->fetch_data();
  $num = mysqli_num_rows($sql);
    
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">

    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/themes/semantic.min.css">
</head>

<body>  
<div class='row'>

    <div class='col-md-4 mt-3'>
        <div class='card rounded-0' style='border-left:10px solid #6E6E6E;'>
            <div class='card-body'>
                <h5 class='card-title'>รอการอนุมัติ</h5>
                <h6 class='card-subtitle'>{{countWait}} รายการ</h6>
            </div>
        </div>
        
    </div>
    <div class='col-md-4 mt-3'>
        <div class='card rounded-0' style='border-left:10px solid #2ECCFA;'>
            <div class='card-body'>
                <h5 class='card-title'>ขอยกเลิก</h5>
                <h6 class='card-subtitle'>{{countcancel}} รายการ</h6>
            </div>
        </div>
    </div>
    <div class='col-md-4 mt-3'>
        <div class='card rounded-0' style='border-left:10px solid #FF5757;'>
            <div class='card-body'>
                <h5 class='card-title'>ไม่อนุมัติ</h5>
                <h6 class='card-subtitle'>{{countDis}} รายการ</h6>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-md-4 mt-3'>
                <form class='form-inline'>
                    <select class='form-control form-control-sm rounded-0'>
                        <option value='id_train'>รหัสเรื่อง</option>
                        <option value=''>ชื่อเรื่อง</option>
                        <option value=''>ชื่อผู้ขออนุมัติ</option>
                    </select>
                    <input type='text' placeholder='ค้นหา' class='form-control rounded-0 form-control-sm'>
                    <button type='button' class='btn btn-info rounded-0 btn-sm'><i class=" fa fa-search"></i></button>
 
                </form>

    </div>
</div>
        <hr>
        <table class="table table-bordered border mt-3" id="table_show">
            <thead class="table-secondary">
                <tr class="text-center">
                    <th width="30px">#</th>
                    <th>รหัสเรื่อง</th>
                    <th>ชื่อเรื่อง</th>
                    <th>ผู้จัด</th>
                    <th>วันที่ไป</th>
                    <th>สถานะ</th>
                    <th>รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                <?$i = 1;if($num > 0){
                    while($row = mysqli_fetch_assoc($sql)){?>
                <tr class="text-center">
                    <td><?= $i;?></td>
                    <td><?= $row['training_num'];?></td>
                    <td><?= $row['present_name'];?> </td>
                    <td><?= $row['institute_name'];?></td>
                    <td><?= date('d-m-Y',strtotime($row['start_date']))." ถึง ".date('d-m-Y',strtotime($row['end_date']));?>
                    </td>
                    <td width="100px">
                        <?if($row['cancel_status'] == 0){?>
                        <input type="button" value="รอตรวจสอบ" name="cancel_status"
                            class="btn btn-sm btn-block btn-warning" disabled />
                        <?}else if ($row['cancel_status'] == 1){?>
                        <input type="button" value="อนุมัติ" name="cancel_status"
                            class="btn btn-sm btn-block btn-success" disabled />
                        <?}else if ($row['cancel_status'] == 2){?>
                        <input type="button" value="ยกเลิก" name="cancel_status" class="btn btn-sm btn-block btn-danger"
                            disabled />
                        <?}else{
                                ?>
                        <input type="button" value="ไม่อนุมัติ" name="cancel_status"
                            class="btn btn-sm btn-block btn-danger" disabled />
                        <?}?>
                    </td>
                    <td width="150px" class="text-center">
                        <button class="btn btn-primary btn-sm view_details" data-toggle="modal"
                            data-target="#details_event" id="<?= $row['ID'];?>"><i class=" fa fa-list"
                                aria-hidden="true" name="btn_view"></i>
                            รายละเอียด</button>
                    </td>
                </tr>
                <?$i++;
                        }
                }?>
            </tbody>
        </table>
    




    <script>
    $(document).ready(function() {
        id_ = '';
        // dataTable Config 
        $('#table_show').DataTable({
            "pagingType": "full_numbers",
            "bLengthChange": false,
            "ordering": true, // Allows ordering
            "searching": false, // Searchbox
            "paging": true, // Pagination
            "bInfo": false, // Shows 'Showing X of X' information
            "pageLength": 10, // Defaults number of rows to display in table
            "dom": '<"top"f>rt<"bottom"lp><"clear">', // Positions table elements
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            "fnDrawCallback": function() {
                $("input[type='search']").attr("id", "searchBox");
                $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
                $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
                $('#searchBox').css("width", "500px");
                $('#dialPlanListTable_filter').removeClass('dataTables_filter');
            }
        });

        $(document).on('click', '.view_details', function() {
            id = $(this).attr('id');
            id_ = id;
            // console.log('id = ' + id);

            // get country from database
            $.ajax({
                url: 'search.php',
                dataType: 'json',
                type: "POST",
                data: {
                    topic: 'type_country'
                },
                success: function(data) {
                    option = '';
                    for (i = 0; i < data.length; i++) {
                        option += "<option val = '" + data[i]['COUNTRY_CODE'] + "'>" + data[
                            i]['country_name'] + "</option>";
                    }
                    $('#edu_country').html(option);
                }
            })

            // get type_training (ประเภทอบรมณ์) from database
            $.ajax({
                url: 'search.php',
                dataType: 'json',
                type: "POST",
                data: {
                    topic: 'type_training'
                },
                success: function(data) {
                    option = '';
                    for (i = 0; i < data.length; i++) {
                        option += "<option val = '" + data[i]['training_code'] + "'>" +
                            data[
                                i]['detail_training'] + "</option>";
                    }
                    $('#training_code').html(option);
                }
            })

            // get train_type (ประเภทสถาบัน) from database
            $.ajax({
                url: 'search.php',
                dataType: 'json',
                type: "POST",
                data: {
                    topic: 'type_work'
                },
                success: function(data) {
                    option = '';
                    for (i = 0; i < data.length; i++) {
                        option += "<option val = '" + data[i]['work_code'] + "'>" +
                            data[
                                i]['detail_work'] + "</option>";
                    }
                    $('#type_work').html(option);
                }
            })

            // SET VALUE TO FORM EDIT BY FETCH FORM DATABASE
            $.ajax({
                url: 'select.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    id: $(this)[0]['id']
                },
                success: function(res) {
                    console.log(res);
                    $('input[name = training_num]').val(res['training_num']);
                    $('input[name = Eyear]').val(res['Eyear']);
                    $('#EPart').val(res['EPart']);
                    $('input[name = start_date]').val(res['start_date']);
                    $('input[name = end_date]').val(res['end_date']);
                    $('input[name = institute_name]').val(res['institute_name']);
                    $('input[name = present_name]').val(res['present_name']);
                    $('input[name = edu_institute]').val(res['edu_institute']);
                    $('input[name = TRAINING_COST]').val(res['TRAINING_COST']);
                    $('input[name = lecturer_hour]').val(res['lecturer_hour']);
                    $('textarea[name = com_name]').val(res['com_name']);
                    $('#edu_country option')
                        .removeAttr('selected')
                        .filter('[val=' + res['edu_country'] + ']')
                        .attr('selected', true);
                    $('#training_code option')
                        .removeAttr('selected')
                        .filter('[val=' + res['training_code'] + ']')
                        .attr('selected', true);
                    $('#type_work option')
                        .removeAttr('selected')
                        .filter('[val=' + res['type_work_code'] + ']')
                        .attr('selected', true);
                    $('#cancel_status').val(res['cancel_status']);
                }
            })
        })

        $("#form_edit").validate({
            // if has rule put code in here

            // rules: {
            //     com_name: {
            //         required: true,
            //     }
            // },
            // messages: {
            //     com_name: {
            //         required: "We need your email address to contact you",
            //     }
            // },
            submitHandler: function(form) {
                alertify.confirm("ยืนยันการอัพเดตข้อมูล",
                    function() {
                        event.preventDefault();
                        console.log(id_);
                        var data = {
                            'training_num': $('[name = training_num]').val(),
                            'Eyear': $('[name = Eyear]').val(),
                            'EPart': $('[name = EPart]').val(),
                            'start_date': $('[name = start_date]').val(),
                            'end_date': $('[name = end_date]').val(),
                            'training_code': $('#training_code option:selected').attr(
                                'val'),
                            'institute_name': $('[name = institute_name]').val(),
                            'present_name': $('[name = present_name]').val(),
                            'edu_institute': $('[name = edu_institute]').val(),
                            'type_work_code': $('#type_work option:selected').attr('val'),
                            'edu_country': $('#edu_country option:selected').attr('val'),
                            'TRAINING_COST': $('[name = TRAINING_COST]').val(),
                            'lecturer_hour': $('[name = lecturer_hour]').val(),
                            'com_name': $('[name = com_name]').val(),
                            'cancel_status': $('[name = cancel_status]').val()
                        }
                        console.log(data);
                        $.ajax({
                            method: 'POST',
                            url: 'update.php',
                            dataType: 'json',
                            data: {
                                data: data,
                                table: 'training_all',
                                where: 'id =' + id_
                            },
                            success: function(res) {
                                sessionStorage.setItem('update_order', "1");
                            }
                        })
                        window.location.reload();
                    },
                    function() {
                        alertify.error('ยกเลิก');
                    }).set({
                    title: 'อัพเดตข้อมูล !'
                }).set('labels', {
                    ok: 'บันทึก',
                    cancel: 'ยกเลิก'
                });
            }
        });

        if (sessionStorage.getItem('update_order') == '1') {
            sessionStorage.setItem('update_order', "0");
            alertify.success('บันทึกข้อมูลเรียบร้อยแล้ว');
        }
    })
    </script>
</body>

</html>