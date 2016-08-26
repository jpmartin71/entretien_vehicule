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

//ajout d'une nouvelle opération
function create_operation($operation)
{
	global $bdd;
	$req=$bdd->prepare('INSERT INTO operations (id_vehicule,denomination,periodicite_km,periodicite_tps,effectuee_km,effectuee_date,echeance_km,echeance_date,observations)
				VALUE (:id_vehicule,:denomination,:periodicite_km,:periodicite_tps,:effectuee_km,:effectuee_date,:echeance_km,:echeance_date,:observations)');
	$req->execute(array(	':id_vehicule'=>$operation['id_vehicule'],
				':denomination'=>$operation['denomination'],
				':periodicite_km'=>$operation['periodicite_km'],
				':periodicite_tps'=>$operation['periodicite_tps'],
				':effectuee_km'=>$operation['effectuee_km'],
				':effectuee_date'=>$operation['effectuee_date'],
				':echeance_km'=>$operation['echeance_km'],
				':echeance_date'=>$operation['echeance_date'],
				':observations'=>$operation['obs']));
	
}

//mise a jour operation
function update_operation($operation)
{
	global $bdd;
	$req=$bdd->prepare('	UPDATE 	operations 
				SET 	id_vehicule=:id_vehicule,
					denomination=:denomination,
					periodicite_km=:periodicite_km,
					periodicite_tps=:periodicite_tps,
					effectuee_km=:effectuee_km,
					effectuee_date=:effectuee_date,
					echeance_km=:echeance_km,
					echeance_date=:echeance_date,
					observations=:observations
				WHERE id=:id');
	$req->execute(array(	':id'=>$operation['id'],
				':id_vehicule'=>$operation['id_vehicule'],
				':denomination'=>$operation['denomination'],
				':periodicite_km'=>$operation['periodicite_km'],
				':periodicite_tps'=>$operation['periodicite_tps'],
				':effectuee_km'=>$operation['effectuee_km'],
				':effectuee_date'=>$operation['effectuee_date'],
				':echeance_km'=>$operation['echeance_km'],
				':echeance_date'=>$operation['echeance_date'],
				':observations'=>$operation['obs']));
}

//recupere une operation
function get_operation($id_operation)
{
	global $bdd;
	$req=$bdd->prepare('SELECT * FROM operations WHERE id=:id');
	$req->execute(array('id' => $id_operation));
	$infos=$req->fetch();
	$req->closecursor();
	return $infos;
}
