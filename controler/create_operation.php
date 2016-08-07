<?php
//----------fonctions----------//

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
		$erreur+=8;
	}
	
	##effectuee_km
	if(isset($_POST['effectuee_km']) and (!empty($_POST['effectuee_km']) or $_POST['effectuee_km']==0) and is_numeric($_POST['effectuee_km']))
	{//si effectuee_km est present et que effectuee_km n'est pas vide et est un nombre
		$operation['effectuee_km']=$_POST['effectuee_km'];
	}
	elseif(isset($_POST['inib_effectuee']))
	{
		$operation['effectuee_km']=0;
	}
	else
	{
		$operation['effectuee_km']=null;
		$erreur+=16;
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
			$erreur+=32;
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
		$erreur+=32;
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
		$date_temp = new DateTime($operation['effectuee_date']);
		$date_temp->add(new DateInterval('P'.$operation['periodicite_tps'].'M')); //Où 'P12M' indique 'Période de 12 Mois'
		$operation['echeance_date']=$date_temp->format('Y-m-d');
	}
	else $operation['echeance_date']=null;
	
	
	##observations
	if(isset($_POST['obs']))
	{
		$operation['obs']=$_POST['obs'];
	}
	else $operation['obs']="";
	
	
/*echo '</br>$operation:';print_r($operation);
echo '</br>$erreur:';print_r($erreur);
echo '</br>$erreur vehicule:';print_r($erreur & 1);
echo '</br>$erreur denomination:';print_r($erreur & 2);
echo '</br>$erreur period km:';print_r($erreur & 4);
echo '</br>$erreur period tps:';print_r($erreur&8);
echo '</br>$erreur effectuée km:';print_r($erreur&16);
echo '</br>$erreur effectuée date:';print_r($erreur&32);*/

if($erreur==0)
{
	//code pour ajout sql
	create_operation($operation);
	$no_erreur_view['view']='Opération ajoutée avec succès.';
	$operation=array('id_vehicule'=>null, 'denomination'=>null, 'periodicite_km'=>null, 'periodicite_tps'=>null, 'effectuee_km'=>null, 'effectuee_date'=>null, 'echeance_km'=>null, 'echeance_date'=>null, 'obs'=>null);

}
else
{
	$erreur_view['view']='Echec de la création de l\'opération.</br>Corriger les champs.';
	if(($erreur & 1)!=0)$erreur_view['vehicule']='<p>Veuillez selectionner un véhicule</p>';
	if(($erreur & 2)!=0)$erreur_view['denomination']='<p>Saisir l\'intitulé de l\'operation</p>';
	if(($erreur & 4)!=0)$erreur_view['periodicite_km']='<p>Saisir un nombre de km ou cocher la case "Pas de périodicité kilométrique"</p>';
	if(($erreur & 8)!=0)$erreur_view['periodicite_tps']='<p>Saisir un nombre de mois ou cocher la case"Pas de périodicité temporelle"</p>';
	if(($erreur & 16)!=0)$erreur_view['effectuee_km']='<p>Saisir un nombre de km ou cocher la case "Opération jamais éffectuée."</p>';
	if(($erreur & 32)!=0)$erreur_view['effectuee_date']='<p>Saisir une date correcte(jj/mm/aaaa) ou cocher la case "Opération jamais éffectuée."</p>';
//echo '</br>$erreur_view:';print_r($erreur_view);	
}
