<?php 


//verification des champs

	$erreur=0;
	
	if(isset($_POST['id']) and $_POST['id']>0)$vehicule['id']=$_POST['id'];
	
	if(isset($_POST['marque']))$vehicule['marque']=$_POST['marque'];
	else $vehicule['marque']="";
	
	if(isset($_POST['modele']) and !empty($_POST['modele']))
	{
		$vehicule['modele']=$_POST['modele'];
	}
	else
	{
		$vehicule['marque']=null;
		$erreur+=1;
	}
	
	if(isset($_POST['date_1_immat']) and !empty($_POST['date_1_immat']))
	{
		$date_immat=check_date_format($_POST['date_1_immat']);
			if($date_immat['is_date'])
			{
				$vehicule['date_1_immat'] = $date_immat['date'];
			}
			else
			{
				$vehicule['date_1_immat']=null;
				$erreur+=2;
			}
	}
	else
	{
		$vehicule['date_1_immat']=null;
		$erreur+=2;
	}	
		
	if(isset($_POST['date_achat']) and !empty($_POST['date_achat']))
	{
		$date_achat=check_date_format($_POST['date_achat']);
			if($date_achat['is_date'])
			{
				$vehicule['date_achat'] = $date_achat['date'];
			}
			else
			{
				$vehicule['date_achat']=null;
				$erreur+=4;
			}
	}
	else
	{
		$vehicule['date_achat']=null;
		$erreur+=4;
	}		
	
	if(isset($_POST['km_achat']) and (is_numeric($_POST['km_achat'])))	
	{
		$vehicule['km_achat']=($_POST['km_achat']);
	}
	else
	{
		$vehicule['km_achat']=null;
		$erreur+=8;
	}
	
	if(isset($_POST['immatriculation']))$vehicule['immatriculation']=$_POST['immatriculation'];
	else $vehicule['immatriculation']=null;
	
	if(isset($_POST['vin']))$vehicule['vin']=$_POST['vin'];
	else $vehicule['vin']=null;
	
	if(!isset($_POST['possession']))$vehicule['possession']=0;
	else $vehicule['possession']=1;

//gestion des erreurs
if($erreur==0)
{
	if($_GET['action']=='create_vehicule')
	{
		//code pour ajout sql
		if(set_new_vehicule($vehicule))
		{
			$no_erreur_view['view']='Véhicule ajouté avec succès.';
			$vehicule=array('id'=>null,'marque'=>null,'modele'=>null,'date_1_immat'=>null,'date_achat'=>null,'km_achat'=>null,'vin'=>null,'immatriculation'=>null,'possession'=>1);
	
		}
		else $erreur_view['view']='Echec de la création du nouveau véhicule.</br><strong>Le véhicule existe déja.</strong>';
	}
	elseif($_GET['action']=='update_vehicule')
	{
		//code pour ajout sql
		if(1)//code update à faire
		{
			$no_erreur_view['view']='Véhicule mise à jour avec succès.';
			//$vehicule=array('id'=>null,'marque'=>null,'modele'=>null,'date_1_immat'=>null,'date_achat'=>null,'km_achat'=>null,'vin'=>null,'immatriculation'=>null,'possession'=>1);
	
		}
		else $erreur_view['view']='Echec de la mise à jour du véhicule.';	
	}
}
else
{
	if($_GET['action']=='create_vehicule')$erreur_view['view']='Echec de la création du nouveau véhicule.</br>Corriger les champs.';
	elseif($_GET['action']=='update_vehicule')$erreur_view['view']='Echec de la mise à jour du véhicule.</br>Corriger les champs.';
	if(($erreur & 1)!=0)$erreur_view['modele']='<p>Veuillez saisir un modèle!</p>';
	if(($erreur & 2)!=0)$erreur_view['date_1_immat']='<p>Saisir la date de 1ere mise en circulation (format:jj/mm/aaaa)!</p>';
	if(($erreur & 4)!=0)$erreur_view['date_achat']='<p>Saisir la date d\'achat (format:jj/mm/aaaa)!</p>';
	if(($erreur & 8)!=0)$erreur_view['km_achat']='<p>Saisir le kilométrage à l\'achat!</p>';

}
