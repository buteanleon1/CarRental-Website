<?php
    session_start();
    include "../../db_conn.php";
    
    if(isset($_POST['action'])){
    	
        $sql = "SELECT autovehicule.*,categorii_autovehicule.nume,locatii.*,marci.*,modele.*,transmisii.*,combustibili.*,motoare.* FROM `autovehicule` 
							LEFT JOIN categorii_autovehicule ON categorii_autovehicule.id_categorie=autovehicule.id_categorie 
							LEFT JOIN locatii ON locatii.id_locatie=autovehicule.id_locatie
							LEFT JOIN marci ON marci.id_marca=autovehicule.id_marca
							LEFT JOIN modele ON modele.id_model=autovehicule.id_model
							LEFT JOIN transmisii ON transmisii.id_transmisie=autovehicule.id_transmisie
							LEFT JOIN combustibili ON combustibili.id_combustibil=autovehicule.id_combustibil
							LEFT JOIN motoare ON motoare.id_motor=autovehicule.id_motor
							WHERE autovehicule.status=1 ";
        
        if(isset($_POST['marca'])){
            $marca = implode("','", $_POST['marca']);
            $sql .=" AND autovehicule.id_marca IN('".$marca."')";
        }
		if(isset($_POST['categorie'])){
            $categorie = implode("','", $_POST['categorie']);
            $sql .=" AND autovehicule.id_categorie IN('".$categorie."')";
        }
        if(isset($_POST['motor'])){
            $motor = implode("','", $_POST['motor']);
            $sql .=" AND autovehicule.id_motor IN('".$motor."')";
        }
        if(isset($_POST['combustibil'])){
            $combustibil = implode("','", $_POST['combustibil']);
            $sql .=" AND autovehicule.id_combustibil IN('".$combustibil."')";
        }
        if(isset($_POST['tractiune'])){
            $tractiune = implode("','", $_POST['tractiune']);
            $sql .=" AND autovehicule.id_transmisie IN('".$tractiune."')";
        }
		if(isset($_POST['locatie'])){
            $locatie = implode("','", $_POST['locatie']);
            $sql .=" AND autovehicule.id_locatie IN('".$locatie."')";
        }
        
		$sqls=$db->prepare($sql);
        $sqls->execute();
        $output = '';
        // afisare in functie de filtrele alese
        if($sqls->rowCount()>0){
            while($row=$sqls->fetch()){
				$output .= '<div>
						    <div class="uk-card uk-card-default uk-padding-small uk-box-shadow-large">
						        <div class="uk-card-media-top">
								      <img class="uk-pointer img-list-preview uk-align-center uk-height-small" src="../resources/'.$row['imagine'].'" alt="">
								    
						        </div>
						        <div class="uk-card-body uk-padding-small uk-text-small">
						         	<span>Cod Produs: '.$row['id'].'</span>
						            <h6 class="uk-margin-small-top">Marca: '.$row['nume_marca'].'</h6>
						            <h6 class="uk-margin-small-top">Model: '.$row['nume_model'].'</h6>
						            <h6 class="uk-margin-small-top">Categorie: '.$row['nume'].'</h6>
						            <h6 class="uk-margin-small-top">Cc: '.$row['capacitate'].' cm3</h6>
						            <h6 class="uk-margin-small-top">Combustibil: '.$row['nume_combustibil'].'</h6>
						            <h6 class="uk-margin-small-top">Localizare:</h6>
						            <p class="uk-margin-small-top">'.$row['adresa'].', '.$row['oras'].', '.$row['judet'].'</p>
						            <div class="uk-width-1-1 uk-text-right uk-text-large">
						            	<p class="uk-text-primary uk-text-bold">'.$row['pret'].' RON</p>
						            	<p class="uk-text-bold"></p>
						            </div>
						            <br>
						            <div class="uk-width-1-1 uk-position-bottom ">
						            	<a href="../car/?id='.$row['id'].'" class="uk-button uk-button-primary uk-button-small uk-width-1-1"><span uk-icon="icon: cart; ratio: 1"></span> Vezi detalii</a>
						            </div>
						        </div>
						    </div>
						</div>';
            }
        }
        else{
            $output = "<h3>Nu a fost gasit nici un autovehicul!</h3>";
        }
        echo $output;
    }
?>
