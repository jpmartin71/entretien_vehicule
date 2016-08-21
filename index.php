<?php 
// test.php
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
ini_set('display_startup_errors',1);
//error_reporting(E_ALL);

foreach ($_GET as $key => $value) $_GET[$key]=htmlspecialchars($value);
foreach ($_POST as $key => $value) $_POST[$key]=htmlspecialchars($value);
	//echo '$_GET:';print_r($_GET);	
	echo '</br>$_POST:';print_r($_POST);

	include_once("./model/connexion_sql.php");
	
	if(isset($_GET['form']) and !empty($_GET['form']))
	{
		if ($_GET['form']=='create_vehicule' or $_GET['form']=='update_vehicule') include_once './controler/formulaire_vehicule.php';
		elseif($_GET['form']=='new_operation')include_once './controler/formulaire_operation.php';
	}
	else if(isset($_GET['action']) and !empty($_GET['action']))
	{
		if($_GET['action']=='create_vehicule' or $_GET['action']=='update_vehicule')include_once './controler/formulaire_vehicule.php';
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
