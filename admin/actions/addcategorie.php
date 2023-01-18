<?
session_start();
include "../../db_conn.php";

if(isset($_POST['categorie_noua'])){
	$categorie_noua = $_POST['categorie_noua'];
	
	$sqls=$db->prepare("SELECT * FROM `categorii_autovehicule` WHERE `nume`=?");
	$sqls->execute(array($categorie_noua));
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	if($count == 1 && !empty($row)){
		die("categorie existenta");
	}else {
		$sqlsi=$db->prepare("INSERT INTO categorii_autovehicule(nume) VALUES (?)");
		$sqlsi->execute(array($categorie_noua));
		die("category added successfully");
	}
}else{
	die("data_missing");
}
?>