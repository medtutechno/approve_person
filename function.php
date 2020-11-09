<?php
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','personal');


    class DB_con{
        function __construct(){
            $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: ".mysqli_connect_error();
            }
        }
        // สมัครสมาชิก หรือลงทะเบียน
        public function registration($fname , $uname , $uemail , $password){
            $reg = mysqli_query($this->dbcon,"INSERT INTO tb_user(fullname,username,email,password)
            VALUE ('$fname','$uname','$uemail','$password')");
            return $reg;
        }
        // เช็ค user ซ้ำใน base
        public function username_check($uname){
            $checkuser = mysqli_query($this->dbcon,"SELECT username FROM tb_user WHERE username = '$uname'");
            return $checkuser;      
        }
        // เช็ค login
        public function signin($uname , $password){
            $signin = mysqli_query($this->dbcon, "SELECT * FROM tb_user WHERE username = '$uname' AND password = '$password'");
            return $signin;
        }
        public function fetch_data(){
            $fetch = mysqli_query($this->dbcon, "SELECT * FROM training_all AS t_all ORDER BY ID DESC LIMIT 100");
            return $fetch;
        }
        public function select($training_num){
            $select = mysqli_query($this->dbcon, "SELECT * FROM training_all WHERE ID = '$training_num' LIMIT 1");
            return $select;
        }
        public function search($topic){
            $search = mysqli_query($this->dbcon, "SELECT * FROM `$topic`");
            return $search;
        }
        public function update($table,$data,$where){
            $modifs="";
            $i=1;
            foreach($data as $key=>$val){
                if($i!=1){ $modifs.=", "; }
                if(is_numeric($val)) { $modifs.=$key.'='.$val; }
                else { $modifs.=$key.' = "'.$val.'"'; }
                $i++;
            }
            $sql = ("UPDATE $table SET $modifs WHERE $where");
            if($this->dbcon->query($sql)) { return true; }
            else { die("SQL Error: <br>".$sql."<br>".$this->dbcon->error); return false; }
        }
    }
?>