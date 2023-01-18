<?
date_default_timezone_set("Europe/Athens");
session_start();
include "../../db_conn.php";

if(isset($_POST['id_locatie']) && isset($_POST['datapreluare']) && isset($_SESSION['id']) && isset($_POST['datapredare']) 
	&& isset($_POST['car_id']) ){
	
	$id_locatie = $_POST['id_locatie'];
	$datapreluare = $_POST['datapreluare'];
	$datapredare = $_POST['datapredare'];
	$car_id = $_POST['car_id'];
	$user = $_SESSION['id'];
	
	$sqls=$db->prepare("SELECT * FROM `inchirieri` WHERE id_car=? AND (((? BETWEEN startdate AND enddate) OR (? BETWEEN startdate AND enddate)) OR (startdate BETWEEN ? AND ?) OR (enddate BETWEEN ? AND ?))");
	$sqls->execute(array($car_id, $datapreluare, $datapredare, $datapreluare, $datapredare, $datapreluare, $datapredare));
	$count=$sqls->rowCount();
	
	if($count > 0){
		die("error: already_rented");
	} else {
		
		$sqlsi=$db->prepare("INSERT INTO inchirieri(id_user, id_car, id_locatie, startdate, enddate) VALUES (?,?,?,?,?)");
		$sqlsi->execute(array($user, $car_id, $id_locatie, $datapreluare, $datapredare));
		die("car rented successfully");
	}
	
	
	
}else{
	die("data_missing");
}


?>