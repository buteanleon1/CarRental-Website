<?
session_start();
include "../../db_conn.php";

if(isset($_POST['fullname']) && isset($_POST['CNP']) && isset($_POST['datan']) && isset($_POST['address']) && isset($_POST['firstissued']) && isset($_POST['issued']) && isset($_POST['expires']) && isset($_POST['username']) && isset($_POST['password'])){
	$fullname = $_POST['fullname'];
	$CNP = $_POST['CNP'];
	$datan = $_POST['datan'];
	$address = $_POST['address'];
	$firstissued = $_POST['firstissued'];
	$issued = $_POST['issued'];
	$expires = $_POST['expires'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$pass = md5($password);  //cripare parola
	
	$sqls=$db->prepare("SELECT * FROM `utilizatori` WHERE `username`=?");
	$sqls->execute(array($username));
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	$sqls1=$db->prepare("SELECT * FROM `utilizatori` WHERE `CNP`=?");
	$sqls1->execute(array($CNP));
	$row1=$sqls1->fetch(PDO::FETCH_ASSOC);
	$count1=$sqls1->rowCount();
	
	//numele de utilizator trebuie sa fie unic
	if($count == 1 && !empty($row)){
		die("signup: error_already");
	}else if($count1 == 1 && !empty($row1)){
		die("signup: CNPerror_already");
	} else {
		$sqlsi=$db->prepare("INSERT INTO utilizatori(role, username, password, fullname, CNP, data_nasterii, address, firstissued, issued, expires) VALUES (?,?,?,?,?,?,?,?,?,?)");
		$sqlsi->execute(array('user', $username, $pass, $fullname, $CNP, $datan, $address, $firstissued, $issued, $expires));
		die("signup: success");
	}

}else{
	die("signup: data_missing");
}

?>
