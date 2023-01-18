<div class="uk-container uk-container-expand uk-padding-remove">
    <nav class="uk-background-secondary uk-light" uk-navbar uk-sticky="top: 100">
          <div class="uk-navbar-left uk-overflow-hidden">
                <ul class="uk-navbar-nav uk-margin-large-left">
		            <li><a class="uk-text-capitalize navbar-text-larger" href="../main">Acasa</a></li>
		            <li><a class="uk-text-capitalize navbar-text-larger" href="../cars">Autovehicule</a></li>
		            <li><a class="uk-text-capitalize navbar-text-larger" href="../aboutus.php">Despre noi</a></li>
		        </ul>             
          </div>
          <div class="uk-navbar-right uk-overflow-hidden">
                <ul class="uk-navbar-nav uk-margin-left">
		             <li>
		                <a href="#"><span class="uk-icon uk-margin-medium-right" uk-icon="icon: menu; ratio: 2"></span></a>
		                <div class="uk-navbar-dropdown">
		                    <ul class="uk-nav uk-navbar-dropdown-nav">
		                    	<?php if($_SESSION['role']=='user'){?>
		                        	<li class="uk-active"><a class="uk-text-capitalize navbar-text-larger" href="../user">Cont</a></li>
		                        <?php }else {?>
		                        	<li class="uk-active"><a class="uk-text-capitalize navbar-text-larger" href="../admin">Administrare</a></li>
		                        <?php }?>
		                        <li class="uk-navbar"><a class="uk-text-capitalize navbar-text-larger" href="../logout.php">Deconectare</a></li>
		                    </ul>
		                </div>
		            </li>
		        </ul>             
          </div>
    </nav>
</div>