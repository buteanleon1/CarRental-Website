<?php
session_start();
include "../db_conn.php";

if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role'])){
$page_title = "About us";

include('components/page_head.php');

?>
<body>
    <?php include 'components/top_nav.php'; ?>
    <div class="uk-position-top-center uk-margin-xlarge-top">
    	<div class="uk-margin-large-top">
    		<h1 class="uk-margin-xlarge-right">CarRental</h1>
    		<p class="uk-margin-medium-top">	Compania noastra are 3 sedii situate in jumatatea vestica a tarii, aceste sedii sunt situate in judetele Maramures, Cluj si Timis.<br>
    			Detinem autovehicule din aproape toate categoriile, fiecare categorie cu o multitudine de variante la preturi convenabile in functie <br>
    			preferintele clientului.<br>
    			Cerinte pentru inchirieria unui autovehicul:<br>
    			- Minim 3 ani de experienta de la emiterea permisului de conducere<br>
    			- Buletin si permis de conducere valabil<br>
    			- Varsta maxima pentru a putea inchiria este de 65 de ani<br>
    			<br>Plate inchirieri se va face la sediu, jumatate din suma se va plati la preluarea masinii, iar restul la predarea acesteia. <br>
    			In cazul in care clientul nu plateste suma totala de bani sau provoaca anumite daune masinii fara a plati pentru reparatie <br>
    			acestuia i se va bloca contul si nu va mai putea inchiria de la firma noasta.<br>
    			<br><br>
    			Masinile inchiriate se vor preda din locul de unde s-au preluat.<br>
    			Preluarea unei masini de la un anumit sediu si predarea acesteia la un alt sediu si invers va fi disponibila in urmatorul an.<br>
    			<br>
    			Date de contact:<br>
    			- Telefon: 0753319289<br>
    			- email: buteanleon@gmail.com<br>
    			- Adresa sediu1: bd. Bucuresti nr.22,Baia Mare,Maramures orar 06:00 - 18:00<br>
    			- Adresa sediu1: bd. Muncii nr.125,Cluj-Napoca,Cluj orar 06:00 - 18:00<br>
    			- Adresa sediu1: bd. Traian nr.130,Timisoara,Timis orar 06:00 - 18:00<br>
    		</p>
    	</div>
    </div>
    
</body>
<?php }else{
        header("Location: ../");
    } ?> 