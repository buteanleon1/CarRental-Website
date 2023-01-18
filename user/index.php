<?php
	date_default_timezone_set("Europe/Athens");
	
    session_start();
    include "../db_conn.php";
    if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role'])){

    $page_title = "utilizator";
    include('../components/page_head.php');
?>

<body>
	 	<?php include '../components/top_nav.php'; ?>
     	<div class="uk-container uk-container-large uk-margin-medium">
     	
     	<?php
					$sqls=$db->prepare("SELECT inchirieri.*,locatii.*,marci.*,modele.*,autovehicule.id, autovehicule.pret  FROM `inchirieri`
										LEFT JOIN autovehicule ON autovehicule.id=inchirieri.id_car
										LEFT JOIN locatii ON locatii.id_locatie=inchirieri.id_locatie
										LEFT JOIN marci ON marci.id_marca=autovehicule.id_marca
										LEFT JOIN modele ON modele.id_model=autovehicule.id_model
										WHERE `id_user`=? ORDER BY id_inchirieri DESC");
					$sqls->execute(array($_SESSION['id']));
					?>
					<table class="uk-table uk-table-striped">
					    <thead>
					        <tr>
					        	<th>Masina</th>
					            <th>Oras preluare</th>
					            <th>Oras predare</th>
					            <th>Data preluaree</th>
					            <th>Data predare</th>
					            <th>Total Pret</th>
					            <th>Status</th>
					            <th></th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php while($inchiriere=$sqls->fetch()){
									switch ($inchiriere['status']) {
									  case "pending":
									    $status = "In asteptare";
									    break;
									  case "active":
									    $status = "Activ";
									    break;
									  case "finished":
									    $status = "Terminat";
									    break;
									  default:
									    $status = "Nesetat";
									}
					    	?>
					        <tr>
					        	<td><?php echo $inchiriere['nume_marca'];?> <?php echo $inchiriere['nume_model'];?></td>
					            <td><?php echo $inchiriere['adresa'];?>,<?php echo $inchiriere['oras'];?>,<?php echo $inchiriere['judet'];?></td>
					            <td><?php echo $inchiriere['adresa'];?>,<?php echo $inchiriere['oras'];?>,<?php echo $inchiriere['judet'];?></td>
					            <td><?php echo date("d-M-Y",$inchiriere['startdate']);?></td>
					            <td><?php echo date("d-M-Y",$inchiriere['enddate']);?></td>
					            <td><?php echo $total=(abs($inchiriere['startdate'] - $inchiriere['enddate'])/60/60/24)*$inchiriere['pret'];?> Lei</td>
					            <td><?php echo $status;?></td>
					            <td><button class="uk-button uk-button-primary uk-button-small" name="modificare" onclick="showmodal('<?php echo $inchiriere['id_inchirieri'];?>', '<?php echo $inchiriere['startdate'];?>', '<?php echo $inchiriere['id'];?>');">Modifica</button></td>
					        	<td><button class="uk-button uk-button-danger uk-button-small" name="anulare" onclick="showrent('<?php echo $inchiriere['id_inchirieri'];?>', '<?php echo $inchiriere['startdate'];?>')">Anulare</button></td>
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>
						<div id="modifica" class="uk-flex-top" uk-modal>
					    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
								<button class="uk-modal-close-default" type="button" uk-close></button>
						        <div class="uk-modal-header">
						            <h2 class="uk-modal-title">Modifica rezervare</h2>
						            <div class="uk-alert-danger uk-hidden" id="uk-error-alert" uk-alert>
									    <p>Datele nu au fost introduse corect!</p>
									</div>
									<div class="uk-alert-success uk-hidden" id="uk-success-alert" uk-alert>
									    <p>Data modificata cu succes!</p>
									</div>
						        </div>
						        <div class="uk-modal-body">
									<form name="editaredata" action="" method="post">
										<input type="hidden" value="" id="modal_rent_id">
										<input type="hidden" value="" id="modal_first_date">
										<input type="hidden" value="" id="modal_car_id">
										<fieldset class="uk-fieldset">
											
											<div class="uk-margin">
												<h6>Data predare masina noua:</h6>
											</div>
									        <div class="uk-margin">
									            <input class="uk-input" type="date" name="datapredare" id="datapredarenoua">
									        </div>
			                            </fieldset>
			                        </form>
			                    </div>
						        <div class="uk-modal-footer uk-text-center">
						            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
						            <button class="uk-button uk-button-primary" type="button" onclick="editdate();">Modifica</button>
						        </div>
						</div>
					</div>
					<div id="anuleaza" class="uk-flex-top" uk-modal>
					    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
					
					        <button class="uk-modal-close-default" type="button" uk-close></button>
							<input type="hidden" value="" id="startdate">
					        <p>Esti sigur ca doresti sa anulezi aceasta rezervare?</p>
							<p class="uk-text-right">
					            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
					            <button class="uk-button uk-button-primary" type="button" onclick="cancelrent();">Confirmare</button>
					        </p>
					    </div>
					</div>
				</div>
     	
</body>
<script type="text/javascript">
function showmodal(idrent,datapreluare,idcar){
	$("#modal_rent_id").val(idrent);
	$("#modal_first_date").val(datapreluare);
	$("#modal_car_id").val(idcar);
	UIkit.modal($("#modifica")).show();
}

function editdate(){
	
	let id_rent = $("#modal_rent_id").val();
	let id_car = $("#modal_car_id").val();
	let datapreluare = $("#modal_first_date").val();
	var datapredarenoua = (new Date($("#datapredarenoua").val())).getTime() / 1000;

	$("#uk-error-alert").addClass("uk-hidden");
	$("#uk-success-alert").addClass("uk-hidden");
	
	$.ajax({
        url: 'actions/editdate.php',
        type:'POST',
      	data: {"id_rent": id_rent, "datapredarenoua": datapredarenoua, "datapreluare": datapreluare, "id_car": id_car},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "date edited successfully"){
        		window.location.reload();
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
function showrent(id_rent,startdate){
	$("#modal_rent_id").val(id_rent);
	$("#startdate").val(startdate);
	UIkit.modal($("#anuleaza")).show();
}
function cancelrent(){
	var id_rent = $("#modal_rent_id").val();
	var startdate = $("#startdate").val();
	var current_timestamp = Math.floor(Date.now() / 1000);
	
	if(startdate-current_timestamp <= 3600*24*2){//conditie ca sa nu se poata anula inainde de 2 zile
		UIkit.notification({message: 'Timpul limita de 2 zile pentru anularea închirierii a fost depășit!', status: 'danger'});
		return;
	}else{
		$.ajax({
        url: 'actions/cancelrent.php',
        type:'POST',
      	data: {"id_rent": id_rent},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "rent canceled successfully"){
        		window.location.reload();
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Eroare', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	}
}
</script>

<?php }else{
        header("Location: ../");
    } ?> 