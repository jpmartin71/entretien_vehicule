<?php
//----------fonctions----------//
function check_date_format($date) 
		{ 
//echo '</br>check_date_format date:';print_r($date);echo '</br>';
	    		$return['is_date'] = 0;
	    		
	    		if(preg_match("#(\d{1,2})[-/](\d{1,2})[-/](\d{4})#" , $date, $matches)) //format dd-mm-YYYY
	    		{
		    		## Perform all the checks 
				 if (!empty($matches) && checkdate($matches[2], $matches[1], $matches[3])) //checkdate(mois,jour,annee)
				 { 
				  	$return ['is_date']= 1;
				  	$date_form = new DateTime();
					$date_form->setDate($matches[3], $matches[2], $matches[1]);//setdate(annee,mois,jour)
					$return ['date']=$date_form->format('Y-m-d');
				 }	
	    		}
			elseif(preg_match("#(\d{4})[-/](\d{1,2})[-/](\d{1,2})#" , $date, $matches))//format YYYY-mm-dd
			{
				if (!empty($matches) && checkdate($matches[2],$matches[3], $matches[1])) //checkdate(mois,jour,annee)
				 { 
				  	$return ['is_date']= 1;
				  	$date_form = new DateTime();
					$date_form->setDate($matches[1], $matches[2], $matches[3]);//setdate(annee,mois,jour)
					$return ['date']=$date_form->format('Y-m-d');
				 }	
			}
//echo '</br>check_date_format matches:';print_r ($matches);echo '</br>';
			    return $return; 
		}
		
//----------Code---------//
	$erreur=0;
	$vehicule=get_infos_vehicule($_POST['id_vehicule']);
//echo '$vehicule:';print_r($vehicule);echo '</br>';
	
	if(isset($_POST['id_vehicule']) and !empty($vehicule))
	{//si id_vehicule est present et que le vehicule existe
		$operation['id_vehicule']=$vehicule['id'];
	}
	else 
	{
		$operation['id_vehicule']=0;
		$erreur+=1;
	}
	
	if(isset($_POST['denomination']) and !empty($_POST['denomination']))
	{//si denomination est present et que denomination n'est pas vide
		$operation['denomination']=$_POST['denomination'];
	}
	else
	{
		$operation['denomination']="";
		$erreur+=2;
	}
	
	if(isset($_POST['periodicite_km']) and !empty($_POST['periodicite_km']) and is_numeric($_POST['periodicite_km']))
	{//si periodicite_km est present et que periodicite_km n'est pas vide et est un nombre
		$operation['periodicite_km']=$_POST['periodicite_km'];
	}
	elseif(isset($_POST['inib_periodicite_km']))
	{//si l'operation n'est pas soumise à une périodicité en km
		$operation['periodicite_km']=0;
	}
	else
	{
		$operation['periodicite_km']=0;
		$erreur+=4;
	}
	
	if(isset($_POST['periodicite_tps'])and !empty($_POST['periodicite_tps']) and is_numeric($_POST['periodicite_tps']))
	{//si periodicite_tps est present et que periodicite_tps n'est pas vide et est un nombre
		$operation['periodicite_tps']=$_POST['periodicite_tps'];
	}
	elseif(isset($_POST['inib_periodicite_tps']))
	{//si l'operation n'est pas soumise à une périodicité en km
		$operation['periodicite_tps']=0;
	}
	else
	{
		$operation['periodicite_tps']=0;
		$erreur+=6;
	}
	
	if(isset($_POST['effectuee_km'])and !empty($_POST['effectuee_km']) and is_numeric($_POST['effectuee_km']))
	{//si effectuee_km est present et que effectuee_km n'est pas vide et est un nombre
		$operation['effectuee_km']=$_POST['effectuee_km'];
	}
	else
	{
		$operation['effectuee_km']=0;
		$erreur+=8;
	}
	
	if(isset($_POST['effectuee_date']) and !empty($_POST['effectuee_date']))
	{//si effectuee_date est present et que effectuee_date n'est pas vide et est un nombre
		$date_temp=check_date_format($_POST['effectuee_date']);
		if($date_temp['is_date'])
		{
			$operation['effectuee_date'] = $date_temp['date'];
		}
		else
		{
			$operation['effectuee_date']='1900-01-01';
			$erreur+=16;
		}
		
//echo '</br>$date:';print_r($operation['effectuee_date']);echo '</br>';
	}
	elseif (isset($vehicule['date_1_immat']) and !empty($vehicule['date_1_immat']) and empty($_POST['effectuee_date'])) 
	{
		$operation['effectuee_date']=$vehicule['date_1_immat'];
	}
	else
	{
		$operation['effectuee_date']='1900-01-01';
		$erreur+=16;
	}
echo '</br>$date_temp:';print_r($date_temp);echo '</br>';
	if($operation['periodicite_km']!=0)
	{
		$operation['echeance_km']=$operation['effectuee_km']+$operation['periodicite_km'];
	}
	else $operation['echeance_km']=0;
	if($operation['periodicite_tps']!=0 and $operation['effectuee_date']!='1900-01-01')
	{
		
	}
	else $operation['echeance_date']='2099-01-01';
	if(isset($_POST['obs']))
	{
		$operation['obs']=$_POST['obs'];
	}
	else $operation['obs']="";
	
	
echo '</br>$operation:';print_r($operation);echo '</br>';
echo '</br>$erreur:';print_r($erreur);echo '</br>';
	
