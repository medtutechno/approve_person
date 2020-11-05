<?php
    require '../../../php/connect.php';
    $data = json_decode(file_get_contents("php://input"));
    $con=connect('localhost','root','medadmin','personal','utf8');
    $type = $data->type;
    $Eyear = $data->Eyear;
    $trai_code = $data->training_code;
    $idTra = $data->id;
    $prename = $data->prename;
    $typefund = $data->datafund;
    $name = $data->name;
    if($type == 'typeTrain'){
        $sql = 'SELECT training_code,detail_training FROM type_training';   
    }else if($type == 'typeInsti'){
        $sql = 'SELECT * FROM type_work';
    }else if($type == 'typeCountry'){
        $sql = 'SELECT * FROM type_country';
    }else if($type ==  'fund'){
        $sql = 'SELECT SCH_CODE,SCH_TNAME FROM appm_scholarship_type WHERE SCH_TNAME LIKE "%'.$typefund.'%"';
    }else if($type == 'pre'){
       // echo $prename;
        if($Eyear !== '' && $trai_code !== ''){
            $sql = 'SELECT training_num,present_name FROM training_all WHERE Eyear = "'.$Eyear.'" AND training_code = "'.$trai_code.'" AND present_name LIKE "%'.$prename.'%" ORDER BY Eyear DESC LIMIT 0,1000';
        }else if($Eyear !== '' && $trai_code == ''){
            $sql = 'SELECT training_num,present_name FROM training_all WHERE Eyear = "'.$Eyear.'" AND present_name LIKE "%'.$prename.'%" ORDER BY Eyear DESC LIMIT 0,1000';
        }else if($Eyear == '' && $trai_code !== ''){
            $sql = 'SELECT training_num,present_name FROM training_all WHERE training_code = "'.$trai_code.'" AND present_name LIKE "%'.$prename.'%" ORDER BY Eyear DESC LIMIT 0,1000';
        }else{
            $sql = 'SELECT training_num,present_name FROM training_all WHERE present_name LIKE "%'.$prename.'%" ORDER BY Eyear DESC LIMIT 0,1000';
        }
    }else if($type == 'genID'){
        $sql = 'SELECT MAX(training_num) as lastId FROM training_all WHERE training_num LIKE "nc%" LIMIT 0,1';
    }else if($type == 'cfData'){
        
        $sql = 'SELECT * FROM personal.training_all
        LEFT JOIN personal.type_training ON personal.type_training.training_code = personal.training_all.training_code
        LEFT JOIN personal.type_present ON personal.type_present.lv_present = personal.training_all.lv_present
        LEFT JOIN personal.type_presentation ON personal.type_presentation.presentation_id = personal.training_all.presentation_id
        LEFT JOIN personal.type_country ON personal.type_country.COUNTRY_CODE = personal.training_all.edu_country
        LEFT JOIN personal.appm_scholarship_type ON personal.appm_scholarship_type.SCH_CODE = personal.training_all.sch_type
        LEFT JOIN responsibilities.attach_file ON responsibilities.attach_file.attach_id =personal.training_all.attach_join
        LEFT JOIN personal.appm_school ON personal.appm_school.SCHOOL_CODE = personal.training_all.edu_institute 
        WHERE personal.training_all.training_num = "'.$idTra.'" AND personal.training_all.present_name = "'.$prename.'" LIMIT 0,1';
    }else if($type === 'dataName'){
        $sql = 'SELECT CONCAT(pa.TFNAME," ",pa.TLNAME) AS fullname,pa.ID_CODE
        FROM personal.appm_personnel AS pa
        WHERE pa.ID_CODE <> " " AND CONCAT(pa.TFNAME," ",pa.TLNAME) LIKE "%'.$name.'%"';
    }

    $result = select($sql);
    //closeDB();
    echo json_encode($result);
?>