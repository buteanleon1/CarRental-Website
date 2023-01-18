<?
session_start();
include "../../db_conn.php";

if(isset($_POST['id_marca'])){
	$id_marca = $_POST['id_marca'];
	
	$sqls=$db->prepare("SELECT * FROM `modele` WHERE `id_marca`=?");
	$sqls->execute(array($id_marca));
	
	while($row=$sqls->fetch()){
		$id = $row['id_model'];
		$nume = $row['nume_model'];
		$modele[$id] = $nume;
	}
	
	die(json_encode($modele));
	
}else {
	die("no_data");
}
?>