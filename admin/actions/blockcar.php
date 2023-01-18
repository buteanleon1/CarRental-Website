<?
session_start();
include "../../db_conn.php";

if(isset($_POST['car_id']) && isset($_POST['status'])){
	$car_id = $_POST['car_id'];
	$status = $_POST['status'];
	
	
	$sqls=$db->prepare("UPDATE autovehicule SET status=? WHERE id=?");
	$sqls->execute(array($status,$car_id));
	
	die("car blocked successfully");
	var_dump($_POST);

}else{
	die("data_missing");
}

?>	