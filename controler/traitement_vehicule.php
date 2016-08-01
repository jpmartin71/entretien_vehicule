
<?php
include_once './model/traitement_vehicule.php';
	if(!is_numeric($_GET['vehicule']))header('location:?');

//update kilometrage
	if(!empty($_POST['date_releve']) and !empty($_POST['km_releve']))
	{
		if (get_doublon($_GET['vehicule'], $_POST['date_releve'], $_POST['km_releve']))
		{
			set_releve($_GET['vehicule'], $_POST['date_releve'], $_POST['km_releve']);
			$_GET['no_erreur']='releve_kilometrique';
		}
			
	}
	else if(isset($_POST['date_releve']) and isset($_POST['km_releve']) and (!empty($_POST['date_releve']) or !empty($_POST['km_releve'])))
	{
		$_GET['erreur']='releve_kilometrique';
		
	}

//infos véhicule
	$vehicule=get_infos_vehicule($_GET['vehicule']);
	foreach ($vehicule as $key => $value) $vehicule[$key]=htmlspecialchars($value);

//relevé kilometrique
	$releve_kilometrique=get_last_releve($_GET['vehicule']);
	if(!empty($releve_kilometrique)) 
	{
		print_r($releve_kilometrique);
		foreach ($releve_kilometrique as $key => $value) $releve_kilometrique[$key]=htmlspecialchars($value);
	}


//toutes opérations du vehicule
	$operations=get_operations($_GET['vehicule']);
	if(!empty($operations))
	{
			print_r($operations);
			foreach ($operations as $key => $value) $operations[$key]=htmlspecialchars($value);
	}




	include_once './view/traitement_vehicule.php';

?>