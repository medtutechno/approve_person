<?php    
    require '../../../php/connect.php';
    $con = connect('localhost','root','medadmin','personal','utf8');
    
    $data = json_decode(file_get_contents("php://input"));
    /*$training_num = $data->training_num;
    $training_code = $data->training_code;
    $Eyear = $data->Eyear;
    $EPart = $data->EPart;
    $institute_name = $data->institute_name;
    $present_name = $data->present_name;
    $edu_institute = $data->edu_institute;
    $type_work_code = $data->type_work_code;
    $edu_country = $data->edu_country;
    $start_date = $data->start_date;
    $end_date = $data->end_date;
    $active_date = $data->active_date;
    $sch_type = $data->sch_type;
    $training_cost = $data->training_cost;
    $lecturer_hour = $data->lecturer_hour;
    $comment = $data->comment;*/
    //$fileup = $data->file;
    $training_num = $_POST['training_num'];
    
    $training_code = $_POST['training_code'];
    $Eyear = $_POST['Eyear'];
    $EPart = $_POST['EPart'];
    $institute_name = $_POST['institute_name'];
    $present_name = $_POST['present_name'];
    $edu_institute = $_POST['edu_institute'];
    $type_work_code = $_POST['type_work_code'];
    $edu_country = $_POST['edu_country'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $active_date = $_POST['active_date'];
    $sch_type = $_POST['sch_type'];
    $training_cost = $_POST['training_cost'];
    $lecturer_hour = $_POST['lecturer_hour'];
    $comment = $_POST['comment'];
    $attach_join = $_POST['attach_join'];
    $tmp_file = $_FILES['file']['tmp_name'];
    echo $partic = $_POST['partic'];
    $path ='attach_file/';
    if(move_uploaded_file($tmp_file,'../../major_info/attach_file/'.$training_num.'.pdf')){
        if($training_num == ''){
            $sql = 'SELECT MAX(training_num) as lastId FROM training_all WHERE training_num LIKE "nc%" LIMIT 0,1';
            $result = select($sql);
            //NC2563xxxx
            $yearID = substr($result[0][lastId],3,4);//ตัดปีจาก ID
            $numberID = intval(substr($result[0][lastId],6,4));// ตัดเลข ID 
            if($result[0][lastId] === '' || $yearID !== (date('Y')+543)){ //เช็คปีของ ID เพื่อสร้าง ID ใหม๋
                $training_num = 'NC'.(date('Y')+543).'0001';
            }else{
                if($numberID < 10){
                    $number = '000'+($numberID+1);
                }else if($numberID < 100){
                    $number = '00'+($numberID+1);
                }else if($numberID < 1000){
                    $number = '0'+($numberID+1);
                }else{
                    $number = $numberID+1;
                }
                $training_num = 'NC'.$yearID.$number;
            }    
        }
        $sql = 'SELECT attach_id FROM responsibilities.attach_file WHERE attach_name = "'.$training_num.'.pdf" LIMIT 0,1';
        $attFile = select($sql);
        $value = array(
            'attach_name'=>$training_num.'.pdf',
            'attach_Npath'=>$path.$training_num.'.pdf'
        );

        //---------- หา Gtraining_code ------------------------------
        $sql = "SELECT workGroup_id FROM type_training WHERE training_code='".$training_code."' LIMIT 0,1";
        $result =  select($sql);
        $Gtraining_code = eregi_replace('([a-zA-Z])', null, $result[0][workGroup_id]);
        $value = array (
            'Eyear'=>$Eyear,
            'training_num'=>$training_num,
            'training_code'=>$training_code,
            'sch_type'=>$sch_type,
            'institute_name'=>$institute_name,
            'present_name'=>$present_name,
            'edu_institute'=>$edu_institute,
            'edu_country'=>$edu_country,
            'TRAINING_COST'=>$training_cost,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'Gtraining_code'=>$Gtraining_code,
            'attach_join'=>$attach_join,
            'cancel_status'=>'0',//สถานะอนุมัติ | 0 = รออนุมัติ , 1 = ไป , 2 = ยกเลิก , 3 = ไม่อนุมัติ
            'comment_cancel'=>$_comment_cancel,
            'period_year'=>$period_year,
            'period_month'=>$period_month,
            'period_day'=>$period_day,
            'expand'=>( ($_expand)? "1": "0" ), 
            'active_date'=>$active_date,
            'comment'=>$comment,
           /* 'start_com_no'=>$_start_com_no,
            'start_com_date'=>$call_do->CDATE($_start_com_date'fdb'),
            'start_eff_date'=>$call_do->CDATE($_start_eff_date'fdb'),
            'end_com_no'=>$_end_com_no,
            'end_com_date'=>$call_do->CDATE($_end_com_date'fdb'),
            'end_eff_date'=>$call_do->CDATE($_end_eff_date'fdb'),*/
            'type_work_code'=>$type_work_code,
            'etc_state'=>( ($etc_state!='0')? 1:$etc_state),
            'EPart'=>$EPart,
            'user_update'=>$user_update,
            //'date_recode'=>$call_do->converse_date($_date_recode'db'),
            'lecturer_hour'=>$lecturer_hour
        );
    }
    echo json_encode($value);
?>