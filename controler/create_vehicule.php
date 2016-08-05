<?php 

//verification des champs
	$erreur=0;
	
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
		
	if(isset($_POST['km_achat']) and (!empty($_POST['km_achat']) or ($_POST['km_achat'])==0) )	
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
	
	if(isset($_POST['possession']))$vehicule['possession']=1;
	else $vehicule['possession']=0;
	
		//set_new_vehicule($_POST);
		
echo '</br>$vehicule:';print_r($vehicule);

		
	}
	else
	{
		
	}
