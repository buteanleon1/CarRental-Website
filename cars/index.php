<?php
session_start();
include "../db_conn.php";

if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role'])){

$page_title = "Mașini";

include('../components/page_head.php');

?>

<body>
	<?php include '../components/top_nav.php'; ?>
    <div class="uk-container uk-margin">
          <!-- CONTENT GOES HERE -->
          <div class="masini">
            <div class="row">
                <div class="col-lg-3">
                    <h5>Filtreaza masinile</h5>
                    <hr>
                    <h6 class="text-info">Selecteaza marca</h6>
                    <ul class="list-group">
                        <?php
                        	$sqls=$db->prepare("SELECT * FROM marci ORDER BY nume_marca ASC");
							$sqls->execute();
							while($row=$sqls->fetch()){
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product-check" 
                                           value="<?=$row['id_marca'];?>" id="marca"><?=$row['nume_marca'];?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <h6 class="text-info">Selecteaza categorie</h6>
                    <ul class="list-group">
                        <?php
                            $sqls=$db->prepare("SELECT * FROM categorii_autovehicule");
							$sqls->execute();
							while($row=$sqls->fetch()){
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product-check" 
                                           value="<?=$row['id_categorie'];?>" id="categorie"><?=$row['nume'];?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <h6 class="text-info">Selecteaza motor</h6>
                    <ul class="list-group">
                        <?php
                            $sqls=$db->prepare("SELECT * FROM motoare ORDER BY capacitate ASC");
							$sqls->execute();
							while($row=$sqls->fetch()){
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product-check" 
                                           value="<?=$row['id_motor'];?>" id="motor"><?=$row['capacitate'];?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <h6 class="text-info">Selecteaza combustibil</h6>
                    <ul class="list-group">
                        <?php
                            $sqls=$db->prepare("SELECT * FROM combustibili");
							$sqls->execute();
							while($row=$sqls->fetch()){
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product-check" 
                                           value="<?=$row['id_combustibil'];?>" id="combustibil"><?=$row['nume_combustibil'];?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <h6 class="text-info">Selecteaza tractiune</h6>
                    <ul class="list-group">
                        <?php
                            $sqls=$db->prepare("SELECT * FROM transmisii");
							$sqls->execute();
							while($row=$sqls->fetch()){
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product-check" 
                                           value="<?=$row['id_transmisie'];?>" id="tractiune"><?=$row['nume_transmisie'];?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <h6 class="text-info">Selecteaza Oras,Judet</h6>
                    <ul class="list-group">
                        <?php
                            $sqls=$db->prepare("SELECT * FROM locatii");
							$sqls->execute();
							while($row=$sqls->fetch()){
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product-check" 
                                           value="<?=$row['id_locatie'];?>" id="locatie"><?=$row['oras'];?>,<?=$row['judet'];?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                
                <div class="col-lg-9">
                    <h5 class="uk-text-center" id="textChange">Toate autovehiculele</h5>
                    <hr>
                    <div class="uk-child-width-1-3@m uk-child-width-1-3@l uk-grid-match" id="result" uk-grid>
                        <?php
                        $sqls=$db->prepare("SELECT autovehicule.*,categorii_autovehicule.nume,locatii.*,marci.*,modele.*,combustibili.*,motoare.* FROM `autovehicule` 
											LEFT JOIN categorii_autovehicule ON categorii_autovehicule.id_categorie=autovehicule.id_categorie 
											LEFT JOIN locatii ON locatii.id_locatie=autovehicule.id_locatie
											LEFT JOIN marci ON marci.id_marca=autovehicule.id_marca
											LEFT JOIN modele ON modele.id_model=autovehicule.id_model
											LEFT JOIN combustibili ON combustibili.id_combustibil=autovehicule.id_combustibil
											LEFT JOIN motoare ON motoare.id_motor=autovehicule.id_motor
											WHERE autovehicule.status=1");
						$sqls->execute();
						while($row=$sqls->fetch()){
                        ?>
                        
                        <div>
						    <div class="uk-card uk-card-default uk-padding-small uk-box-shadow-large">
						        <div class="uk-card-media-top">
						            <?if($row['imagine'] != "" && file_exists('../resources/'.$row['imagine'])){?>
								            <img class="uk-pointer img-list-preview uk-align-center uk-height-small" src="../resources/<?=$row['imagine'];?>" alt="">
								    <? } else { ?>
								            <?="test";?>
								    <? } ?>
						        </div>
						        <div class="uk-card-body uk-padding-small uk-text-small">
						            <span>Cod masina: <?=$row['id'];?></span>
						            <h6 class="uk-margin-small-top">Marca: <?=$row['nume_marca'];?></h6>
						            <h6 class="uk-margin-small-top">Model: <?=$row['nume_model'];?></h6>
						            <h6 class="uk-margin-small-top">Categorie: <?=$row['nume'];?></h6>
						            <h6 class="uk-margin-small-top">Cc: <?=$row['capacitate'];?> cm3</h6>
						            <h6 class="uk-margin-small-top">Combustibil: <?=$row['nume_combustibil'];?></h6>
						            <h6 class="uk-margin-small-top">Localizare:</h6>
						            <p class="uk-margin-small-top"><?=$row['adresa'];?>, <?=$row['oras'];?>, <?=$row['judet'];?></p>
						            <div class="uk-width-1-1 uk-text-right uk-text-large">
						            	<p class="uk-text-primary uk-text-bold"><?=$row['pret'];?> RON/ZI</p>
						            	<p class="uk-text-bold"></p>
						            </div>
						            <br>
						            <div class="uk-width-1-1 uk-position-bottom ">
						            	<a href="../car/?id=<?=$row['id'];?>" class="uk-button uk-button-primary uk-button-small uk-width-1-1"><span uk-icon="icon: cart; ratio: 1"></span> Vezi detalii</a>
						            </div>
						        </div>
						    </div>
						</div>
                        <?php } ?>
               		</div>
                        
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
            $(document).ready(function(){
                
                $(".product-check").click(function(){
                    var action = 'data';
                    var marca = get_filter_text('marca');
                    var categorie = get_filter_text('categorie');
                    var motor = get_filter_text('motor');
                    var combustibil = get_filter_text('combustibil');
                    var tractiune = get_filter_text('tractiune');
                    var locatie = get_filter_text('locatie');
                    
                    $.ajax({
                       url: 'actions/action.php',
                       method: 'POST',
                       data:{action:action,marca:marca,categorie:categorie,motor:motor,combustibil:combustibil,tractiune:tractiune,locatie:locatie},
                       success:function(response){
                       	console.log(response);
                          $("#result").html(response);
                          $("#textChange").text("Filtre aplicate");
                       }
                    });
                    
                });
               
               function get_filter_text(text_id){
                   var filterData = [];
                   $('#' +text_id+ ':checked').each(function(){
                       filterData.push($(this).val());
                   });
                   return filterData;
               }
               
            });
</script>
</html>

<?php }else{
        header("Location: ../");
    } ?> 