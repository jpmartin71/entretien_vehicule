<?php

	//recupere la liste des vehicule
	function get_liste_vehicule()
	{
		global $bdd;
		$req=$bdd->query('SELECT * FROM vehicules');
		$liste_vehicule=$req->fetchall();
		$req->closecursor();


		return $liste_vehicule;
	}