<?
session_start();
include "../../db_conn.php";

if(isset($_POST['user_name']) && isset($_POST['user_pass'])){
	$user_name = $_POST['user_name'];
	$user_password = $_POST['user_pass'];
	
	$password = md5($user_password);
	
	// user data
	$sqls=$db->prepare("SELECT * FROM `utilizatori` WHERE `username`=? AND `password`=?");
	$sqls->execute(array($user_name, $password));
	
	$row=$sqls->fetch(PDO::FETCH_ASSOC);
	$count=$sqls->rowCount();
	
	//verific daca datele de logare sunt corecte
	if($count == 1 && !empty($row)){
		$_SESSION['fullname'] = $row['fullname'];
        $_SESSION['id'] = $row['id_user'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
		
		if($row['status'] == 0){
			die("login: utilizator blocat");
		}else if($_SESSION['role'] === 'user'){
			die("login: success-user");
		} else {
			die("login: success-admin");
		}
		
	} else {
		die("login: error");
	}
} else{
	die("login: data_missing");
}

?>