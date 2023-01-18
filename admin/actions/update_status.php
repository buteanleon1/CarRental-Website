<?
date_default_timezone_set("Europe/Athens");
session_start();
include "../../db_conn.php";

$current_date = time();
$midnight_current_date = strtotime(date("d-m-Y", $current_date));

//SET ACTIVE RENTALS AND RENTED CARS
$sqlsr=$db->prepare("SELECT * FROM `inchirieri` WHERE (? BETWEEN startdate AND enddate) AND enddate >= ?");
$sqlsr->execute(array($current_date, $current_date));

while($rent=$sqlsr->fetch()){
	 
	$sqlsusr=$db->prepare("UPDATE inchirieri SET status='active' WHERE id_inchirieri=?");
	$sqlsusr->execute(array($rent['id_inchirieri']));
	
	$sqlsusc=$db->prepare("UPDATE autovehicule SET rented=1 WHERE id=?");
	$sqlsusc->execute(array($rent['id_car']));
}

//SET FINISHED RENTALS AND UNRENTED CARS
$sqlsr=$db->prepare("SELECT * FROM `inchirieri` WHERE enddate < ?");
$sqlsr->execute(array($midnight_current_date));

while($rent=$sqlsr->fetch()){
	var_dump($rent);
	echo "<BR>";
	
	echo date("d-m-Y", $rent['startdate']);
	echo " - ";
	echo date("d-m-Y", $rent['enddate']);
	echo "<BR><BR>";
	
	$sqlsusr=$db->prepare("UPDATE inchirieri SET status='finished' WHERE id_inchirieri=?");
	$sqlsusr->execute(array($rent['id_inchirieri']));
	
	$sqlsusc=$db->prepare("UPDATE autovehicule SET rented=0 WHERE id=?");
	$sqlsusc->execute(array($rent['id_car']));
}

?>