<?php
echo "controler formulaire opération";

include_once './model/formulaire_operation.php';

$liste_vehicules=get_liste_vehicule();
if(!empty($liste_vehicules))
{
	foreach ($liste_vehicules as $key => $vehicule) 
	{
		$liste_vehicules[$key]['libelle']=$vehicule['marque'].' - '.$vehicule['modele'];
	}
}

echo "</br>Liste vehicules:";print_r($liste_vehicules);

include_once './view/formulaire_operation.php';