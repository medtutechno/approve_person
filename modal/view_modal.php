<div class="modal fade" id="details_event" tabindex="-1" aria-labelledby="details_event" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:120%!important;">
            <div class="modal-header">
                <h5 class="modal-title" id="details_event">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_edit" style="margin:10px">
                    <div class="mb-3 row">
                        <div class="col-4">
                            <label for="training_num">รหัสเรื่อง</label>
                            <input type="text" class="form-control form-control-sm" placeholder="รหัสเรื่อง"
                                name="training_num" disabled>
                        </div>
                        <div class="col-4">
                            <label for="Eyear">ปีการศึกษา</label>
                            <input type="text" class="form-control form-control-sm" name="Eyear">
                        </div>
                        <div class="col-4">
                            <label for="EPart">ภาคการศึกษา</label>
                            <select class="form-control form-control-sm" name="EPart" id="EPart">
                                <option value="" disabled selected hidden>ภาคการศึกษา</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="start_date">วันเริ่ม</label>
                            <input type="date" class="form-control form-control-sm" name="start_date">
                        </div>
                        <div class="col-6">
                            <label for="end_date">วันสิ้นสุด</label>
                            <input type="date" class="form-control form-control-sm" name="end_date">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="training_code">ประเภทอบรมณ์</label>
                            <select class="form-control form-control-sm" name="training_code" id="training_code">
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="institute_name">ผู้จัด</label>
                        <input type="text" class="form-control form-control-sm" placeholder="ผู้จัด"
                            name="institute_name">
                    </div>
                    <div class="mb-3">
                        <label for="present_name">ชื่อเรื่อง</label>
                        <input type="text" class="form-control form-control-sm" placeholder="ชื่อเรื่อง"
                            name="present_name">
                    </div>
                    <div class="mb-3">
                        <label for="edu_institute">สถานที่</label>
                        <input type="text" class="form-control form-control-sm" placeholder="ชื่อเรื่อง"
                            name="edu_institute">
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="type_work">ประเภทสถาบัน</label>
                            <select style='width:100%' type="text" class="form-control form-control-sm" name="type_work"
                                id="type_work">
                                <option value="0" selected disabled hidden>ประเภทสถาบัน</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="edu_country">ประเทศ</label>
                            <select style='width:100%' type='text' name='edu_country' id='edu_country'
                                class='form-control form-control-sm'>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="TRAINING_COST">ค่าใชจ่าย</label>
                            <input type="text" class="form-control form-control-sm" placeholder="ค่าใช้จ่าย"
                                name="TRAINING_COST">
                        </div>
                        <div class="col-6">
                            <label for="lecturer_hour">จำนวนชั่วโมง</label>
                            <input type="text" class="form-control form-control-sm" placeholder="จำนวนชั่วโมง"
                                name="lecturer_hour">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="com_name">หมายเหตุ</label>
                        <textarea rows="4" class="form-control form-control-sm" name="com_name"></textarea>
                    </div>
                    <?if($_SESSION['status_system']=='admin' || isset($_SESSION['head_section'])){?>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="cancel_status"></label>
                            <select class="form-control form-control-sm" name="cancel_status" id="cancel_status">
                                <option value="0">รอตรวจสอบ</option>
                                <option value="1">อนุมัติ</option>
                                <option value="2">ยกเลิก</option>
                                <option value="3">ไม่อนุมัติ</option>
                            </select>
                        </div>
                        <button type="submit" class="col-6 btn btn-sm btn-success pull-right btn_update">อัพเดต</button>
                    </div>
                    <?}?>
                </form>
            </div>
        </div>
    </div>
</div>