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
	
	##Vehicule
	if(isset($_POST['id_vehicule']) and !empty($vehicule))
	{//si id_vehicule est present et que le vehicule existe
		$operation['id_vehicule']=$vehicule['id'];
	}
	else 
	{
		$operation['id_vehicule']=0;
		$erreur+=1;
	}
	
	##Denomination
	if(isset($_POST['denomination']) and !empty($_POST['denomination']))
	{//si denomination est present et que denomination n'est pas vide
		$operation['denomination']=$_POST['denomination'];
	}
	else
	{
		$operation['denomination']="";
		$erreur+=2;
	}
	
	##periodicite_km
	if(isset($_POST['periodicite_km']) and !empty($_POST['periodicite_km']) and is_numeric($_POST['periodicite_km']))
	{//si periodicite_km est present et que periodicite_km n'est pas vide et est un nombre
		$operation['periodicite_km']=$_POST['periodicite_km'];
	}
	elseif(isset($_POST['inib_periodicite_km']))
	{//si l'operation n'est pas soumise à une périodicité en km
		$operation['periodicite_km']=null;
	}
	else
	{
		$operation['periodicite_km']=null;
		$erreur+=4;
	}
	
	##periodicite_tps
	if(isset($_POST['periodicite_tps'])and !empty($_POST['periodicite_tps']) and is_numeric($_POST['periodicite_tps']))
	{//si periodicite_tps est present et que periodicite_tps n'est pas vide et est un nombre
		$operation['periodicite_tps']=$_POST['periodicite_tps'];
	}
	elseif(isset($_POST['inib_periodicite_tps']))
	{//si l'operation n'est pas soumise à une périodicité en km
		$operation['periodicite_tps']=null;
	}
	else
	{
		$operation['periodicite_tps']=null;
		$erreur+=6;
	}
	
	##effectuee_km
	if(isset($_POST['effectuee_km']) and (!empty($_POST['effectuee_km']) or $_POST['effectuee_km']==0) and is_numeric($_POST['effectuee_km']))
	{//si effectuee_km est present et que effectuee_km n'est pas vide et est un nombre
		$operation['effectuee_km']=$_POST['effectuee_km'];
	}
	elseif(isset($_POST['inib_effectuee'])){$operation['effectuee_km']=0;echo '</br>effectuee_km:sortie 2</br>';	}
	else
	{
		echo '</br>effectuee_km:sortie 3</br>';	
		$operation['effectuee_km']=null;
		$erreur+=8;
	}
	
	##effectuee_tps
	if(isset($_POST['effectuee_date']) and !empty($_POST['effectuee_date']))
	{//si effectuee_date est present et que effectuee_date n'est pas vide et est un nombre
		$date_temp=check_date_format($_POST['effectuee_date']);
		if($date_temp['is_date'])
		{
			$operation['effectuee_date'] = $date_temp['date'];
		}
		else
		{
			$operation['effectuee_date']=null;
			$erreur+=16;
		}
	}
	elseif(isset($_POST['inib_effectuee']))
	{
		if (isset($vehicule['date_1_immat']) and !empty($vehicule['date_1_immat'])) 
		{
			$operation['effectuee_date']=$vehicule['date_1_immat'];
		}
		else $operation['effectuee_date']=null;
	}
	else
	{
		$operation['effectuee_date']=null;
		$erreur+=16;
	}
	
	##echeance km
	if($operation['periodicite_km']!=null)
	{
		$operation['echeance_km']=$operation['effectuee_km']+$operation['periodicite_km'];
	}
	else $operation['echeance_km']=null;
	
	##echeance tps
	if($operation['periodicite_tps']!=null and $operation['effectuee_date']!=null)
	{
echo '</br>date_temp:';print_r ($date_temp);echo '</br>';
		$date_temp = new DateTime($operation['effectuee_date']);
echo '</br>date_temp:';print_r ($date_temp);echo '</br>';		
		$date_temp->add(new DateInterval('P'.$operation['periodicite_tps'].'M')); //Où 'P12M' indique 'Période de 12 Mois'
echo '</br>date_temp:';print_r ($date_temp);echo '</br>';
		$operation['echeance_date']=$date_temp->format('Y-m-d');
echo '</br>date_temp:'.$operation['echeance_date'];echo '</br>';
	}
	else $operation['echeance_date']=null;
	
	
	##observations
	if(isset($_POST['obs']))
	{
		$operation['obs']=$_POST['obs'];
	}
	else $operation['obs']="";
	
	
echo '</br>$operation:';print_r($operation);echo '</br>';
echo '</br>$erreur:';print_r($erreur);echo '</br>';
	
