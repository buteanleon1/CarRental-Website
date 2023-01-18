<?
date_default_timezone_set("Europe/Athens");
include("../../db_conn.php");

session_start();
$current_year = date('Y');
$current_day_month = date('m-d');
$response = new stdClass();

if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){
	//get statistics here
	
	//nr. inchirieri/luna
	$rent_monthly_count = array();
	$monthly_profit = array();
	$start    = new DateTime($current_year."-".$current_day_month);
	$start->modify('first day of this month');
	$end      = new DateTime(($current_year+1)."-".$current_day_month);
	$end->modify('last day of next month');
	$interval = DateInterval::createFromDateString('1 month');
	$period   = new DatePeriod($start, $interval, $end);

	$month_nr = 0;
	foreach ($period as $dt) {
		$month_nr++;
		$row = array(
			"label" => $dt->format("M Y"),
			"timestamp" => strtotime($dt->format("Y-m-d"))
		);
		
		array_push($rent_monthly_count, $row);
		array_push($monthly_profit, $row);
	}
	
	for($i=0; $i<count($rent_monthly_count); $i++){
		
		
		$sqls=$db->prepare("SELECT COUNT(id_inchirieri) FROM `inchirieri` WHERE (startdate BETWEEN ? AND ?) AND (enddate BETWEEN ? AND ?) ");
		$sqls->execute(array($rent_monthly_count[$i]['timestamp'], $rent_monthly_count[$i+1]['timestamp'], $rent_monthly_count[$i]['timestamp'], $rent_monthly_count[$i+1]['timestamp']));
		$row = $sqls->fetch(PDO::FETCH_ASSOC);
		
		$rent_monthly_count[$i]["count"] = $row['COUNT(id_inchirieri)'];
		
		
	}
	
	//profit/luna
	
	for($i=0; $i<count($monthly_profit); $i++){
		$sqls=$db->prepare("SELECT inchirieri.id_car, inchirieri.startdate, inchirieri.enddate, autovehicule.pret FROM `inchirieri` 
							LEFT JOIN autovehicule ON autovehicule.id=inchirieri.id_car
							WHERE (startdate BETWEEN ? AND ?) AND (enddate BETWEEN ? AND ?) ");
		$sqls->execute(array($rent_monthly_count[$i]['timestamp'], $rent_monthly_count[$i+1]['timestamp'], $rent_monthly_count[$i]['timestamp'], $rent_monthly_count[$i+1]['timestamp']));
		
		$monthly_total_profit = 0;
		
		while($car=$sqls->fetch()){
			$days_rented = ($car['enddate'] - $car['startdate'])/(3600*24);
			
			$monthly_total_profit+=($car['pret']*$days_rented);
			
		} 
		$monthly_profit[$i]["total"] = $monthly_total_profit;
	}
	
	//profit/saptamana
	$weekly_profit = array();
	$monday = strtotime('Last Monday', time());
	
	$weekly_profit[0]["timestamp"] = $monday;
	for($i=0; $i<6; $i++){
		$weekly_profit[$i+1]["timestamp"] = $weekly_profit[$i]["timestamp"]+(3600*24);
		$weekly_profit[$i]["label"] = date('D', $weekly_profit[$i]["timestamp"]);
		$weekly_profit[$i+1]["label"] = date('D', $weekly_profit[$i+1]["timestamp"]);
		
		
		$sqlsw=$db->prepare("SELECT inchirieri.id_car, inchirieri.startdate, inchirieri.enddate, autovehicule.pret FROM `inchirieri` 
							LEFT JOIN autovehicule ON autovehicule.id=inchirieri.id_car
							WHERE (startdate BETWEEN ? AND ?) OR (enddate BETWEEN ? AND ?)");
		$sqlsw->execute(array($weekly_profit[$i]['timestamp'], $weekly_profit[$i+1]['timestamp'], $weekly_profit[$i]['timestamp'], $weekly_profit[$i+1]['timestamp']));
		
		$weekly_total_profit = 0;
		
		
		while($w=$sqlsw->fetch()){
			$days_rented = ($w['enddate'] - $w['startdate'])/(3600*24);
			
			$weekly_total_profit+=($w['pret']*$days_rented);
			
		} 
		$weekly_profit[$i]["total"] = $weekly_total_profit;
	}
	
	//top marci
	
	$top_brand = array();
	
	$sqls=$db->prepare("SELECT marci.id_marca, marci.nume_marca, COUNT(inchirieri.id_inchirieri)
						FROM `marci`
						LEFT JOIN autovehicule ON autovehicule.id_marca=marci.id_marca
						LEFT JOIN inchirieri ON inchirieri.id_car=autovehicule.id
						GROUP BY marci.id_marca");
	$sqls->execute();
	while($m=$sqls->fetch()){
		$id = $m["id_marca"];
		$top_brand[$id]['label'] = $m["nume_marca"];
		$top_brand[$id]['count'] = $m["COUNT(inchirieri.id_inchirieri)"];
	} 
	
	//top locatii
	
	$top_location = array();
	
	$sqls=$db->prepare("SELECT locatii.id_locatie, locatii.oras, COUNT(inchirieri.id_inchirieri)
						FROM `locatii`
						LEFT JOIN autovehicule ON autovehicule.id_locatie=locatii.id_locatie
						LEFT JOIN inchirieri ON inchirieri.id_car=autovehicule.id
						GROUP BY locatii.id_locatie");
	$sqls->execute();
	while($l=$sqls->fetch()){
		$id = $l["id_locatie"];
		$top_location[$id]['label'] = $l["oras"];
		$top_location[$id]['count'] = $l["COUNT(inchirieri.id_inchirieri)"];
	}
	
	//top categorii
	
	$top_category = array();
	
	$sqls=$db->prepare("SELECT categorii_autovehicule.id_categorie, categorii_autovehicule.nume, COUNT(autovehicule.id)
						FROM `categorii_autovehicule`
						LEFT JOIN autovehicule ON autovehicule.id_categorie=categorii_autovehicule.id_categorie
						LEFT JOIN inchirieri ON inchirieri.id_car=autovehicule.id
						GROUP BY categorii_autovehicule.id_categorie");
	$sqls->execute();
	while($c=$sqls->fetch()){
		$id = $c["id_categorie"];
		$top_category[$id]['label'] = $c["nume"];
		$top_category[$id]['count'] = $c["COUNT(autovehicule.id)"];
	}
	
	
	$response->rent_per_month = $rent_monthly_count;
	$response->monthly_profit = $monthly_profit;
	$response->weekly_profit = $weekly_profit;
	$response->top_brand = $top_brand;
	$response->top_location = $top_location;
	$response->top_category = $top_category;
	
	
	//die(json_encode($response));
}else {
	$response->status = "data_missing";
}

die(json_encode($response));

?>
