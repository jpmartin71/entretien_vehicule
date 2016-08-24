<?php

include_once './model/formulaire_operation.php';
include_once './model/fonctions_divers.php';

//$operation pour le remplissage des champs
$operation=array('id'=>null,'id_vehicule'=>null, 'denomination'=>null, 'periodicite_km'=>null, 'periodicite_tps'=>null, 'effectuee_km'=>null, 'effectuee_date'=>null, 'echeance_km'=>null, 'echeance_date'=>null, 'obs'=>null);
//$enable_input pour l'activation des champs
$enable_input=array('id_vehicule'=>'disabled', 
			'denomination'=>'disabled', 
			'periodicite_km'=>'disabled', 'inib_periodicite_km'=>'disabled',
			'periodicite_tps'=>'disabled', 'inib_periodicite_tps'=>'disabled',
			'inib_effectuee'=>'disabled',
			'effectuee_km'=>'disabled', 'effectuee_date'=>'disabled',
			'echeance_km'=>'disabled','echeance_date'=>'disabled',
			'obs'=>'disabled');

//verification des information du post avant de creer la ligne sql ou renvoie au formulaire pour correction
if(isset($_GET['action']) and $_GET['action']=='create_operation')
{
	include_once './controler/create_update_operation.php';
}

if (isset($_GET['form']) and $_GET['form']=='valid_operation')
{
	if(isset($_POST['id_vehicule']) and isset($_POST['id_operation']))
	{
		$vehicule=get_infos_vehicule($_POST['id_vehicule']);
		$vehicule['libelle']=$vehicule['marque'].' - '.$vehicule['modele'];
		$operation=get_operation($_POST['id_vehicule']);
		$enable_input['effectuee_km']='';
		$enable_input['effectuee_date']='';
		$enable_input['obs']='';
		$opreration['effectuee_date']=date('Y-m-d');
		if(isset($_POST['km_estimes']) and is_numeric($_POST['km_estimes']))$operation['effectuee_km']=$_POST['km_estimes'];
		else $operation['effectuee_km']=0;
		$action='?action=valid_operation';
		$titre_formulaire='Réalisation d\'une opération<br>sur'.$vehicule['libelle'];
		
	}
	else header('location:?');
}
else
{
	$liste_vehicules=get_liste_vehicule();
	if(!empty($liste_vehicules))
	{
		foreach ($liste_vehicules as $key => $vehicule) 
		{
			$liste_vehicules[$key]['libelle']=$vehicule['marque'].' - '.$vehicule['modele'];
		}
	}
	$action='?action=create_operation';
	$titre_formulaire='Création d\'une opération';
	

//echo '</br>$liste_vehicules:';print_r($liste_vehicules);
include_once './view/formulaire_operation.php';
