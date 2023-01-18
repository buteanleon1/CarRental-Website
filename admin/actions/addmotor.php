<?
session_start();
include "../../db_conn.php";

if(isset($_POST['capacitate_noua'])){
	$capacitate_noua = $_POST['capacitate_noua'];
	
	$sqls=$db->prepare("SELECT * FROM `motoare` WHERE `capacitate`=?");
	$sqls->execute(array($capacitate_noua));
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	if($count == 1 && !empty($row)){
		die("motor existent");
	}else {
		$sqlsi=$db->prepare("INSERT INTO motoare(capacitate) VALUES (?)");
		$sqlsi->execute(array($capacitate_noua));
		die("motor added successfully");
	}
}else{
	die("data_missing");
}
?>