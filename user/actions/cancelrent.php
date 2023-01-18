<?
date_default_timezone_set("Europe/Athens");
session_start();
include "../../db_conn.php";

if(isset($_POST['id_rent'])){
	$id_inchirieri = $_POST['id_rent'];
	
	
	$sqls=$db->prepare("SELECT id_car FROM inchirieri WHERE id_inchirieri=?");
	$sqls->execute(array($id_inchirieri));
	$car = $sqls->fetch(PDO::FETCH_ASSOC);

	$sqlu = $db->prepare("UPDATE autovehicule SET rented=0 WHERE id=?");
	$sqlu -> execute(array($car['id_car']));
	
	
	$sqld=$db->prepare("DELETE FROM inchirieri WHERE id_inchirieri=?");
	$sqld->execute(array($id_inchirieri));
	
	die("rent canceled successfully");
	

}else{
	die("data_missing");
}

?>