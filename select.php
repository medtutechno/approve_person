<?
    include "function.php";
    $select = new DB_con();
    $id = $_POST['id'];
    $sql = $select->select($id);
    $result = mysqli_fetch_assoc($sql);
    echo json_encode($result);
?>