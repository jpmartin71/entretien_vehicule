<?php
	include_once './model/acceuil.php';

	$liste_vehicule=get_liste_vehicule();

	if(empty($liste_vehicule))
	{
		include_once './controler/formulaire_vehicule.php';
	}
	else
	{
		




		include_once './view/acceuil.php';

	}
