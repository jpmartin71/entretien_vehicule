
<section>
<?php
	if(isset($_GET['no_erreur']))
	{
		if($_GET['no_erreur']=='create_vehicule')echo '<p class="no_erreur">Véhicule crée.</p>';
		else if($_GET['no_erreur']=='releve_kilometrique')echo '<p class="no_erreur">Relevé kilométrique enregistré.</p>';
	}

	if(isset($_GET['erreur']))
	{
		if($_GET['erreur']=='modele')echo '<p class="erreur">Modele requis</p>';
		
		elseif ($_GET['erreur']=='releve_kilometrique') echo '<p class="erreur">Date ET kilométrage requis</p>';
	}
	if(isset($erreur_view['view']) and !empty($erreur_view['view']))echo '<p class="erreur">'.$erreur_view['view'].'</p>';
	elseif(isset($no_erreur_view['view']) and !empty($no_erreur_view['view']))echo '<p class="no_erreur">'.$no_erreur_view['view'].'</p>';
?>
</section>
