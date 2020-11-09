<?
include "function.php";
$data = array();
$data = $_POST['data'];
$table = $_POST['table'];
$where = $_POST['where'];
$update = new DB_con();
$sql = $update->update($table,$data,$where);

echo json_encode($sql);


?>