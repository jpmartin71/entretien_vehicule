
<?php
include_once './model/fonctions_vehicule.php';
include_once './model/fonctions_divers.php';
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
	$estimation_km=estimation_km($vehicule,$releve_kilometrique);
	$estimation_km['moy_annuelle_km_totale']=round($estimation_km['moy_km_totale']*365);
	$estimation_km['moy_annuelle_km_achat']=round($estimation_km['moy_km_achat']*365);
	if(!empty($releve_kilometrique)) 
	{
		foreach ($releve_kilometrique as $key => $value) $releve_kilometrique[$key]=htmlspecialchars($value);
	}
//toutes opérations du vehicule
	$operations=get_operations($_GET['vehicule']);
	if(!empty($operations))
	{
			foreach ($operations as $key => $value) $operations[$key]=htmlspecialchars($value);
	}
echo '</br>$operation:';print_r($operations);
	
//oprérations à echeance aujourd'hui
	$date_limite=date_create();
	$op_echeance=get_operations_echues($_GET['vehicule'],$date_limite->format('Y-m-d'),$estimation_km['estimation_km_achat'],$estimation_km['moy_km_achat']);

//oprérations à echeance dans X mois
	$date_limite->add(new DateInterval('P12M'));
	$km_limite=round($estimation_km['estimation_km_achat']+(date_diff(date_create(), $date_limite)->format('%a')*$estimation_km['moy_km_achat']));
	$op_previ=get_operations_previsionnelles($_GET['vehicule'],$date_limite->format('Y-m-d'),$km_limite,$estimation_km['estimation_km_achat'],$estimation_km['moy_km_achat']);






	include_once './view/traitement_vehicule.php';

?>
