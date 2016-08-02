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
	
//recuper lis information d'un vehicule	
function get_infos_vehicule($id_vehicule)
{
	global $bdd;
	$req=$bdd->prepare('SELECT * FROM vehicules WHERE id=:id');
	$req->execute(array('id' => $id_vehicule));
	$infos=$req->fetch();
	$req->closecursor();
return $infos;
}
