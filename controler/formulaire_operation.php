<?php
echo "controler formulaire opération</br>";

include_once './model/formulaire_operation.php';

//$operation pour le remplissage des champs
$operation=array('id_vehicule'=>null, 'denomination'=>null, 'periodicite_km'=>null, 'periodicite_tps'=>null, 'effectuee_km'=>null, 'effectuee_date'=>null, 'echeance_km'=>null, 'echeance_date'=>null, 'obs'=>null);
echo '$operation:';print_r($operation);echo '</br>';


//verification des information du post avant de creer la ligne sql ou renvoie au formulaire pour correction
if(isset($_GET['action']) and $_GET['action']=='create_operation')
{
	$erreur=0;
	$vehicule=get_infos_vehicule($_POST['id_vehicule']);
	echo '$vehicule:';print_r($vehicule);echo '</br>';
	
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
		function check_date_format($date/*,$id*/) 
		{ 
		echo '</br>check_date_format date:';print_r($date);echo '</br>';
    		preg_match("#(\d{1,2})/(\d{1,2})/(\d{4})#" , $date, $matches); 
    		$return = 0; 
		    ## Perform all the checks 
		    /*if (!empty($matches) && 
		        ## check dd OR mm if American 
		        $matches[1] >= 0 && $matches[1] <= ($id != 'US' ? 31 : 12) && 
		        ## check mm OR dd if American 
		        $matches[2] >= 0 && $matches[2] <= ($id != 'US' ? 12 : 31) && 
		        ## check yyyy (adjust the figures to suitable ones) 
		        $matches[3] >= 1950 && $matches[3] <= 2004 
		        ) 
		    { $return = 1;} */
		    print_r ($matches);
		    return $return; 
		}
		echo '</br>check_date_format matches:';check_date_format($_POST['effectuee_date']);echo '</br>';
		
		$operation['effectuee_date'] = $_POST['effectuee_date'];
		//echo '</br>$date:';print_r($operation['effectuee_date']);echo '</br>';
		/*function check_date_format($date,$id) 
{ 
    preg_match("#(\d{2})/(\d{2})/(\d{4})#" , $date, $matches); 
    $return = 0; 
    ## Perform all the checks 
    if (!empty($matches) && 
        ## check dd OR mm if American 
        $matches[1] >= 0 && $matches[1] <= ($id != 'US' ? 31 : 12) && 
        ## check mm OR dd if American 
        $matches[2] >= 0 && $matches[2] <= ($id != 'US' ? 12 : 31) && 
        ## check yyyy (adjust the figures to suitable ones) 
        $matches[3] >= 1950 && $matches[3] <= 2004 
        ) 
    { $return = 1;} 
    return $return; 
} 

########### Examples: ########### 

## Format: dd/mm/yyyy leave the second argumant blank 
$string = '25/12/2004'; 
if (check_date_format($string,"") == 1) 
{ echo "Entry is acceptable."; } 
else { echo "Entry in NOT acceptable"; } 

$string = '12/25/2004'; 
## Format: mm/dd/yyyy Input "US" as second argument 
if (check_date_format($string,"US") == 1) 
{ echo "Entry is acceptable."; } 
else { echo "Entry in NOT acceptable"; } 


?>*/
		//$operation['effectuee_date']=$_POST['effectuee_date'];
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
	
	if($operation['periodicite_km']!=0)
	{
		$operation['echeance_km']=$operation['effectuee_km']+$operation['periodicite_km'];
	}
	else $operation['echeance_km']=0;

	if($operation['periodicite_tps']!=0 and $operation['effectuee_date']!='1900-01-01')
	{
		/*$date = new DateTime($operation['effectuee_date']);
		$date->add(new DateInterval('P'.$operation['periodicite_tps'].'M'));
		$operation['echeance_date']=$date->format('Y-m-d');*/
	}
	else $operation['echeance_date']='2099-01-01';

	if(isset($_POST['obs']))
	{
		$operation['obs']=$_POST['obs'];
	}
	else $operation['obs']="";
	
	
	echo '$operation:';print_r($operation);echo '</br>';
	echo '$erreur:';print_r($erreur);echo '</br>';
	
	
}
	
$liste_vehicules=get_liste_vehicule();
if(!empty($liste_vehicules))
{
	foreach ($liste_vehicules as $key => $vehicule) 
	{
		$liste_vehicules[$key]['libelle']=$vehicule['marque'].' - '.$vehicule['modele'];
	}
}

echo "</br>Liste vehicules:";print_r($liste_vehicules);

include_once './view/formulaire_operation.php';
