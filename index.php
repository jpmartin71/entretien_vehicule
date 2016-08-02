<?php 

foreach ($_GET as $key => $value) $_GET[$key]=htmlspecialchars($value);
foreach ($_POST as $key => $value) $_POST[$key]=htmlspecialchars($value);
	echo '$_GET:';print_r($_GET);echo '</br>';	
	echo '$_POST:';print_r($_POST);echo '</br>';

	include_once("./model/connexion_sql.php");
	
	if(isset($_GET['form']) and !empty($_GET['form']))
	{
		echo 'section form';
		if ($_GET['form']=='create_vehicule') include_once './view/formulaire_vehicule.php';
		else if($_GET['form']=='new_operation')include_once './controler/formulaire_operation.php';
	}
	else if(isset($_GET['action']) and !empty($_GET['action']))
	{
		if($_GET['action']=='create_vehicule')include_once './controler/create_vehicule.php';
		elseif($_GET['action']=='maj_vehicule')include_once './controler/update_vehicule.php';
		elseif($_GET['action']=='create_operation')include_once './controler/formulaire_operation.php';
	}
	else if(isset($_GET['page']) and !empty($_GET['page']))
	{
		if($_GET['page']=='vehicule' and isset($_GET['vehicule']) and !empty($_GET['vehicule']))include_once './controler/traitement_vehicule.php';
		else include_once './controler/acceuil.php';
	}
	else
	{
		include_once './controler/acceuil.php';
	}
