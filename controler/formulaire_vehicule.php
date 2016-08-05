<?php

echo '</br><strong>Controler formulaire vehicule</strong>';

$vehicule=array('id'=>null,'marque'=>null,'modele'=>null,'date_1_immat'=>null,'date_achat'=>null,'km_achat'=>null,'vin'=>null,'immatriculation'=>null);
	
if(isset($_GET['action']) and $_GET['action']=='create_vehicule')
{
<<<<<<< HEAD
		  include_once './controler/create_vehicule.php'
}
=======
		  include_once './controler/create_vehicule.php';
}

elseif(isset($_GET['action']) and $_GET['action']=='udate_vehicule')
{
		  include_once './controler/update_vehicule.php';
}

include_once './view/formulaire_vehicule.php';
>>>>>>> 14716d079b3738ea35c4bd36d072fe55ace63790
