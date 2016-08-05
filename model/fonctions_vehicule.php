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