<?
session_start();
include "../../db_conn.php";


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['categorie']) && isset($_POST['locatie']) && isset($_POST['marca']) && isset($_POST['model']) && isset($_POST['motor']) && isset($_POST['tractiune']) && isset($_POST['combustibil']) 
	&& isset($_POST['descriere']) && isset($_POST['pret']) && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	$categorie = $_POST['categorie'];
	$locatie =$_POST['locatie'];
	$marca = $_POST['marca'];
	$model = $_POST['model'];
	$motor = $_POST['motor'];
	$tractiune = $_POST['tractiune'];
	$combustibil = $_POST['combustibil'];
	$descriere = $_POST['descriere'];
	$pret = $_POST['pret'];
	
	
	//IMAGES PARAMETERS
    $allowed = array("PNG" => "image/png", "png" => "image/png", "jpg" => "image/jpg", "jpeg" => "image/jpeg","JPG" => "image/jpg", "JPEG" => "image/jpeg", "JPG" => "image/jpg"); //formatul permis
    $filename = $_FILES["photo"]["name"];
    $filetype = $_FILES["photo"]["type"];
    $filesize = $_FILES["photo"]["size"];
	$location = $_FILES["photo"]["tmp_name"];
	
    // Verify file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("error: file_format");
	
    // Verify file size - 50MB maximum
    $maxsize = 50 * 1024 * 1024;
    if($filesize > $maxsize) die("error: file_size");
    
	//Verify file dimensions minimum 940x300
	//list($width, $height) = getimagesize($location); //preia dimensiuni
	//if($width < 940 || $height < 400) die("error: file_dim");
	
    // Verify MYME type of the file
    
    if(in_array($filetype, $allowed)){
        $image_name = generateRandomString(10).'.'.$ext;
		
        if(move_uploaded_file($location, "../../resources/imagini_masini/".$image_name)){
        	
			$sqls=$db->prepare("INSERT INTO autovehicule(id_categorie, id_locatie, id_marca, id_model, id_motor, id_transmisie, id_combustibil, descriere, pret, imagine) VALUES (?,?,?,?,?,?,?,?,?,?)");
			$sqls->execute(array($categorie,$locatie,$marca,$model,$motor,$tractiune,$combustibil,$descriere,$pret, "imagini_masini/".$image_name));
			
        	die("success: data_saved");
        } else {
        	die("error: image_not_saved");
        }			
    } else{
        die("error: file_myme"); 
    }
    
	
	//if everything is fine
	die("car added successfully");
	

}else{
	var_dump($_POST);
	die("data_missing!!!!!!!");
}

?>		