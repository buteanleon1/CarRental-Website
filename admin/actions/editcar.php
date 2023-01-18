<?
session_start();
include "../../db_conn.php";

if(isset($_POST['descriere_noua']) && isset($_POST['pret_nou']) && isset($_POST['id_car'])){
	$descriere_noua = $_POST['descriere_noua'];
	$pret_nou = $_POST['pret_nou'];
	$id_car = $_POST['id_car'];
	
	
	$sqls=$db->prepare("UPDATE autovehicule SET descriere=?,pret=? WHERE id=?");
	$sqls->execute(array($descriere_noua,$pret_nou,$id_car));
	
	die("car edited successfully");
	

}else{
	die("data_missing");
}

?>