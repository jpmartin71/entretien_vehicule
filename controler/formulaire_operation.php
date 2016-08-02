<?php
echo "controler formulaire opération</br>";

include_once './model/formulaire_operation.php';

//$operation pour le remplissage des champs
$operation=array('id_vehicule'=>null, 'denomination'=>null, 'periodicite_km'=>null, 'periodicite_tps'=>null, 'effectuee_km'=>null, 'effectuee_tps'=>null, 'echeance_km'=>null, 'echeance_date'=>null, 'obs'=>null);
echo '$operation:';print_r($operation);echo '</br>';


//verification des information du post avant de creer la ligne sql ou renvoie au formulaire pour correction
if(isset($_GET['action']) and $_GET['action']=='create_operation')
{
	$erreur=0;
	$vehicule=get_infos_vehicule($_POST['id_vehicule']);
	//echo '$vehicule:';print_r($vehicule);echo '</br>';
	
	if(isset($_POST['id_vehicule']) and !empty($vehicule))
	{//si id_vehicule est present et que le vehicule existe
		$operation['id_vehicule']=$vehicule['id'];
	}
	else 
	{
		$operation['id_vehicule']=0;
		$erreur+=1;
	}
	
	if(isset($_POST['denomination']) and !empty($_POST['denomination']))
	{//si denomination est present et que denomination n'est pas vide
		$operation['denomination']=$_POST['denomination'];
	}
	else
	{
		$operation['denomination']="";
		$erreur+=2;
	}
	
	if(isset($_POST['periodicite_km']) and !empty($_POST['periodicite_km']) and is_numeric($_POST['periodicite_km']))
	{//si periodicite_km est present et que periodicite_km n'est pas vide et est un nombre
		$operation['periodicite_km']=$_POST['periodicite_km'];
	}
	elseif(isset($_POST['inib_periodicite_km']))
	{//si l'operation n'est pas soumise à une périodicité en km
		$operation['periodicite_km']=0;
	}
	else
	{
		$operation['periodicite_km']=0;
		$erreur+=4;
	}
	
	if(isset($_POST['periodicite_tps'])and !empty($_POST['periodicite_tps']) and is_numeric($_POST['periodicite_tps']))
	{//si periodicite_tps est present et que periodicite_tps n'est pas vide et est un nombre
		$operation['periodicite_tps']=$_POST['periodicite_tps'];
	}
	elseif(isset($_POST['inib_periodicite_tps']))
	{//si l'operation n'est pas soumise à une périodicité en km
		$operation['periodicite_tps']=0;
	}
	else
	{
		$operation['periodicite_tps']=0;
		$erreur+=6;
	}
	
	if(isset($_POST['effectuee_km'])and !empty($_POST['effectuee_km']) and is_numeric($_POST['effectuee_km']))
	{//si effectuee_km est present et que effectuee_km n'est pas vide et est un nombre
		$operation['effectuee_km']=$_POST['effectuee_km'];
	}
	else
	{
		$operation['effectuee_km']=0;
		$erreur+=8;
	}
	
	
	
	
	
	//echo '$operation:';print_r($operation);echo '</br>';
	echo '$erreur:';print_r($erreur);echo '</br>';
	
	
}
	
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
