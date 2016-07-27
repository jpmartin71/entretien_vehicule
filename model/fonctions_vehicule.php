<?php
	function set_new_vehicule($infos)
	{
		echo '$_POST:'; print_r($infos); echo '</br>';
		global $bdd;
		$req=$bdd->prepare ('INSERT INTO vehicules (	marque, 	modele, 	date_1_immat, 	date_achat, 	vin, 	immatriculation, 	possession)
							VALUES (					:marque, 	:modele, 	:date_1_immat, 	:date_achat, 	:vin, 	:immatriculation, 	:possession)');
		
		$req->execute(array(
			'marque'		=>$infos['marque'],
			'modele'		=>$infos['modele'],
			'date_1_immat'	=>$infos['date_1_immat'],
			'date_achat'	=>$infos['date_achat'],
			'vin'			=>$infos['vin'],
			'immatriculation'=>$infos['immat'],
			'possession'	=>$infos['possession']));
	}