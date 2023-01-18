<?php
	date_default_timezone_set("Europe/Athens");
	
    session_start();
    include "../db_conn.php";
    if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role']) && ($_SESSION['role']=='admin')){

    $page_title = "admin";
    include('../components/page_head.php');
?>

<body>
	 	<?php include '../components/top_nav.php'; ?>
     	<div class="uk-container uk-container-xlarge uk-margin">
     		
     	<div class="uk-margin-medium-top">
		    <ul class=" uk-child-width-expand" uk-tab>
		        <li class="uk-active-text-bold"><a href="#one">Statistici</a></li>
		        <li><a href="#two">Utilizatori</a></li>
		        <li><a href="#three">Inchirieri</a></li>
		        <li><a href="#four">Autovehicule</a></li>
		        <li><a href="#five">Parametrii</a></li>
		    </ul>
		    <div class="uk-switcher">
		    	<!--Diagrame-->
		    	<div class="uk-tab-active" id="one">
					<div class="uk-child-width-1-2@l uk-child-width-1-2@m uk-text-center uk-margin-top uk-grid-large" uk-grid>
					    <div>
					        <canvas id="uk-line-chart"></canvas>
					    </div>
					    <div>
					        <canvas id="uk-bar-chart"></canvas>
					    </div>
					    <div>
					        <canvas id="uk-bar2-chart"></canvas>
					    </div>
					    <div>
					        <canvas id="uk-polar-chart"></canvas>
					    </div>
					    <div>
					        <canvas id="uk-doughnut2-chart"></canvas>
					    </div>
					    <div>
					        <canvas id="uk-doughnut-chart"></canvas>
					    </div>
					    
					</div>
				</div>
				<!--Users-->
				<div class="uk-tab-active" id="two">
					<?php
					$sqls=$db->prepare("SELECT * FROM utilizatori WHERE role='user'");
					$sqls->execute();
					?>
					<table class="uk-table uk-table-striped uk-table-middle">
					    <thead>
					        <tr>
					            <th>Nume si Prenume</th>
					            <th>CNP</th>
					            <th>Adresa</th>
					            <th>Data primei emiteri a permisului</th>
					            <th>Data emitere permis</th>
					            <th>Data expirare permis</th>
					            <th>Nume utilizator</th>
					            <th>Status</th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php while($user=$sqls->fetch()){?>
					        <tr>
					            <td><?php echo $user['fullname'];?></td>
					            <td><?php echo $user['CNP'];?></td>
					            <td><?php echo $user['address'];?></td>
					            <td><?php echo date("d-M-Y",$user['firstissued']);?></td>
					            <td><?php echo date("d-M-Y",$user['issued']);?></td>
					            <td><?php echo date("d-M-Y",$user['expires']);?></td>
					            <td><?php echo $user['username'];?></td>
					            <?if($user['status'] == 1){?>
					            	<td>Activ</td>
					            <? } else {?>
					            	<td>Blocat</td>
					            <? }?>
					            <?if($user['status'] == 1){?>
					            	<td><button class="uk-button uk-button-danger uk-button-small" name="blocare" onclick="blockuser('<?php echo $user['id_user'];?>', 0)">Blocare</button></td>
					            <? } else {?>
					            	<td><button class="uk-button uk-button-danger uk-button-small" name="deblocare" onclick="blockuser('<?php echo $user['id_user'];?>', 1)">Deblocare</button></td>
					            <? }?>
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>
				</div>
				<!--Inchirieri-->
				<div class="uk-tab-active" id="three">
					<?php
					$sqls=$db->prepare("SELECT inchirieri.*,locatii.*,utilizatori.fullname,utilizatori.username,autovehicule.pret,autovehicule.id,marci.*,modele.* FROM inchirieri
								LEFT JOIN locatii ON locatii.id_locatie=inchirieri.id_locatie
								LEFT JOIN autovehicule ON autovehicule.id=inchirieri.id_car
								LEFT JOIN utilizatori ON utilizatori.id_user=inchirieri.id_user
								LEFT JOIN marci ON marci.id_marca=autovehicule.id_marca 
								LEFT JOIN modele ON modele.id_model=autovehicule.id_model
								 ORDER BY id_inchirieri DESC");
					$sqls->execute();
					?>
					<table class="uk-table uk-table-striped">
					    <thead>
					        <tr>
					            <th>Nume si Prenume</th>
					            <th>Utilizator</th>
					            <th>Masina</th>
					            <th>Cod masina</th>
					            <th>Loc preluare</th>
					            <th>Loc predare</th>
					            <th>Data preluare</th>
					            <th>Data predare</th>
					            <th>Status</th>
					            <th>Total pret(Lei)</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php while($rent=$sqls->fetch()){
					    		
								switch ($rent['status']) {
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
					            <td><?php echo $rent['fullname'];?></td>
					            <td><?php echo $rent['username'];?></td>
					            <td><?php echo $rent['nume_marca'];?> <?php echo $rent['nume_model'];?></td>
					            <td><?php echo $rent['id'];?></td>
					            <td><?=$rent['adresa'];?>,<?=$rent['oras'];?>,<?=$rent['judet'];?></td>
					            <td><?=$rent['adresa'];?>,<?=$rent['oras'];?>,<?=$rent['judet'];?></td>
					            <td><?php echo date('d/M/Y',$rent['startdate']);?></td>
					            <td><?php echo date('d/M/Y',$rent['enddate']);?></td>
					            <td><?php echo $status;?></td>
					            <td><?php echo $total=(abs($rent['startdate'] - $rent['enddate'])/60/60/24)*$rent['pret'];?></td>
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>
				</div>
				<!--Autovehicule-->
				<div class="uk-tab-active" id="four">
					<p uk-margin>
					    <a class="uk-button uk-button-primary uk-button-large uk-align-left" href="#modal-center" uk-toggle>Adauga autovehicul</a>
					</p>
					<div id="modal-center" class="uk-flex-top" uk-modal>
					    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
							<button class="uk-modal-close-default" type="button" uk-close></button>
					        <div class="uk-modal-header">
					            <h2 class="uk-modal-title">Masina noua</h2>
					            <div class="uk-alert-danger uk-hidden" id="uk-error-alert" uk-alert>
								    <p>Datele nu au fost introduse corect!</p>
								</div>
								<div class="uk-alert-success uk-hidden" id="uk-success-alert" uk-alert>
								    <p>Autovehicul adaugat cu succes!</p>
								</div>
					        </div>
					        <div class="uk-modal-body">
								<form name="formular" enctype="multipart/form-data">
									<fieldset class="uk-fieldset">
										<?php $sqls=$db->prepare("SELECT * FROM `categorii_autovehicule`");
											$sqls->execute(array());?>
										<h6>Categorie:</h6>
										<div class="uk-margin">
								            <select class="uk-select" name="categorie" id="categorie">
								                <?php while($categorie=$sqls->fetch()){?>
								                <option value="<?=$categorie['id_categorie'];?>"><?=$categorie['nume'];?></option>
								                <?php }?>
								            </select>
								        </div>
								        <?php $sqls=$db->prepare("SELECT * FROM `locatii`");
											$sqls->execute(array());?>
								        <h6>Localizare:</h6>
										<div class="uk-margin">
								            <select class="uk-select" name="locatie" id="locatie">
								                <?php while($locatie=$sqls->fetch()){?>
								                <option value="<?=$locatie['id_locatie'];?>"><?=$locatie['adresa'];?>, <?=$locatie['oras'];?>, <?=$locatie['judet'];?></option>
								                <?php }?>
								            </select>
								        </div>
								        <?php $sqls=$db->prepare("SELECT * FROM `marci`");
											$sqls->execute(array());?>
										<h6>Marca:</h6>
								        <div class="uk-margin">
								        	<select class="uk-select" name="marca" id="marca" onchange="get_models(this);">
								        		<?php while($marca=$sqls->fetch()){?>
								                <option value="<?=$marca['id_marca'];?>"><?=$marca['nume_marca'];?></option>
								                <?php }?>
								            </select>
								        </div>
								        <h6>Model:</h6>
								        <div class="uk-margin">
								            <select class="uk-select" name="model" id="model">
								                <option value="0">Alege marca</option>
								            </select>
								        </div>
								        <?php $sqls=$db->prepare("SELECT * FROM `motoare` ORDER BY capacitate ASC");
											$sqls->execute(array());?>
								        <h6>Capacitate cilindrica (cm3):</h6>
								        <div class="uk-margin">
								            <select class="uk-select" name="motor" id="motor">
								                <?php while($motor=$sqls->fetch()){?>
								                <option value="<?=$motor['id_motor'];?>"><?=$motor['capacitate'];?></option>
								                <?php }?>
								            </select>
								        </div>
								        <?php $sqls=$db->prepare("SELECT * FROM `transmisii`");
											$sqls->execute(array());?>
										<h6>Transmisie:</h6>
								        <div class="uk-margin">
								            <select class="uk-select" name="tractiune" id="tractiune">
								                <?php while($transmisie=$sqls->fetch()){?>
								                <option value="<?=$transmisie['id_transmisie'];?>"><?=$transmisie['nume_transmisie'];?></option>
								                <?php }?>
								            </select>
								        </div>
								        <?php $sqls=$db->prepare("SELECT * FROM `combustibili`");
											$sqls->execute(array());?>
								        <h6>Combustibil:</h6>
								        <div class="uk-margin">
								            <select class="uk-select" name="combustibil" id="combustibil">
								               	<?php while($combustibil=$sqls->fetch()){?>
								                <option value="<?=$combustibil['id_combustibil'];?>"><?=$combustibil['nume_combustibil'];?></option>
								                <?php }?>
								            </select>
								        </div>
								        <div class="uk-margin">
								            <textarea class="uk-textarea" rows="8" placeholder="Descriere/Dotari" name="descriere" id="descriere"></textarea>
								        </div>
								        <div class="uk-margin">
								            <input class="uk-input" type="text" placeholder="Pret/zi(Lei)" pattern="[0-9]" name="pret" id="pret">
								        </div>
								        <div class="uk-margin">
									        <div class="uk-margin">
									    		<label class="uk-form-label">Imagine</label>
										        <div class="uk-form-controls">
										    		<div class="js-upload uk-placeholder uk-text-center">
													    <span uk-icon="icon: cloud-upload"></span>
													    <span class="uk-text-middle">Atașați fișiere trăgându-le aici sau</span>
													    <div uk-form-custom>
													    	<form name="uploader" enctype="multipart/form-data">
													        	<input id="photo" class="file-upload__input" type="file" name="photo" />
													        	<span class="uk-link">alegeți aici</span>.
													        </form>
													    </div>
													</div>
													<p class="uk-text-meta"><small>*Fișierele dvs. trebuie să aibă ca <b>dimensiune maximă 1MB</b>. Tipurile de fișiere permise sunt: <b>imaginile</b> (.jpg, .jpeg, .png)</small></p>
											    	
												</div>
					
									    	</div>
									    </div>
		                            </fieldset>
		                        </form>
		                    </div>
					        <div class="uk-modal-footer uk-text-center">
					            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
					            <button class="uk-button uk-button-primary" type="button" onclick="addcar();">Adauga</button>
					        </div>
					    </div>
					</div>
					<?php
					$sqls=$db->prepare("SELECT autovehicule.*,marci.*,modele.*,transmisii.*,combustibili.*,motoare.*,locatii.*,categorii_autovehicule.* FROM `autovehicule`
					LEFT JOIN categorii_autovehicule ON categorii_autovehicule.id_categorie=autovehicule.id_categorie 
					LEFT JOIN locatii ON locatii.id_locatie=autovehicule.id_locatie 
					LEFT JOIN marci ON marci.id_marca=autovehicule.id_marca
					LEFT JOIN modele ON modele.id_model=autovehicule.id_model
					LEFT JOIN transmisii ON transmisii.id_transmisie=autovehicule.id_transmisie
					LEFT JOIN combustibili ON combustibili.id_combustibil=autovehicule.id_combustibil
					LEFT JOIN motoare ON motoare.id_motor=autovehicule.id_motor ORDER BY autovehicule.id DESC");
					$sqls->execute();
					?>
					<table class="uk-table uk-table-striped uk-table-large">
					    <thead>
					        <tr class="uk-text-center">
					        	<th>Cod</th>
					            <th>Marca</th>
					            <th>Model</th>
					            <th>Categorie</th>
					            <th>Localizare</th>
					            <th>Capacitate cilindrica</th>
					            <th>Combustibil</th>
					            <th>Transmisie</th>
					            <th>Descriere</th>
					            <th>Pret/zi(LEI)</th>
					            <th>Disponibil</th>
					            <th>Status</th>
					            <th></th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php while($car=$sqls->fetch()){?>
					        <tr class="uk-text-center">
					        	<td><?php echo $car['id'];?></td>
					            <td><?php echo $car['nume_marca'];?></td>
					            <td><?php echo $car['nume_model'];?></td>
					            <td><?php echo $car['nume'];?></td>
					            <td><?php echo $car['oras'];?>,<?php echo $car['judet'];?></td>
					            <td><?php echo $car['capacitate'];?></td>
					            <td><?php echo $car['nume_combustibil'];?></td>
					            <td><?php echo $car['nume_transmisie'];?></td>
					            <td><?=str_replace("\n","",$car['descriere']);?></td>
					            <td><?php echo $car['pret'];?></td>
					            <?if($car['rented'] == 0){?>
					            	<td>Da</td>
					            <? } else {?>
					            	<td>Nu</td>
					            <? }?>
					            <?if($car['status'] == 1){?>
					            	<td>Activ</td>
					            <? } else {?>
					            	<td>Inactiv</td>
					            <? }?>
					            <?if($car['status'] == 1){?>
					            	<td><button class="uk-button uk-button-danger uk-button-small" name="blocare" onclick="blockcar('<?php echo $car['id'];?>', 0)">Blocare</button></td>
					            <? } else {?>
					            	<td><button class="uk-button uk-button-danger uk-button-small" name="deblocare" onclick="blockcar('<?php echo $car['id'];?>', 1)">Deblocare</button></td>
					            <? }?>
					            <td><button class="uk-button uk-button-primary uk-button-small" name="editeaza" onclick="showmodal(<?php echo $car['id'];?>, '<?=str_replace("\n","<br>",$car['descriere']);?>', '<?php echo $car['pret'];?>');">Editare</button></td>				            
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>
						<div id="editare" class="uk-flex-top" uk-modal>
					    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
								<button class="uk-modal-close-default" type="button" uk-close></button>
						        <div class="uk-modal-header">
						            <h2 class="uk-modal-title">Editiaza masina</h2>
						            <div class="uk-alert-danger uk-hidden" id="uk-error-alert" uk-alert>
									    <p>Datele nu au fost introduse corect!</p>
									</div>
									<div class="uk-alert-success uk-hidden" id="uk-success-alert" uk-alert>
									    <p>Autovehicul editat cu succes!</p>
									</div>
						        </div>
						        <div class="uk-modal-body">
									<form name="editaremasini" action="" method="post">
										<input type="hidden" value="" id="modal_car_id">
										<fieldset class="uk-fieldset">
											<h6>Descriere noua(dotari noi):</h6>
									        <div class="uk-margin">
									            <textarea class="uk-textarea" rows="8" name="descriere_noua" id="descriere_noua"></textarea>
									        </div>
									        <h6>Pret/zi(Lei) nou:</h6>
									        <div class="uk-margin">
									            <input class="uk-input" type="text" pattern="[0-9]" name="pret_nou" id="pret_nou">
									        </div>
			                            </fieldset>
			                        </form>
			                    </div>
						        <div class="uk-modal-footer uk-text-center">
						            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
						            <button class="uk-button uk-button-primary" type="button" onclick="editcar();">Salveaza</button>
						        </div>
						</div>
					</div>
				</div>
				<!--Parametrii-->
				<div class="uk-tab-active" id="five">
					<div class="uk-margin-medium-top">
					    <ul class=" uk-child-width-expand" uk-tab>
					        <li class="uk-active-text-bold"><a href="#unu">Categorii</a></li>
					        <li><a href="#doi">Marci</a></li>
					        <li><a href="#trei">Modele</a></li>
					        <li><a href="#patru">Motor</a></li>
					        <li><a href="#cinci">Combustibil</a></li>
					        <li><a href="#sase">Locatii</a></li>
					    </ul>
					    <div class="uk-switcher">
					    	<div class="uk-tab">
					    		<div class="uk-width-auto@m ">
							    	<?php 
							    	$sqls=$db->prepare("SELECT * FROM `categorii_autovehicule`");
									$sqls->execute();
									?>
							        <table class="uk-table uk-table-striped">
									    <thead>
									        <tr>
									            <th>Categorii</th>
									            <th><button class="uk-button uk-button-primary uk-button-small" name="adauga_categorie" onclick="showcategorie()">Adauga</button></th>
									        </tr>
									    </thead>
									    <tbody>
									    	<?php while($categorie=$sqls->fetch()){ ?>
									        <tr>
									            <td><?php echo $categorie['nume'];?></td>
									        </tr>
									        <?php } ?>
									    </tbody>
									</table>
									<div id="adaugacategorie" class="uk-flex-top" uk-modal>
									    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
												<button class="uk-modal-close-default" type="button" uk-close></button>
										        <div class="uk-modal-header">
										            <h2 class="uk-modal-title">Adauga categorie</h2>
										        </div>
										        <div class="uk-modal-body">
													<form name="adaugacategorie" action="" method="post">
														<fieldset class="uk-fieldset">
													        <h6>Categorie noua:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="categorie_noua" id="categorie_noua">
													        </div>
							                            </fieldset>
							                        </form>
							                    </div>
										        <div class="uk-modal-footer uk-text-center">
										            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
										            <button class="uk-button uk-button-primary" type="button" onclick="addcategorie();">Adauga</button>
										        </div>
										</div>
									</div>
					    		</div>
					    	</div>
					    	<div class="uk-tab">
					    		<div class="uk-width-auto@m">
							        <?php $sqls=$db->prepare("SELECT * FROM `marci`");
									$sqls->execute(array());?>
							        <table class="uk-table uk-table-striped">
									    <thead>
									        <tr>
									            <th>Marci</th>
									            <th><button class="uk-button uk-button-primary uk-button-small" name="adauga_marca" onclick="showmarca()">Adauga</button></th>
									        </tr>
									    </thead>
									    <tbody>
									    	<?php while($marca=$sqls->fetch()){ ?>
									        <tr>
									            <td><?php echo $marca['nume_marca'];?></td>
									        </tr>
									        <?php } ?>
									    </tbody>
									</table>
									<div id="adaugamarca" class="uk-flex-top" uk-modal>
									    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
												<button class="uk-modal-close-default" type="button" uk-close></button>
										        <div class="uk-modal-header">
										            <h2 class="uk-modal-title">Adauga marca</h2>
										        </div>
										        <div class="uk-modal-body">
													<form name="adaugamarca" action="" method="post">
														<fieldset class="uk-fieldset">
													        <h6>Marca noua:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="marca_noua" id="marca_noua">
													        </div>
							                            </fieldset>
							                        </form>
							                    </div>
										        <div class="uk-modal-footer uk-text-center">
										            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
										            <button class="uk-button uk-button-primary" type="button" onclick="addmarca();">Adauga</button>
										        </div>
										</div>
									</div>
							    </div>
					    	</div>
					    	<div class="uk-tab">
					    		<div class="uk-width-auto@m">
							         <?php $sqls=$db->prepare("SELECT * FROM `modele`");
									$sqls->execute(array());?>
							        <table class="uk-table uk-table-striped">
									    <thead>
									        <tr>
									            <th>Modele</th>
									            <th><button class="uk-button uk-button-primary uk-button-small" name="adauga_model" onclick="showmodel()">Adauga</button></th>
									        </tr>
									    </thead>
									    <tbody>
									    	<?php while($model=$sqls->fetch()){ ?>
									        <tr>
									            <td><?php echo $model['nume_model'];?></td>
									        </tr>
									        <?php } ?>
									    </tbody>
									</table>
									<div id="adaugamodel" class="uk-flex-top" uk-modal>
									    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
												<button class="uk-modal-close-default" type="button" uk-close></button>
										        <div class="uk-modal-header">
										            <h2 class="uk-modal-title">Adauga model</h2>
										        </div>
										        <div class="uk-modal-body">
													<form name="adaugamodel" action="" method="post">
														<fieldset class="uk-fieldset">
													        <h6>Model nou:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="model_nou" id="model_nou">
													        </div>
													        <?php $sqls1=$db->prepare("SELECT * FROM `marci`");
																$sqls1->execute(array());?>
															<h6>Alege marca pentru modelul de mai sus:</h6>
													        <div class="uk-margin">
													        	<select class="uk-select" name="marca" id="marca_model">
													        		<?php while($marca=$sqls1->fetch()){?>
													                <option value="<?=$marca['id_marca'];?>"><?=$marca['nume_marca'];?></option>
													                <?php }?>
													            </select>
													        </div>
							                            </fieldset>
							                        </form>
							                    </div>
										        <div class="uk-modal-footer uk-text-center">
										            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
										            <button class="uk-button uk-button-primary" type="button" onclick="addmodel();">Adauga</button>
										        </div>
										</div>
									</div>
							    </div>
					    	</div>
					    	<div class="uk-tab">
					    		<div class="uk-width-auto@m">
							        <?php $sqls=$db->prepare("SELECT * FROM `motoare`");
									$sqls->execute(array());?>
							        <table class="uk-table uk-table-striped">
									    <thead>
									        <tr>
									            <th>Motoare</th>
									            <th><button class="uk-button uk-button-primary uk-button-small" name="adauga_motor" onclick="showmotor()">Adauga</button></th>
									        </tr>
									    </thead>
									    <tbody>
									    	<?php while($motor=$sqls->fetch()){ ?>
									        <tr>
									            <td><?php echo $motor['capacitate'];?> cm3</td>
									        </tr>
									        <?php } ?>
									    </tbody>
									</table>
									<div id="adaugamotor" class="uk-flex-top" uk-modal>
									    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
												<button class="uk-modal-close-default" type="button" uk-close></button>
										        <div class="uk-modal-header">
										            <h2 class="uk-modal-title">Adauga capacitate motor</h2>
										        </div>
										        <div class="uk-modal-body">
													<form name="adaugamotor" action="" method="post">
														<fieldset class="uk-fieldset">
													        <h6>Capacitate motor noua:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="number" name="capacitate_noua" id="capacitate_noua">
													        </div>
							                            </fieldset>
							                        </form>
							                    </div>
										        <div class="uk-modal-footer uk-text-center">
										            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
										            <button class="uk-button uk-button-primary" type="button" onclick="addmotor();">Adauga</button>
										        </div>
										</div>
									</div>
								</div>
					    	</div>
					    	<div class="uk-tab">
					    		<div class="uk-width-auto@m">
							        <?php $sqls=$db->prepare("SELECT * FROM `combustibili`");
									$sqls->execute(array());?>
							        <table class="uk-table uk-table-striped">
									    <thead>
									        <tr>
									            <th>Combustibili</th>
									            <th><button class="uk-button uk-button-primary uk-button-small" name="adauga_combustibil" onclick="showcombustibil()">Adauga</button></th>
									        </tr>
									    </thead>
									    <tbody>
									    	<?php while($combustibil=$sqls->fetch()){ ?>
									        <tr>
									            <td><?php echo $combustibil['nume_combustibil'];?></td>
									        </tr>
									        <?php } ?>
									    </tbody>
									</table>
									<div id="adaugacombustibil" class="uk-flex-top" uk-modal>
									    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
												<button class="uk-modal-close-default" type="button" uk-close></button>
										        <div class="uk-modal-header">
										            <h2 class="uk-modal-title">Adauga combustibil</h2>
										        </div>
										        <div class="uk-modal-body">
													<form name="adaugacombustibil" action="" method="post">
														<fieldset class="uk-fieldset">
													        <h6>Combustibil nou:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="combustibil_nou" id="combustibil_nou">
													        </div>
							                            </fieldset>
							                        </form>
							                    </div>
										        <div class="uk-modal-footer uk-text-center">
										            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
										            <button class="uk-button uk-button-primary" type="button" onclick="addcombustibil();">Adauga</button>
										        </div>
										</div>
									</div>
							    </div>
					    	</div>
					    	<div class="uk-tab">
					    		<div class="uk-width-auto@m">
							    	<?php $sqls=$db->prepare("SELECT * FROM `locatii`");
									$sqls->execute(array());?>
							        <table class="uk-table uk-table-striped">
									    <thead>
									        <tr>
									            <th>Locatii</th>
									            <th><button class="uk-button uk-button-primary uk-button-small" name="adauga_locatie" onclick="showlocatie()">Adauga</button></th>
									        </tr>
									    </thead>
									    <tbody>
									    	<?php while($locatie=$sqls->fetch()){ ?>
									        <tr>
									            <td><?php echo $locatie['adresa'];?>,<?php echo $locatie['oras'];?>,<?php echo $locatie['judet'];?></td>
									        </tr>
									        <?php } ?>
									    </tbody>
									</table>
									<div id="adaugalocatie" class="uk-flex-top" uk-modal>
									    	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
												<button class="uk-modal-close-default" type="button" uk-close></button>
										        <div class="uk-modal-header">
										            <h2 class="uk-modal-title">Adauga locatie</h2>
										        </div>
										        <div class="uk-modal-body">
													<form name="adaugalocatie" action="" method="post">
														<fieldset class="uk-fieldset">
													        <h6>Adresa:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="adresa_noua" id="adresa_noua">
													        </div>
													        <h6>Oras:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="oras_nou" id="oras_nou">
													        </div>
													        <h6>Judet:</h6>
													        <div class="uk-margin">
													            <input class="uk-input" type="text" name="judet_nou" id="judet_nou">
													        </div>
							                            </fieldset>
							                        </form>
							                    </div>
										        <div class="uk-modal-footer uk-text-center">
										            <button class="uk-button uk-button-default uk-modal-close" type="button">Renunta</button>
										            <button class="uk-button uk-button-primary" type="button" onclick="addlocatie();">Adauga</button>
										        </div>
										</div>
									</div>
							    </div>
					    	</div>
					    </div>
					</div>
				</div>
		    </div>
		</div>
		
		
</body>
<script src="../vendor/chart/dist/Chart.js"></script>
<script type="text/javascript">

//RGB COLORS https://www.rapidtables.com/web/color/RGB_Color.html
var steel_blue = 'rgb(70,130,180)';
var light_steel_blue = 'rgb(176,196,222)';
var chocolate = 'rgb(210,105,30)';
var slate_blue = 'rgb(106,90,205)';
var dark_turqoise = 'rgb(0,206,209)';
var forest_green = 'rgb(34,139,34)';
var gold = 'rgb(255,215,0)';
var tomato = 'rgb(255,99,71)';

var multicolor_brand = [forest_green, light_steel_blue, dark_turqoise, chocolate, slate_blue, gold, tomato, steel_blue];
var multicolor_category = [forest_green, light_steel_blue, dark_turqoise, chocolate, slate_blue, gold];
var multicolor_location = [gold, tomato, dark_turqoise];


$(document).ready(function(){
	$.ajax({
        url:'actions/get_statistics.php',
        type:'POST',
      	data: {"statistics": "all"},
      	success: function(data) {
      		
      		console.log(data);
      		var response = JSON.parse(data);
      		
      		var rent_per_month = response.rent_per_month;
      		var chart1_labels = [];
      		var chart1_data = [];
      		jQuery.each(rent_per_month, function(i, val) {
      			var month = val;
      			
			  	chart1_labels.push(month.label);
			  	chart1_data.push(month.count);
			});
			
			var monthly_profit = response.monthly_profit;
      		var chart2_labels = [];
      		var chart2_data = [];
      		jQuery.each(monthly_profit, function(i, val) {
      			var month = val;
      			
			  	chart2_labels.push(month.label);
			  	chart2_data.push(month.total);
			});
			
			var weekly_profit = response.weekly_profit;
      		var chart3_labels = [];
      		var chart3_data = [];
      		jQuery.each(weekly_profit, function(i, val) {
      			var week = val;
      			
			  	chart3_labels.push(week.label);
			  	chart3_data.push(week.total);
			});
			
			var top_brand = response.top_brand;
      		var chart4_labels = [];
      		var chart4_data = [];
      		jQuery.each(top_brand, function(i, val) {
      			var brand = val;
      			
			  	chart4_labels.push(brand.label);
			  	chart4_data.push(brand.count);
			});
			
			var top_location = response.top_location;
      		var chart5_labels = [];
      		var chart5_data = [];
      		jQuery.each(top_location, function(i, val) {
      			var location = val;
      			
			  	chart5_labels.push(location.label);
			  	chart5_data.push(location.count);
			});
			
			var top_category = response.top_category;
      		var chart6_labels = [];
      		var chart6_data = [];
      		jQuery.each(top_category, function(i, val) {
      			var category = val;
      			
			  	chart6_labels.push(category.label);
			  	chart6_data.push(category.count);
			});
			
			
      		generateChart("line", 'uk-line-chart', "Clasament total inchirieri lunare", chart1_labels, "Nr. inchirieri/luna", false, chart1_data, steel_blue);
			generateChart("bar", 'uk-bar-chart', "Venit lunar", chart2_labels, "Total luna", false, chart2_data, forest_green);
			generateChart("bar", 'uk-bar2-chart', "Venit saptamanal", chart3_labels, "Total zi", false, chart3_data, dark_turqoise);
			generateChart("polarArea", 'uk-polar-chart', "Contor inchirieri per marca", chart4_labels, "Total inchirieri", true, chart4_data, multicolor_brand);
      		generateChart("doughnut", 'uk-doughnut-chart', "Contor inchirieri per oras", chart5_labels, "Total inchirieri", true, chart5_data, multicolor_location);
			generateChart("doughnut", 'uk-doughnut2-chart', "Contor inchirieri per categorie", chart6_labels, "Total inchirieri", false, chart6_data, multicolor_category);
			
			/*
			*/
      	}
    });
	
	
	
});
// Type, Data e options
function generateChart(type, element_id, title, labels, label_name, fill, data, color){
	var ctx = document.getElementById(element_id).getContext('2d');
	var chart = new Chart(ctx, {
	    // type is the type of graph that will be shown, our case is bar bar or columns
	    type: type,
	    // config of the data that will be shown
	    data: {
	        // would be the timeline
	        labels: labels,
	        // information that will make up the chart
	        datasets: [{
	                //label = title or label that will be at the top of the chart
	                label: label_name,
	                // data = are the data that are fixed here, in your application it must arrive in a specific format "Ex: JSON"
	                data: data,
	                // set border thickness 
	                fill: fill,
	                // border color
	                borderColor: color,
	                backgroundColor: color,
	                // bar color
	                tension: 0.1
	            }
	            
	        ]
	    },
	    // options = would be the header, but it has several customizations
	    options: {
	        // here the title display is true so it will appear
	        title: {
	            display: true,
	            // font size
	            fontSize: 30,
	            // text of our title
	            text: title
	        }
	    }
	});
}

function addcar(){
	$("form[name='formular']").trigger('submit');
}
function showmodal(id, desc, pr){
	$("#modal_car_id").val(id);
	$("#descriere_noua").val(desc);
	$("#pret_nou").val(pr);
	UIkit.modal($("#editare")).show();
}
function editcar(){
	
	var descriere_noua = $("#descriere_noua").val();
	console.log(descriere_noua);
	var pret_nou = $("#pret_nou").val();
	console.log(pret_nou);
	let id_car = $("#modal_car_id").val();
	console.log(id_car);
	$("#uk-error-alert").addClass("uk-hidden");
	$("#uk-success-alert").addClass("uk-hidden");
	
	$.ajax({
        url: 'actions/editcar.php',
        type:'POST',
      	data: {"descriere_noua": descriere_noua, "pret_nou": pret_nou, "id_car": id_car},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "car edited successfully"){
        		window.location.reload();
        	} else if(data == "data_missing"){
        		$("#uk-error-alert").toggleClass("uk-hidden");
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}

function blockcar(car_id, status){
	$("#car_id").val(car_id);
	console.log(car_id);
	$("#status").val(status);
	console.log(status);
	
	$.ajax({
        url: 'actions/blockcar.php',
        type:'POST',
      	data: {"car_id": car_id, "status": status},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "car blocked successfully"){
        		window.location.reload();
        	} else {
        		console.log(data);
        	}
      	}
    });
}

function blockuser(id_user, status){
	$("#id_user").val(id_user);
	console.log(id_user);
	$("#status").val(status);
	console.log(status);
	
	$.ajax({
        url: 'actions/blockuser.php',
        type:'POST',
      	data: {"id_user": id_user, "status": status},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "user blocked successfully"){
        		window.location.reload();
        	} else {
        		console.log(data);
        	}
      	}
    });
}
//pentru uploadare imagine la descriere
$("form[name='formular']").submit(function(e) {
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: "actions/addcar.php",
        type: "POST",
        data: formData,
        async: false,
        success: function(data) {
      		//gestionare raspuns de la server
        	if(data == "success: data_saved"){
        		window.location.reload();
        		$("#uk-success-alert").toggleClass("uk-hidden");
        	} else if(data == "data_missing"){
        		$("#uk-error-alert").toggleClass("uk-hidden");
        	} else {
        		console.log(data);
        	}
      	},
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
});
function showcategorie(){
	UIkit.modal($("#adaugacategorie")).show();
}
function addcategorie(){
	
	var categorie_noua = $("#categorie_noua").val();
	console.log(categorie_noua);
	
	$.ajax({
        url: 'actions/addcategorie.php',
        type:'POST',
      	data: {"categorie_noua": categorie_noua},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "category added successfully"){
        		window.location.reload();
        	}else if(data == "categorie existenta"){
        		UIkit.notification({message: 'Categorie existenta!', status: 'danger'})
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Nu ai introdus nici o categorie', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}
function showmarca(){
	UIkit.modal($("#adaugamarca")).show();
}
function addmarca(){
	
	var marca_noua = $("#marca_noua").val();
	console.log(marca_noua);
	
	$.ajax({
        url: 'actions/addmarca.php',
        type:'POST',
      	data: {"marca_noua": marca_noua},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "marca added successfully"){
        		window.location.reload();
        	}else if(data == "marca existenta"){
        		UIkit.notification({message: 'Marca existenta!', status: 'danger'})
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Nu ai introdus nici o marca', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}
function showmodel(){
	UIkit.modal($("#adaugamodel")).show();
}
function addmodel(){
	
	var model_nou = $("#model_nou").val();
	console.log(model_nou);
	var marca_model = $("#marca_model").val();
	console.log(marca_model);
	$.ajax({
        url: 'actions/addmodel.php',
        type:'POST',
      	data: {"model_nou": model_nou, "marca_model": marca_model},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "model added successfully"){
        		window.location.reload();
        	}else if(data == "model existent"){
        		UIkit.notification({message: 'Model existent!', status: 'danger'})
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Nu ai introdus nici un model', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}
function showmotor(){
	UIkit.modal($("#adaugamotor")).show();
}
function addmotor(){
	
	var capacitate_noua = $("#capacitate_noua").val();
	console.log(capacitate_noua);
	
	$.ajax({
        url: 'actions/addmotor.php',
        type:'POST',
      	data: {"capacitate_noua": capacitate_noua},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "motor added successfully"){
        		window.location.reload();
        	}else if(data == "motor existent"){
        		UIkit.notification({message: 'Capacitate motor existenta!', status: 'danger'})
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Nu ai introdus nici o capacitate noua', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}
function showcombustibil(){
	UIkit.modal($("#adaugacombustibil")).show();
}
function addcombustibil(){
	
	var combustibil_nou = $("#combustibil_nou").val();
	console.log(combustibil_nou);
	
	$.ajax({
        url: 'actions/addcombustibil.php',
        type:'POST',
      	data: {"combustibil_nou": combustibil_nou},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "combustibil added successfully"){
        		window.location.reload();
        	}else if(data == "combustibil existent"){
        		UIkit.notification({message: 'Combustibil existent!', status: 'danger'})
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Nu ai introdus nici o combustibil nou', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}
function showlocatie(){
	UIkit.modal($("#adaugalocatie")).show();
}
function addlocatie(){
	
	var adresa_noua = $("#adresa_noua").val();
	console.log(adresa_noua);
	var oras_nou = $("#oras_nou").val();
	console.log(oras_nou);
	var judet_nou = $("#judet_nou").val();
	console.log(judet_nou);
	
	$.ajax({
        url: 'actions/addlocatie.php',
        type:'POST',
      	data: {"adresa_noua": adresa_noua, "oras_nou": oras_nou, "judet_nou": judet_nou},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "locatie added successfully"){
        		window.location.reload();
        	} else if(data == "data_missing"){
        		UIkit.notification({message: 'Nu ai introdus nici o locatie noua', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
	
}

function get_models(elem){
	var id_marca = $(elem).val();
	$("#model").empty();
	//$("#model").append(new Option("Nume MODEL", "ID"));
	$.ajax({
        url: 'actions/getmodels.php',
        type:'POST',
      	data: {"id_marca": id_marca},
      	success: function(data) {
      		
        	var response = JSON.parse(data);
        	var count=0;
        	
			jQuery.each(response, function(i, val) {
			  $("#model").append(new Option(val, i));
			  count++;
			});
			if(count == 0 || count == null){
				UIkit.notification({message: 'Nu a fost adaugat nicu un model pentru aceasta marca', status: 'danger'})
			}
			
        	console.log(response);
      	}
    });
	
}
</script>

<?php }else{
        header("Location: ../");
    } ?>    