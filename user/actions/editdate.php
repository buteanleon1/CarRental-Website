<?
date_default_timezone_set("Europe/Athens");
session_start();
include "../../db_conn.php";

if(isset($_POST['id_rent']) && isset($_POST['datapredarenoua']) && isset($_POST['datapreluare']) && isset($_POST['id_car'])){
	$id_inchirieri = $_POST['id_rent'];
	$id_car = $_POST['id_car'];
	$datapredare = $_POST['datapredarenoua'];
	$datapreluare = $_POST['datapreluare'];
	
	$sqls=$db->prepare("SELECT * FROM `inchirieri` WHERE id_inchirieri!=? AND id_car=? AND (((? BETWEEN startdate AND enddate) OR (? BETWEEN startdate AND enddate)) OR (startdate BETWEEN ? AND ?) OR (enddate BETWEEN ? AND ?))");
	$sqls->execute(array($id_inchirieri, $id_car, $datapreluare, $datapredare, $datapreluare, $datapredare, $datapreluare, $datapredare));
	$count=$sqls->rowCount();
	if($count > 0){
		die("error: already_rented");
	} else {
		$sqls=$db->prepare("UPDATE inchirieri SET enddate=? WHERE id_inchirieri=?");
		$sqls->execute(array($datapredare,$id_inchirieri));
		
		die("date edited successfully");
	}
}else{
	die("data_missing");
}

?>