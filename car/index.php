<?php
    session_start();
    include "../db_conn.php";
	if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role'])){
    
    // check GET request id
    if(isset($_GET['id'])){
        
        $id = $_GET['id'];
		
		$sqls=$db->prepare("SELECT autovehicule.*,categorii_autovehicule.nume,locatii.*,marci.*,modele.*,transmisii.*,combustibili.*,motoare.* FROM `autovehicule` 
							LEFT JOIN categorii_autovehicule ON categorii_autovehicule.id_categorie=autovehicule.id_categorie 
							LEFT JOIN locatii ON locatii.id_locatie=autovehicule.id_locatie
							LEFT JOIN marci ON marci.id_marca=autovehicule.id_marca
							LEFT JOIN modele ON modele.id_model=autovehicule.id_model
							LEFT JOIN transmisii ON transmisii.id_transmisie=autovehicule.id_transmisie
							LEFT JOIN combustibili ON combustibili.id_combustibil=autovehicule.id_combustibil
							LEFT JOIN motoare ON motoare.id_motor=autovehicule.id_motor
							WHERE autovehicule.id=?");
		$sqls->execute(array($id));
        $car = $sqls->fetch(PDO::FETCH_ASSOC);
	}
    
    $page_title = "car";
    include('../components/page_head.php');
?>

<html>
  
    <body>
    	<?php include '../components/top_nav.php'; ?>
        <div class="uk-container uk-container-expand uk-padding-small uk-padding-remove-top">
            <div class="uk-container uk-margin">
            	<div class="uk-padding">
			 		<div class="uk-margin-top">
			 			<div uk-grid>
			                <?php if(isset($car)): ?>
			                
			                <div class="uk-width-1-2@m uk-width-1-2@l">
			                    <img class="d-block w-100" src="../resources/<?= $car['imagine']; ?>">
			                </div>
			                <div class="uk-width-1-2@m uk-width-1-2@l uk-width-expand@s">
			                    <h2 class="uk-margin-small-bottom"><?= $car['nume_marca']; ?> <?= $car['nume_model']; ?></h2>
			                    <p>
								    <a class="uk-button uk-button-primary uk-button-small uk-padding-small uk-margin-small-top" data-bs-toggle="modal" href="#modal" uk-toggle>Inchiriaza</a>
								</p>
			                    <p class="uk-text-primary uk-text-bold uk-text-large uk-margin-small-bottom">PRET/ZI: <?= $car['pret'];?> Lei</p>
			                    <p class="uk-margin-small-bottom">Cod Produs: <?=$car['id'];?></p>
			                    <p><b>Capacitate cilindrica:</b> <?= $car['capacitate'];?> cm3</p>
			                    <p><b>Tractiune:</b> <?= $car['nume_transmisie'];?></p>
			                    <p><b>Combustibil:</b> <?= $car['nume_combustibil'];?></p>
			                    <p><b>Localizare:</b> <?=$car['adresa'];?>,<?=$car['oras'];?>,<?=$car['judet'];?></p>
								<div id="modal" class="uk-flex-top" uk-modal>
								    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
										<button class="uk-modal-close-default" type="button" uk-close></button>
								        <div class="uk-modal-header">
								            <h2 class="uk-modal-title">Rezervare</h2>
								            <div class="uk-alert-danger uk-hidden" id="uk-error-alert" uk-alert>
											    <p>Datele nu au fost introduse corect!</p>
											</div>
											<div class="uk-alert-success uk-hidden" id="uk-success-alert" uk-alert>
											    <p>Autovehicul inchiriat cu succes!</p>
											</div>
								        </div>
								        <div class="uk-modal-body">
											<form name="formular" action="" method="post">
												<fieldset class="uk-fieldset">
													<input type="hidden" value="<?php echo $car['id'];?>" id="car_id">
													<div class="uk-margin">
														<h6>Locatie preluare masina:</h6>
													</div>
													<div class="uk-margin">
														<select class="uk-select" name="id_locatie" id="id_locatie">
											                <option value="<?=$car['id_locatie'];?>"><?=$car['adresa'];?>,<?=$car['oras'];?>,<?=$car['judet'];?></option>
											            </select>
											        </div>
											        <div class="uk-margin">
														<h6>Locatie predare masina:</h6>
													</div>
													<div class="uk-margin">
											            <select class="uk-select">
											                <option value="<?=$car['id_locatie'];?>"><?=$car['adresa'];?>,<?=$car['oras'];?>,<?=$car['judet'];?></option>
											            </select>
											        </div>
											        <div class="uk-margin">
														<h6>Data preluare masina:</h6>
													</div>
											        <div class="uk-margin">
											            <input class="uk-input" type="date" name="datapreluare" id="datapreluare">
											        </div>
											        <div class="uk-margin">
														<h6>Data predare masina:</h6>
													</div>
											        <div class="uk-margin">
											            <input class="uk-input" type="date" name="datapredare" id="datapredare">
											        </div>
					                            </fieldset>
					                        </form>
					                    </div>
								        <div class="uk-modal-footer uk-text-center">
								            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
								            <button class="uk-button uk-button-primary" type="button" onclick="rentcar();">Inchiriaza</button>
								        </div>
								    </div>
								</div>
			                </div>
			                </div>
			                <h6 class="uk-margin-large-top">despre masina:</h6>
			                <p><?=$car['descriere'];?></p>
			                   
			                <?php else: ?>
			
			                    <h5>Nu exista in baza de date nici o masina cu acest id!</h5>
			
			                <?php endif; ?>
                
                
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
function rentcar(){
	var id_locatie = $("#id_locatie").val();
	var datapreluare = (new Date($("#datapreluare").val())).getTime() / 1000;
	var datapredare = (new Date($("#datapredare").val())).getTime() / 1000;
	var car_id = $("#car_id").val();
	$("#uk-error-alert").addClass("uk-hidden");
	nowDate = new Date();
	
	var current_timestamp = Math.floor(new Date(nowDate.getFullYear()+'/'+(nowDate.getMonth()+1)+'/'+nowDate.getDate()) / 1000);
	console.log(current_timestamp);
	//todo conditie sa verific daca startdate > currentdate
	if(datapreluare > datapredare || datapreluare == 0 || datapredare==0 || datapreluare=="NaN" || datapredare=="NaN"){
		$("#uk-error-alert").toggleClass("uk-hidden");
		return;	
	}
	if(datapreluare<current_timestamp){
		UIkit.notification({message: 'Data de preluare este invalida', status: 'danger'});
		return;	
	}
	
	
	$.ajax({
        url: 'actions/rent_car.php',
        type:'POST',
      	data: {"id_locatie": id_locatie, "datapreluare": datapreluare, "datapredare": datapredare, "car_id": car_id},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "car rented successfully"){
        		$("#uk-success-alert").toggleClass("uk-hidden");
        	}else if(data == "error: already_rented"){
        		UIkit.notification({message: 'Masina este deja inchiriata in acea prerioada', status: 'danger'})
        	} else if(data == "data_missing"){
        		$("#uk-error-alert").toggleClass("uk-hidden");
        	} else {
        		console.log(data);
        	}
      	}
    });

}
</script>

<?php }else{
        header("Location: ../");
    } ?> 