<?
session_start();
include "../../db_conn.php";

if(isset($_POST['combustibil_nou'])){
	$combustibil_nou = $_POST['combustibil_nou'];
	
	$sqls=$db->prepare("SELECT * FROM `combustibili` WHERE `nume_combustibil`=?");
	$sqls->execute(array($combustibil_nou));
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	if($count == 1 && !empty($row)){
		die("combustibil existent");
	}else {
		$sqlsi=$db->prepare("INSERT INTO combustibili(nume_combustibil) VALUES (?)");
		$sqlsi->execute(array($combustibil_nou));
		die("combustibil added successfully");
	}
}else{
	die("data_missing");
}
?>