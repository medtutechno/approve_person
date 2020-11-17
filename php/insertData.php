<?php
    session_start();    
    if(!isset($_SESSION['_IDCARD'])){
        header('Location: http://'.$_SERVER['SERVER_NAME'].'/main');
    }
    require '../../../php/connect.php';
    $con = connect('192.168.66.67','root','medadmin','personal','utf8');
    
    $data = json_decode(file_get_contents("php://input"));

    $training_num = $_POST['training_num'];
    $id = $_POST['id'];
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
    $path ='attach_file/';
    function genID(){
        $sql = 'SELECT MAX(training_num) as lastId FROM training_all WHERE training_num LIKE "nc%" LIMIT 0,1';
        $result = select($sql);
        //NC2563xxxx
        $yearID = substr($result[0][lastId],2,4);//ตัดปีจาก ID
        $numberID = intval(substr($result[0][lastId],6,4));// ตัดเลข ID 
        if($yearID != (date('Y')+543) || $result[0][lastId] == ''){//เช็คปีของ ID เพื่อสร้าง ID ใหม๋      
                return $training_num = 'NC'.(date('Y')+543).'0001';
        }else{
            if($numberID < 10){            
                $number = '000'.($numberID+1);
            }else if($numberID < 100){
                $number = '00'.($numberID+1);
            }else if($numberID < 1000){
                $number = '0'.($numberID+1);
            }else{ echo 'd';
                $number = $numberID+1;
            }
            return $training_num = 'NC'.$yearID.$number;
        } 
    }
    if(empty($training_num)){ //เช็ครหัสเรื่องและสร้าง
       echo $training_num = genID();
    }
    print_r($_FILES['file']['name']);
    
    $value = array(
        'attach_name'=>$training_num.'.pdf',
        'attach_Npath'=>$path.$training_num.'.pdf'
    );
    if(move_uploaded_file($tmp_file,'../../major_info/attach_file/'.$training_num.'.pdf')){
        if(empty($attach_join)){
            insert('responsibilities.attach_file',$value);
            $sql = 'SELECT MAX(attach_id) as attachid FROM responsibilities.attach_file LIMIT 0,1';
            $result  = select($sql);
            $attach_join = $result[0][attachid];
        }else{
                $where = 'attach_id ="'.$attach_join.'"';
                update('responsibilities.attach_file',$value,$where); 
            }
    }



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
        'user_update'=>$_SESSION['_USER'],
        //'date_recode'=>$call_do->converse_date($_date_recode'db'),
        'date_recode' => date('Y-m-d'), 
        'lecturer_hour'=>$lecturer_hour
    );
    /*if(empty($id)){
        insert('training_all',$value);
    }else{
        $where = 'ID = "'.$id.'"';
        update('training_all',$value,$where);
    }
    $sql = 'SELECT ID FROM training_all WHERE training_num ="'.$training_num.'"';
    $result = select($sql);

    foreach($partic as $key=>$value){
        echo $sql = 'INSERT INTO author_trjoin (join_record,join_research,join_Gtrain,sec_join) VALUES ("'.$result[0][ID].'","'.$value.'","'.$Gtraining_code.'","0")';
        if($con->query($sql)){ 
            echo $value;
        }
	    else{ 
            die("SQL Error: <br>".$sql."<br>".$con->error); return false; 
        }
    }*/
    //echo json_encode($value);
?>