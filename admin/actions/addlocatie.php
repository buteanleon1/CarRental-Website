<?
session_start();
include "../../db_conn.php";

if(isset($_POST['adresa_noua']) && isset($_POST['oras_nou']) && isset($_POST['judet_nou'])){
	$adresa_noua = $_POST['adresa_noua'];
	$oras_nou = $_POST['oras_nou'];
	$judet_nou = $_POST['judet_nou'];
	
	
	$sqlsi=$db->prepare("INSERT INTO locatii(adresa,oras,judet) VALUES (?,?,?)");
	$sqlsi->execute(array($adresa_noua,$oras_nou,$judet_nou));
	die("locatie added successfully");
	
}else{
	die("data_missing");
}
?>