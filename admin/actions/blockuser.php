<?
session_start();
include "../../db_conn.php";

if(isset($_POST['id_user']) && isset($_POST['status'])){
	$id_user = $_POST['id_user'];
	$status = $_POST['status'];
	

	
	$sqlu=$db->prepare("UPDATE utilizatori SET status=? WHERE id_user=?");
	$sqlu->execute(array($status,$id_user));
	
	die("user blocked successfully");
	var_dump($_POST);

}else{
	die("data_missing");
}

?>	