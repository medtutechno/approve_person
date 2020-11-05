<div class='container mt-3 mb-3'>
    <h3>เพิ่มข้อมูล</h3>
    <hr>
    <form class='mt-3' id='addForm'>        
        <div class='form-row'> 
            <div class='col-md-6'>
                <h5>รหัสเรื่อง
                {{showtrainingnum}} </h5>
                <div ng-if='staBtnID'> 
                    <!--<button class='btn btn-outline-success' style='border-radius:0;' ng-click='genID("y")'>ใช้รหัสเรื่องนี้</button>-->
                    <div class="custom-control custom-switch">                
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" ng-model='staid' ng-change='genID(staid)'>
                        <label class="custom-control-label" for="customSwitch1">{{msgID}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class='form-row'>   
            <div class='col-md-1 p-1'>
                <label>ปีการศึกษา</label>
                <input type='text' class='form-control {{stChkEyear}}' placeholder='ปีการศึกษา' ng-model='Eyear' style='border-radius:0;' name='Eyear' id='Eyear'>
            </div>
            <div class='col-md-2 p-1'>
                <label>ภาคการศึกษา</label>
                <select ng-model='EPart' style='border-radius:0;' class='form-control {{stChkEPart}}'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                </select>
            </div> 
            <div class='col-md-3 p-1'>
                <label>ประเภทอบรม</label>
                <select ng-options='showType.detail_training for showType in selTraining' id='training_code' ng-model='training_code' class='form-control {{stChktriCode}}'style='border-radius:0;'>
                    <option></option>
                </select>
            </div>   
            <div class='col-md-3 p-1'>
                <label>ผู้จัด</label>
                <input type='text' class='form-control {{stChkTo}}' placeholder='ผู้จัด' ng-model='institute_name' style='border-radius:0;'>
            </div>
        </div>       
        <div class='form-row'>   
            <div class='col-md-6 p-1'>
                <label>ชื่อเรื่อง</label>
                <textarea class='form-control {{stChkPrename}}'  rows='3' placeholder='ชื่อเรื่อง' ng-model='present_name' style='border-radius:0;' ng-change='autoComPre(present_name)'></textarea>
                <select class='form-control' multiple style='border-radius:0' ng-model='preName' ng-hide='staAutoComP' ng-options='showAutoP.present_name for showAutoP in autoPre' ng-click='selectPreName(preName)'></select>
            </div>

            <div class='col-md-6 p-1'>
                <label>สถานที่</label>
                <textarea class='form-control {{stChkSubj}}' rows='3' placeholder='สถานที่' ng-model='edu_institute' style='border-radius:0;'></textarea>
            </div>
        </div>
        <div class='form-row'>   
            <div class='col-md-3 p-1'>
                <label>ประเภทสถาบัน</label>
                <select ng-options='showInsti.work_code as showInsti.detail_work for showInsti in selInsti' class='form-control {{stChkShowInsti}}' ng-model='type_work_code' style='border-radius:0;'>
                </select>
            </div>
            <div class='col-md-3 p-1'>
                <label>ประเทศ</label>
                <select ng-options='showCountry.COUNTRY_CODE as showCountry.country_name for showCountry in selCountry' class='form-control {{stChkShowCountry}}' ng-model='edu_country' style='border-radius:0;'>
                </select>
            </div>  
            <div class='col-md-2 p-1'>
                <label>วันที่เริ่มต้น</label>
                <div class='input-group'>
                    <input type='text' class='form-control' placeholder='วันที่เริ่มต้น' ng-model='start_date' uib-datepicker-popup='dd-MMMM-yyyy' is-open='statusDateSta' style='border-radius:0;'>
                    <span class='input-group-btn'>
                        <button type='button' class='btn btn-outline-info' style='border-radius:0' ng-click='statusStartDate()'>
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class='col-md-2 p-1'>
                <label>วันที่สิ้นสุด</label>
                <div class='input-group'>
                    <input type='text' class='form-control' placeholder='วันที่สิ้นสุด' ng-model='end_date' uib-datepicker-popup='dd-MMMM-yyyy' is-open='statusDateEnd' style='border-radius:0;'>
                    <span class='input-group-btn'>
                        <button type='button' class='btn btn-outline-info' style='border-radius:0' ng-click='statusEndDate()'>
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class='col-md-2 p-1'>
                <label>วันที่อบรม</label>
                <div class='input-group'>
                    <input type='text' class='form-control {{stChkActDate}}' placeholder='วันที่อบรม' ng-model='active_date'  style='border-radius:0;'>

                </div>
            </div>
        </div>
        <div class='form-row'>
            <div class='col-md-6'>
                <div class='row pt-1'>
                    <div class='col-md-6'>
                        <label>ประเภททุน</label>
                        <input type='text' class='form-control {{stChkFund}}' placeholder='ประเภททุน' ng-model='sch_name' ng-change='autoComFund(sch_name)' style='border-radius:0'>
                        <select class='form-control' multiple style='border-radius:0' ng-model='fund' ng-hide='staAutoCom' ng-options='showAuto.SCH_TNAME for showAuto in autoFund | filter:sch_name' ng-click='selectVal(fund)'>
                        </select>
                    </div>
                    <div class='col-md-3'>
                        <label>ค่าใช้จ่าย</label>
                        <input type='text' class='form-control' placeholder='ค่าใช้จ่าย' ng-model='training_cost' style='border-radius:0'>
                    </div>
                    <div class='col-md-3'>
                        <label>จำนวนชั่วโมง</label>
                        <input type='text' class='form-control {{stNumHour}}' placeholder='จำนวนชั่วโมง' ng-model='lecturer_hour' style='border-radius:0'>
                    </div>
                </div>

            </div>
            <div class='col-md-6 p-1'>
                <label>หมายเหตุ</label>
                <textarea class='form-control' placeholder='หมายเหตุ' ng-model='comment' style='border-radius:0;' rows='3'></textarea>
            </div>
        </div>

        <div class='form-row pt-3'>   
            <div class='col-md-6'>
                <label>แนบไฟล์</label>
                <div class='custom-file'>
                    <input type='file' class='custom-file-input {{staFile}}' file-model='fileup'>
                    <label class='custom-file-label' style='border-radius:0;'>
                        <small>{{fileup.name}}</small>
                    </label>
                    <small class='text-danger'>{{msgFile}}</small>
                </div>
            </div>
            <div class='col-md-3'>   
                <label>ผู้บันทึก</label>
                <input type='text' class='form-control' disabled ng-model='usernumber' style='border-radius:0;' placeholder='Username'>
            </div>
            <div class='col-md-3'>   
                <label>หน่วยงาน</label>
                <input type='text' class='form-control' placeholder='หน่วยงาน' disabled style='border-radius:0;' ng-model='sect'>
            </div>
        </div>
        <div class='form-row pt-3 pb-3'>
            <div class='col-md-4'>
            ผู้เข้าร่วม
                <div class='input-group'>
                    <input type='text' class='form-control {{staPartic}}' style='border-radius:0;' ng-change='scrName()' ng-model='name'>
                    <div class='input-group-prepend'>
                        <button type='button' class='btn btn-success' style='border-radius:0;' ng-click='addPartic()'>เพิ่ม</button>
                    </div>
                </div>
                <select class='form-control' multiple style='border-radius:0' ng-model='dataPartic' ng-hide='staAutoComPartic' ng-options='showPartic.fullname for showPartic in dataAutoPartic' ng-click='selPartic()'>
                </select>
                <small class="form-text text-danger">{{msgPartic}}</small>
            </div>
            <div class='col-md-6 offset-md-2'>
                รายชื่อ     
                    <div class='row ' ng-repeat='listpartic in partic'>                
                        <div class='col-md-6'>
                            <div class='alert alert-success alert-dismissible fade show' style='border-radius:0; padding:5px; padding-right:20px; margin-bottom:0px;'>
                                    {{listpartic.fullname}}
                                    <button type='button' class='close' data-dismiss='alert' style='padding:5px;' ng-click='delPartic(listpartic.ID_CODE)'>
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                        </div>
                    </div>    
                
            </div>


        </div>

        <hr>
        <small id="passwordHelpBlock" class="form-text text-danger text-center" ng-show='showAlertMsg'>
            กรุณากรอกข้อมูลให้ครบถ้วน
        </small>
        <div class='col-md-4 offset-md-4 pt-3 text-center'><button class='btn btn-outline-info' style='border-radius:0;' ng-click='btnAddData()'>เพิ่มข้อมูล</button></div>
    </form>
</div>

<script type='text/ng-template' id='modalIDOld.html'>
    <div class='modal-body'>
        <form>
            <div ng-repeat='dataOld in numTra'>     
                <div class='row'>
                    <div class='col-md-2'>
                        รหัสเรื่อง
                    </div>
                    <div class='col-md-8'>
                        {{dataOld.training_num}}
                    </div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ปีการศึกษา</div>
                    <div class='col-md-10'>{{dataOld.Eyear}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ประเภทอบรม</div>
                    <div class='col-dm-10'>{{dataOld.detail_training}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ผู้จัด</div>
                    <div class='col-dm-10'>{{dataOld.institute_name}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ชื่อเรื่อง</div>
                    <div class='col-md-10'>{{dataOld.present_name}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>สถานที่</div>
                    <div class='col-dm-10'>{{dataOld.edu_institute}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ประเภทสถาบัน</div>
                    <div class='col-dm-10'>{{dataOld.detail_work}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ประเทศ</div>
                    <div class='col-dm-10'>{{dataOld.country_name}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>วันที่เริ่มต้น</div>
                    <div class='col-dm-10'>{{dataOld.start_date}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>วันที่สิ้นสุด</div>
                    <div class='col-dm-10'>{{dataOld.end_date}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>วันที่อบรม</div>
                    <div class='col-dm-10'>{{dataOld.active_date}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ประเภททุน</div>
                    <div class='col-dm-10'>{{dataOld.SCH_TNAME}}</div>
                </div>
                <div class='row pt-3'>
                    <div class='col-md-2'>ค่าใช้จ่าย</div>
                    <div class='col-dm-10'>{{dataOld.TRAINING_COST}}</div>
                </div>
            </div>
        </form>                    
        <div class='row p-3'>
            <button type='button' class='btn btn-outline-success' ng-click='btnChoiceData("selOld")'>ใช้ข้อมูลเดิม</button>
            <button type='button' class='btn btn-outline-info' ng-click='btnChoiceData("selNew")'>กรอกข้อมูลใหม่</button>
        </div>   
    </div>
</script>

<!--############################################### Modal Loading....Save Data ####################################################-->
<script type='text/ng-template' id='modalLoadSaveData.html'>
    <div class='modal-body text-center'>
        <span ng-show='staDetailLoading'>
            <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status"></div>
            <h5>Loading...</h5>
        </span>
        <span ng-hide='staDetailLoading'>
            <h5>บันทึกเรียบร้อย</h5><a type="button" class="btn btn-outline-primary" ng-click="closeModal()">ปิด</a>
        </span>
    </div>
</script>