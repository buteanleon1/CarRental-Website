<?php
session_start();
include "../db_conn.php";

if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['role'])){
$page_title = "Home";

include('../components/page_head.php');

?>

<body>
    <?php include '../components/top_nav.php'; ?>
    <div class="uk-inline ">
    	<img src="../resources/imagini/fundal1.jpg" alt="">
    	<div class="uk-position-small uk-position-cover uk-overlay  uk-flex uk-flex-center uk-flex-middle">
    		<div class="row uk-position-large uk-position-top-left uk-margin-xlarge-left uk-margin-xlarge-top">
    			<div class="uk-margin-xlarge-top">
    			<h1 style="color:rgb(255,255,255); font-size:60px;">CarRental</h1>
    			<p style="color:rgb(255,255,255); font-size:20px;"><b>CarRental are la nivel national 3 birouri de inchirieri auto, <br>cu o buna raspandire si acoperire in partea de jumatatea vestica a tarii.<br/>
    				Noi iti punem la dispozitie o multitudine de masini din care poti sa alegi varianta optima pentru tine.
    			</b></p>
    			<a href="../cars"><button  type="button" style="width: 180px; height: 40px; color: #000; font-size: 18px; font-weight: bold; background: #fff; border: 0; border-radius: 30px; outline: none; margin-top: 10px; margin-left: 110px;">Inspecteaza garaj</button></a>
    			</div>
    		</div>
    	</div>
    </div>
    
</body>

<script type="text/javascript">
</script>
</html>
<?php }else{
        header("Location: ../");
    } ?> 