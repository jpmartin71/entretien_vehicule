<?php
	function set_new_vehicule($infos)
	{
		echo '$_POST:'; print_r($infos); echo '</br>';
		global $bdd;
		$req_doublon=$bdd->prepare ('SELECT * FROM vehicules WHERE modele=:modele AND date_1_immat=:date_1_immat');
		$req_doublon->execute(array(
			'modele'		=>$infos['modele'],
			'date_1_immat'	=>$infos['date_1_immat']));
		
		if(empty($req_doublon->fetchall()))
		{
			$req_insert=$bdd->prepare ('INSERT INTO vehicules (	marque, 	modele, 	date_1_immat, 	date_achat, km_achat,	vin, 	immatriculation, 	possession)
							VALUES (					:marque, 	:modele, 	:date_1_immat, 	:date_achat, :km_achat,	:vin, 	:immatriculation, 	:possession)');
		
			$req_insert->execute(array(
			'marque'		=>$infos['marque'],
			'modele'		=>$infos['modele'],
			'date_1_immat'	=>$infos['date_1_immat'],
			'date_achat'	=>$infos['date_achat'],
			'km_achat'		=>$infos['km_achat'],
			'vin'			=>$infos['vin'],
			'immatriculation'=>$infos['immatriculation'],
			'possession'	=>$infos['possession']));

			$return=1;
		}
		else
		{
			$return=0;
		}
		
		return $return;

	}	
	function get_infos_vehicule($id_vehicule)
	{
		global $bdd;
		$req=$bdd->prepare('SELECT * FROM vehicules WHERE id=:id');
		$req->execute(array('id' => $id_vehicule));
		$infos=$req->fetch();
		$req->closecursor();
		return $infos;
	}
	function get_last_releve($id_vehicule)
	{
		global $bdd;
		$req=$bdd->prepare('SELECT * FROM releves_kilometriques WHERE id_vehicule=:id_vehicule ORDER BY date_releve DESC');
		$req->execute(array('id_vehicule' => $id_vehicule));
		$releve=$req->fetch();
		$req->closecursor();
		return $releve;
	}
	function set_releve($id_vehicule, $date_releve, $km_releve)
	{
		global $bdd;
		$req=$bdd->prepare('INSERT INTO releves_kilometriques (id_vehicule, date_releve, km_releve) 
							VALUE (:id_vehicule, :date_releve, :km_releve)');		
		$req->execute(array(
			'id_vehicule' => $id_vehicule,
			'date_releve' => $date_releve,
			'km_releve'   => $km_releve));
	}
	function get_doublon($id_vehicule, $date_releve, $km_releve)
	{
		global $bdd;
		$req=$bdd->prepare('SELECT id FROM releves_kilometriques WHERE id_vehicule=:id_vehicule AND date_releve=:date_releve AND km_releve=:km_releve');
		$req->execute(array(
			'id_vehicule' => $id_vehicule,
			'date_releve' => $date_releve,
			'km_releve'   => $km_releve));
		$releve=$req->fetchall();
		$req->closecursor();
		if(!empty($releve))return false;
		else return true;
	}
	function get_operations($id_vehicule)
	{
		global $bdd;
		$req=$bdd->prepare('SELECT * FROM operations WHERE id_vehicule=:id_vehicule');
		$req->execute(array('id_vehicule' => $id_vehicule));
		$operations=$req->fetch();
		$req->closecursor();
		return $operations;
	}
	
