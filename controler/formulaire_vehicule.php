<?php

echo '</br><strong>Controler formulaire vehicule</strong>';

$vehicule=array('id'=>null,'marque'=>null,'modele'=>null,'date_1_immat'=>null,'date_achat'=>null,'km_achat'=>null,'vin'=>null,'immatriculation'=>null);
	
if(isset($_GET['action']) and $_GET['action']=='create_vehicule')
{
		  include_once './controler/create_vehicule.php'
}
