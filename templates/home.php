<div class='row'>
    <div class='col-md-4 mt-3'>
        <div class='card text-light bg-secondary' style='border:none;border-radius:0;'>
            <div class='card-body'>
                <h5 class='card-title'>รอการอนุมัติ</h5>
                15 รายการ
            </div>
        </div>
    </div>
    <div class='col-md-4 mt-3'>
        <div class='card text-light' style='border:none;border-radius:0;background:#FF5757;'>
            <div class='card-body'>
                <h5 class='card-title'>ไม่อนุมัติ</h5>
                1 รายการ
            </div>
        </div>
    </div>
    <div class='col-md-4 mt-3'>
        <div class='card text-dark' style='border:none;border-radius:0;background:#77F99A;'>
            <div class='card-body'>
                <h5 class='card-title'>อนุมัติ</h5>
                10 รายการ
            </div>
        </div>
    </div>
</div>
<!--<div class='row mt-3'>
    <div class='col-md-2 offset-md-10'>
        <button class='btn btn-outline-info float-right' style='border-radius:0' ng-click='modelAdd()'>เพิ่มข้อมูล</button>
    </div>
</div>-->
<table class='table mt-3 table-hover'>
    <thead>
        <tr>
            <th>รหัสเรื่อง</th>
            <th>ชื่อเรื่อง</th>
            <th>ผู้จัด</th>
            <th>วันที่ไป</th>
            <th>สถานะ</th>
            <th>รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>56300376</td>
            <td>เดินทางไปดูสถานที่ประกอบการพิจารณาในการจัดโครงการค่ายบำเพ็ญประโยชน์และอาสาพัฒนาชนบท</td>
            <td>งานกิจการนักศึกษา คณะแพทยศาสตร์ มธ.</td>
            <td>24 พ.ย.62-24 พ.ย.62</td>
            <td><span class='badge badge-success' style='border-radius:0'>อนุมัติ</span></td>
            <td></td>
        </tr>
    </tbody>
</table>
<!--********************************* Modal Add ***********************************************-->
<script type='text/ng-template' id='modalAdd.html'>
    <div class='modal-header'>
        <h4>เพิ่มข้อมูล</h4> 
    </div>
    <div class='modal-body'>
        <form>
            <div class='form-row'>   
                <div class='col-md-6 p-1'>
                    <input type='text' class='form-control {{stChkSubj}}' placeholder='ชื่อเรื่อง' ng-model='nsubject' ng-change='checkTxt("subj",nsubject)' style='border-radius:0;'>
                </div>
            </div>
            <div class='form-row'>   
                <div class='col-md-6 p-1'>
                    <input type='text' class='form-control {{stChkTo}}' placeholder='วันที่ไป' ng-model='to' ng-change='checkTxt("to",to)' style='border-radius:0;'>
                </div>
            </div>
            <div class='form-row'>   
                <div class='col-md-6 p-1'>
                    <input type='text' class='form-control {{stChkTo}}' placeholder='ผู้จัด' ng-model='to' ng-change='checkTxt("to",to)' style='border-radius:0;'>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-md-3'>   
                    <input type='text' class='form-control' disabled ng-model='usernumber' style='border-radius:0;' placeholder='Username'>
                </div>
                <div class='col-md-3'>   
                    <input type='text' class='form-control' placeholder='หน่วยงาน' disabled style='border-radius:0;' ng-model='sect'>
                </div>
                <div class='col-md-3'>   
                    <input type='text' class='form-control {{staTel}}' placeholder='เบอร์ติดต่อ' ng-model='tel' style='border-radius:0;'>
                </div>
            </div>
            
            <div class='form-row p-1'>
                <select class='form-control col-md-3' ng-model='typeindex' style='border-radius:0;'>
                    <option value='1'>ภายใน</option>
                    <option value='2'>ภายนอก</option>
                </select>
            </div>
            <div class='form-row'>   
                <div class='col-md-6 p-1'>
                    <div class='custom-file'>
                        <input type='file' class='custom-file-input {{staFile}}' file-model='fileup' required>
                        <label class='custom-file-label' style='border-radius:0;'>
                            <small>{{fileup.name}}</small>
                        </label>
                        <small class='text-danger'>{{msgFile}}</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class='modal-footer'>
        <button class='btn btn-outline-primary' ng-click='modalBtnSave()' style='border-radius:0;'>บันทึก</button>
        <button class='btn btn-outline-danger' ng-click='modalClose()' style='border-radius:0;'>ยกเลิก</button>
    </div>
</script>