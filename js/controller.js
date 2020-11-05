app.controller('homePage',function($scope,$http,$uibModal){
//----------------------- Modal Add --------------------------------    
    $scope.modelAdd = function(user,sect){
        console.log('ee');
        $scope.user = user;
        $uibModal.open({
            animation: true,
            templateUrl:'modalAdd.html',
            controller:'modalCtrlInsert',
            backdrop:'static',
            size:'lg',
            resolve:{
                userDetail : function(){
                    return [user,sect];
                }
            }
        });
    }
});

app.controller('modalCtrlInsert',function($uibModalInstance,$scope,userDetail,$http){
    $scope.modalClose = function(){
        $uibModalInstance.dismiss('cancel');
    }
});
//=============================== Controller addPage.php ===============================
app.controller('addPage',function($scope,$http,$uibModal,autoComplete){
    $scope.start_date = new Date();
    $scope.end_date = new Date();
    //$scope.active_date = new Date();
    $scope.statusDateSta = false; // เปิด-ปิดแสดงวันที่
    $scope.statusDateEnd = false;
    $scope.statusDateActive =  false;
    var fundID;
    var training_num;
    $scope.stChkEyear = '';
    $scope.showtrainingnum = '';
    var fd = new FormData();
    $scope.staBtnID = false;
    $scope.statusID = 'old';//แสดงสถานะว่าใช้ไอดีเก่าหรือใหม่ old = เก่า new = ใหม่
    $scope.showAlertMsg = false;//แสดงคำเตือนกรอกข้อมูลไม่ครบ
    $scope.staMsgID = true;
    $scope.partic = new Array(); // รายชื่อผู้เข้าร่วม
    $http.post('php/getData.php',{'type':'typeTrain'}).then(function(data){
        $scope.selTraining = data.data;
    });
    $http.post('php/getData.php',{'type':'typeInsti'}).then(function(data){
        $scope.selInsti = data.data;
    });
    $http.post('php/getData.php',{'type':'typeCountry'}).then(function(data){
        $scope.selCountry = data.data;
    });
    $http.post('php/getData.php',{'type':'fund'}).then(function(data){
        $scope.autoFund = data.data;
    });    

    function chkSendData(value){
        if(value=='' || value == undefined || value.length == '0'){
            return 'is-invalid';
        }else{
            return 1;
        }
    }
    function GenId(){
        $http.post('php/getData.php',{
            'type':'genID'
        }).then(function(data){
            var date = new Date();
            if(!data.data[0].lastId){
                var subId = 0 ;
            }else{
                var subId = parseInt(data.data[0].lastId.substring(6));    
            }
            
            var number;
            if(subId < 10){
                number = '000'+(subId+1);
            }else if(subId < 100){
                number = '00'+(subId+1);
            }else if(subId < 1000){
                number = '0'+(subId+1);
            }
            $scope.training_num = 'NC'+(date.getFullYear()+543)+number;
            $scope.statusID = 'new';
            $scope.staMsgID = false;
            $scope.msgID = 'รหัสใหม่';
            $scope.staBtnID = '';

        });
    }
    $scope.statusStartDate = function(){
        $scope.statusDateSta =  true;
    }
    $scope.statusEndDate = function(){
        $scope.statusDateEnd = true;
    }
    $scope.statusActiveDate = function(){
        $scope.statusDateActive = true;
    }     

    $scope.addPartic = function(){
        /*if($scope.partic.length == 0){
            $scope.partic.push($scope.dataPartic[0]); 
        }else{
            angular.forEach($scope.partic,function(value,key){
                if(value.ID_CODE !== $scope.dataPartic[0].ID_CODE){
                    $scope.partic.push($scope.dataPartic[0]);
                }else{
                    $scope.msgPartic = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากข้อมูลซ้ำ';
                }
                
            });
        }*/
        $scope.partic.push($scope.dataPartic[0]);
        $scope.name = '';
    }
    $scope.delPartic = function(val){
        angular.forEach($scope.partic,function(value,key){
            if(value.ID_CODE == val){
                $scope.partic.splice(key,1);
            }
        });
    }
    $scope.genID = function(val){
        if(val){
            $scope.msgID = 'รหัสใหม่'; 
            $scope.showtrainingnum = ''; 
        }else{
            $scope.msgID = 'รหัสเดิม'; 
            $scope.showtrainingnum = $scope.training_num;
        }
        
        //$scope.staBtnID = false;
    }
//################################# Click Button Add Data ######################################
    $scope.btnAddData = function(){
        //========================== Check Data    ============================
        var chkAns = 0;
        $scope.stChkEyear = chkSendData($scope.Eyear);  
        $scope.stChkEPart = chkSendData($scope.EPart);
        $scope.stChktriCode = chkSendData($scope.training_code); 
        $scope.stChkTo = chkSendData($scope.institute_name);
        $scope.stChkPrename = chkSendData($scope.present_name);
        $scope.stChkSubj = chkSendData($scope.edu_institute);
        $scope.stChkShowInsti = chkSendData($scope.type_work_code);
        $scope.stChkShowCountry = chkSendData($scope.edu_country);
        $scope.stChkActDate = chkSendData($scope.active_date);
        $scope.stChkFund = chkSendData($scope.sch_name);
        $scope.stNumHour = chkSendData($scope.lecturer_hour);
        $scope.staFile = chkSendData($scope.fileup);
        $scope.staPartic = chkSendData($scope.partic);
        //$scope.training_num = $scope.showtrainingnum;
        if($scope.stChkEyear !== 'is-invalid'){
            if($scope.stChkEPart !== 'is-invalid'){
                if($scope.stChktriCode !== 'is-invalid'){
                    if($scope.stChkTo !== 'is-invalid'){
                        if($scope.stChkPrename !== 'is-invalid'){
                            if($scope.stChkSubj !== 'is-invalid'){
                                if($scope.stChkShowInsti !== 'is-invalid'){
                                    if($scope.stChkShowCountry !== 'is-invalid'){
                                        if($scope.stChkActDate !== 'is-invalid'){
                                            if($scope.stChkFund !== 'is-invalid'){
                                                if($scope.stNumHour !== 'is-invalid'){
                                                    if($scope.staFile !== 'is-invalid'){
                                                        if($scope.staPartic !== 'is-invalid'){
                                                            if($scope.fileup.type == 'application/pdf'){
                                                                $scope.msgFile ='';
                                                                $scope.showAlertMsg = false;
                                                                // check ข้อมูลครบหมด
                                                                var formAdd = new FormData();
                                                                formAdd.append('training_num',$scope.showtrainingnum);
                                                                formAdd.append('training_code',$scope.training_code.training_code);
                                                                formAdd.append('Eyear',$scope.Eyear);
                                                                formAdd.append('EPart',$scope.EPart);
                                                                formAdd.append('institute_name',$scope.institute_name);
                                                                formAdd.append('present_name',$scope.present_name);
                                                                formAdd.append('edu_institute',$scope.edu_institute);
                                                                formAdd.append('type_work_code',$scope.type_work_code);
                                                                formAdd.append('edu_country',$scope.edu_country);
                                                                formAdd.append('start_date',$scope.start_date);
                                                                formAdd.append('end_date',$scope.end_date);
                                                                formAdd.append('active_date',$scope.active_date);
                                                                formAdd.append('sch_type',$scope.sch_type);
                                                                formAdd.append('training_cost',$scope.training_cost);
                                                                formAdd.append('lecturer_hour',$scope.lecturer_hour);
                                                                formAdd.append('comment',$scope.comment);
                                                                formAdd.append('attach_join',$scope.attach_join);
                                                                formAdd.append('partic',$scope.partic);
                                                                formAdd.append('file',$scope.fileup);
                                                                $http.post('php/insertData.php',formAdd,{
                                                                    transformRequest: angular.identity,
                                                                    headers: {'Content-Type': undefined}
                                                                })
                                                                .then(function(data){
                                                                    console.log(data.data);
                                                                    if(data.data == 1){
                                                                        $scope.staDetailLoading = false; 
                                                                    }
                                                                });
                                                            }else{
                                                                $scope.msgFile = 'กรุณาอัพโหลดไฟล์ที่เป็นนามสกุล PDF เท่านั้น';
                                                                $scope.staFile = 'is-invalid';
                                                            }
                                                        }    
                                                    } 
                                                }
                                            }
                                        }
                                    }
                                }   
                            }
                        }
                    }
                }
            }
        }else{
            $scope.showAlertMsg = true;
        }
                         
    }

    //----------------- ปุ่มเลือกใช้รหัสเดิมหรือใหม่

    /*$scope.genID = function(eventBtn){
        
        if($scope.training_num!==''&&$scope.Eyear!==''){
            $scope.staBtnID = true;
            if(eventBtn == 'y'){
                console.log(eventBtn);
                $scope.staBtnID = false;
                $http.post('php/getData.php',{
                    'id':$scope.training_num,
                    'type':'cfData'
                }).then(function(data){
                    console.log(data.data);
                    var alldata = data.data;
                    $scope.institute_name = alldata[0].institute_name;
                    $scope.present_name = alldata[0].present_name;
                    $scope.edu_institute = alldata[0].edu_institute;
                    $scope.type_work_code = alldata[0].type_work_code;
                    $scope.edu_country = alldata[0].edu_country;
                    $scope.start_date = alldata[0].start_date;
                    $scope.end_date = alldata[0].end_data;
                    $scope.active_date = alldata[0].active_date;
                    $scope.sch_type = alldata[0].sch_type;
                    $scope.training_cost = alldata[0].TRAINING_COST;
                    $scope.lecturer_hour = alldata[0].lecturer_hour;
                    $scope.comment = alldata[0].lecturer_hour;
                   // $scope.fileup = ;
                });
            }else if(eventBtn == 'n'){
                GenId();
            }
        }else{
            $scope.staBtnID = true;
            $scope.stChkEyear = chkSendData($scope.Eyear);
            $scope.stChkEPart = chkSendData($scope.EPart);
        }

    }*/
//------------------------ AutoComplete --------------------------------
    $scope.staAutoCom = true;
    $scope.staAutoComP = true;
    $scope.staAutoComPartic = true; // สถานะตัวเลือกของรายชื่อผู้เข้าร่วม
    $scope.autoComFund = function(val){    
        $http.post('php/getData.php',{
            'type':'fund',
            'datafund':val
        }).then(function(data){
            if(data.data.length == 0){
                $scope.staAutoCom = true;
            }
            $scope.autoFund = data.data;
        }); 
        $scope.staAutoCom = autoComplete.autoCom(val);
    }
    $scope.selectVal = function(fund){
        $scope.sch_name = fund[0].SCH_TNAME;
        $scope.sch_type =  fund[0].SCH_CODE;
        $scope.staAutoCom = true;
    }
    $scope.autoComPre = function(val){
        
        if($scope.training_code=='' || $scope.training_code == undefined){
            tra_code = '';
        }else{
            tra_code = $scope.training_code.training_code;
        }
        $http.post('php/getData.php',{
            'type':'pre',
            'prename':val,
            'Eyear':$scope.Eyear,
            'training_code':tra_code
        }).then(function(data){
            console.log(data.data);
            if(data.data.length == 0){
                $scope.staAutoComP = true;
            }
            $scope.autoPre = data.data;
        });
        $scope.staAutoComP = autoComplete.autoCom(val);
    }
    $scope.selectPreName = function(val){
        $scope.present_name = val[0].present_name;
        //if(val[0].training_num !== ''){
            $http.post('php/getData.php',{
                'type':'cfData',
                'id':val[0].training_num,
                'prename':$scope.present_name
            }).then(function(data){
                console.log(data.data);
                var alldata = data.data;
                var modalOldData = $uibModal.open({
                    animation: true,
                    templateUrl:'modalIDOld.html',
                    controller:'modalCtrlIDOld',
                    backdrop:'static',
                    size:'lg',
                    resolve:{
                        idtra : function(){
                            return alldata;
                        }
                    }
                });
                modalOldData.result.then(function(val){
                    console.log(data.data[0].training_num);
                    if(val == 'selOld'){
                        $scope.showtrainingnum = data.data[0].training_num;
                        $scope.institute_name = data.data[0].institute_name;
                        $scope.edu_institute = data.data[0].edu_institute;
                        $scope.type_work_code = data.data[0].type_work_code;
                        $scope.edu_country = data.data[0].edu_country;
                        $scope.start_date = new Date(data.data[0].start_date.substring(0,4),data.data[0].start_date.substring(5,7),data.data[0].start_date.substring(8,10));
                        $scope.end_date = new Date(data.data[0].end_date.substring(0,4),data.data[0].end_date.substring(5,7),data.data[0].end_date.substring(8,10));
                        $scope.active_date = data.data[0].active_date;
                        $scope.sch_type = data.data[0].sch_type;
                        $scope.sch_name = data.data[0].SCH_TNAME;
                        $scope.training_cost = data.data[0].TRAINING_COST;
                        $scope.lecturer_hour = data.data[0].lecturer_hour;
                        $scope.comment = data.data[0].comment;
                        $scope.fileup = data.data[0].attach_name;
                        $scope.attach_join = data.data[0].attach_join;
                        $scope.fileup = {name:data.data[0].attach_name};
                        $scope.staid = false; 
                        $scope.msgID = 'รหัสเดิม';
                    }else if(val == 'selNew'){
                        //GenId();
                        $scope.showtrainingnum = '';
                        $scope.institute_name = '';
                        $scope.edu_institute = '';
                        $scope.type_work_code = '';
                        $scope.edu_country = '';
                        $scope.start_date = '';
                        $scope.end_date = '';
                        $scope.active_date = '';
                        $scope.sch_type = '';
                        $scope.sch_name = '';
                        $scope.training_cost = '';
                        $scope.lecturer_hour = '';
                        $scope.comment = '';
                        $scope.fileup = '';
                        $scope.attach_join
                        $scope.msgID = 'รหัสใหม่';
                        $scope.staid = true;
                    }
                });
            });
            //$scope.staMsgID = false;

          /*  
            $scope.statusID = 'old';*/

            $scope.training_num = val[0].training_num;
            if($scope.training_num === ''){
                $scope.msgID = 'รหัสใหม่';
                $scope.staid = true;
            }
        /*}else{
            GenId();
        }*/
        $scope.staAutoComP = true;
        if($scope.statusID == 'old'){
            
            $scope.staBtnID = true; 
        }
        
    }
    
    $scope.scrName = function(){
        if($scope.name !== '' && $scope.name !== undefined){
            $http.post('php/getData.php',{
                'type':'dataName',
                'name':$scope.name
            }).then(function(data){
                
                if(data.data.length == 0){
                    $scope.staAutoComPartic = true;
                    
                }else{
                    $scope.staAutoComPartic = false;
                    if($scope.partic.length !== 0){
                        angular.forEach($scope.partic,function(value,key){
                            //if(key !== undefined){
                                angular.forEach(data.data,function(val,index){
                                    if( val.ID_CODE == value.ID_CODE ){
                                        data.data.splice(index,1);
                                    }
                                });
                            //}
                        });
                    }
                    $scope.dataAutoPartic = data.data;
                    console.log($scope.dataAutoPartic);
                }

            });
        }else{
            $scope.staAutoComPartic = true;
        }
    }
    $scope.selPartic = function(){
        $scope.msgPartic = '';
        $scope.name = $scope.dataPartic[0].fullname;
        $scope.staAutoComPartic = true;
    }
});

app.controller('modalCtrlIDOld',function($uibModalInstance,$scope,idtra,$http){
    console.log(idtra);
    $scope.numTra = idtra;
    $scope.edu_institute = $scope.numTra[0].edu_institute;
    $scope.btnChoiceData = function(choice){
        $uibModalInstance.close(choice);
    }

});

app.controller('modalCtrlSaveData',function($uibModalInstance,$scope,alldata,$http){
    $scope.staDetailLoading = true; 
    //console.log(alldata[0].fileup);
    $http.post('php/insertData.php',alldata)
    .then(function(data){
        console.log(data.data);
        if(data.data ==1){
            $scope.staDetailLoading = false; 
        }
    });
    $scope.closeModal = function(){
        window.location.reload();
        //$uibModalInstance.close();
    }
});