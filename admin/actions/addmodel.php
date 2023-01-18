<?
session_start();
include "../../db_conn.php";

if(isset($_POST['model_nou']) && isset($_POST['marca_model'])){
	$model_nou = $_POST['model_nou'];
	$marca = $_POST['marca_model'];
	
	$sqls=$db->prepare("SELECT * FROM `modele` WHERE nume_model=? AND id_marca=?");
	$sqls->execute(array($model_nou,$marca));
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	if($count == 1 && !empty($row)){
		die("model existent");
	}else {
		$sqlsi=$db->prepare("INSERT INTO modele(nume_model,id_marca) VALUES (?,?)");
		$sqlsi->execute(array($model_nou,$marca));
		die("model added successfully");
	}
}else{
	die("data_missing");
}
?>