<?
session_start();
include "../../db_conn.php";

if(isset($_POST['marca_noua'])){
	$marca_noua = $_POST['marca_noua'];
	
	$sqls=$db->prepare("SELECT * FROM `marci` WHERE `nume_marca`=?");
	$sqls->execute(array($marca_noua));
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	if($count == 1 && !empty($row)){
		die("marca existenta");
	}else {
		$sqlsi=$db->prepare("INSERT INTO marci(nume_marca) VALUES (?)");
		$sqlsi->execute(array($marca_noua));
		die("marca added successfully");
	}
}else{
	die("data_missing");
}
?>