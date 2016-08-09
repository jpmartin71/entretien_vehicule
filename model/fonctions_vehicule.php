<?php
	function update_vehicule($infos)
	{
		global $bdd;
		$req_update=$bdd->prepare('	UPDATE vehicules 
						SET 	marque=:marque, 
							modele=:modele, 	
							date_1_immat=:date_1_immat,
							date_achat=:date_achat, 
							km_achat=:km_achat,	
							vin=:vin, 	
							immatriculation=:immatriculation, 	
							possession=:possession
						WHERE id=:id');
		$return=$req_update->execute(array(
			'id'		=>$infos['id']	,
			'marque'	=>$infos['marque'],
			'modele'	=>$infos['modele'],
			'date_1_immat'	=>$infos['date_1_immat'],
			'date_achat'	=>$infos['date_achat'],
			'km_achat'	=>$infos['km_achat'],
			'vin'		=>$infos['vin'],
			'immatriculation'=>$infos['immatriculation'],
			'possession'	=>$infos['possession']));
		return $return;
	}
	
	function set_new_vehicule($infos)
	{
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
		$req=$bdd->prepare('SELECT *
					FROM operations WHERE id_vehicule=:id_vehicule
					ORDER BY echeance_date');
		$req->execute(array(	'id_vehicule' 		=> $id_vehicule));
		$operations=$req->fetchall();
		$req->closecursor();
		return $operations;
	}

	function get_operations_echues($id_vehicule,$date_limite,$km_limite,$moy_journaliere)
	{
		global $bdd;
		$req=$bdd->prepare('	SELECT *, 
									ROUND(GREATEST((DATEDIFF(:date_limite,echeance_date)*:moy_journaliere) ,( :km_limite-echeance_km))) as delta_km_estim,
									(:date_limite>`echeance_date`) as its_date, 
									(:km_limite>`echeance_km`) as its_km
								FROM operations 
								WHERE id_vehicule=:id_vehicule AND (echeance_km<=:km_limite OR echeance_date<=:date_limite)
								ORDER BY delta_km_estim DESC');
		$req->execute(array(
				'id_vehicule'		=>$id_vehicule,
				'moy_journaliere'	=>$moy_journaliere,
				'km_limite'		=>$km_limite,
				'date_limite'		=>$date_limite));
		$return=$req->fetchall();
		$req->closecursor();
		return $return;
	}
	
	function get_operations_previsionnelles($id_vehicule,$date_limite,$km_limite,$km_estime,$moy_journaliere)
	{
		global $bdd;
		$req=$bdd->prepare('	SELECT *, 
									ROUND(GREATEST((DATEDIFF(:date_limite,echeance_date)*:moy_journaliere) ,( :km_limite-echeance_km))) as delta_km_estim,
									(:date_limite>`echeance_date`) as its_date, 
									(:km_limite>`echeance_km`) as its_km
								FROM operations 
								WHERE id_vehicule=:id_vehicule AND ((echeance_km BETWEEN :km_estime AND :km_limite ) OR (echeance_date BETWEEN NOW() AND :date_limite))
								ORDER BY delta_km_estim DESC');
		$req->execute(array(
				'id_vehicule'		=>$id_vehicule,
				'moy_journaliere'	=>$moy_journaliere,
				'km_limite'		=>$km_limite,
				'km_estime'		=>$km_estime,
				'date_limite'		=>$date_limite));
		$return=$req->fetchall();
		$req->closecursor();
		return $return;
	}
