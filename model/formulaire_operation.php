<?php

//recupere la liste des vehicule
	function get_liste_vehicule()
	{
		global $bdd;
		$req=$bdd->query('SELECT id, marque, modele FROM vehicules ORDER BY marque');
		$liste_vehicule=$req->fetchall();
		$req->closecursor();


		return $liste_vehicule;
	}