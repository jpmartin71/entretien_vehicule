<?php
echo "controler formulaire opération</br>";

include_once './model/formulaire_operation.php';
include_once './model/fonctions_divers.php';

//$operation pour le remplissage des champs
$operation=array('id_vehicule'=>null, 'denomination'=>null, 'periodicite_km'=>null, 'periodicite_tps'=>null, 'effectuee_km'=>null, 'effectuee_date'=>null, 'echeance_km'=>null, 'echeance_date'=>null, 'obs'=>null);

//verification des information du post avant de creer la ligne sql ou renvoie au formulaire pour correction
if(isset($_GET['action']) and $_GET['action']=='create_operation')
{
	include_once './controler/create_update_operation.php';
}
	
$liste_vehicules=get_liste_vehicule();
if(!empty($liste_vehicules))
{
	foreach ($liste_vehicules as $key => $vehicule) 
	{
		$liste_vehicules[$key]['libelle']=$vehicule['marque'].' - '.$vehicule['modele'];
	}
}

echo '</br>$liste_vehicules:';print_r($liste_vehicules);
include_once './view/formulaire_operation.php';
