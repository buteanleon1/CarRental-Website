<?php

$sname = "sql207.epizy.com";
$uname = "epiz_28826826";
$password = "WkbwZSl33y";

$db_name = "epiz_28826826_carrental";



try {
  $db = new PDO("mysql:host=$sname;dbname=$db_name; charset=utf8", $uname, $password);
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	
	//die(inchide script);
  die("Connection failed: " . $e->getMessage());
}



