<?php

echo '</br><strong>Controler formulaire vehicule</strong>';

include_once './model/fonctions_vehicule.php';
include_once './controler/fonctions_divers.php';
$vehicule=array('id'=>null,'marque'=>null,'modele'=>null,'date_1_immat'=>null,'date_achat'=>null,'km_achat'=>null,'vin'=>null,'immatriculation'=>null,'possession'=>1);
	
if (isset($_GET['form']) and $_GET['form']=='create_vehicule')
{
	$action_form='?action=create_vehicule';
	$text_submit='Creer le vehicule';
}
elseif(isset($_GET['form']) and $_GET['form']=='update_vehicule') 
{
	$action_form='?action=update_vehicule';
	$text_submit='Mettre à jour le vehicule';
}

	
if(isset($_GET['action']) and $_GET['action']=='create_vehicule')
{
	$action_form='?action=create_vehicule';
	$text_submit='Creer le vehicule';
  	include_once './controler/create_vehicule.php';
		  
}

elseif(isset($_GET['action']) and $_GET['action']=='udate_vehicule')
{
	$action_form='?action=update_vehicule';
	$text_submit='Mettre à jour le vehicule';
	include_once './controler/update_vehicule.php';
}

include_once './view/formulaire_vehicule.php';

