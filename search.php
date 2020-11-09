<?
include "function.php";

$topic = $_POST['topic'];
$result = array();
$search = new DB_con();


    $sql = $search->search($topic);
    // echo json_encode($sql) ;
    if(mysqli_num_rows($sql) > 0){
        while($data = mysqli_fetch_assoc($sql)){
            $result[] = $data;
        }
    }
echo json_encode($result);
?>