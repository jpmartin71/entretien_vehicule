<?php 
function check_date_format($date) 
  { 
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
			return $return; 
		}

function estimation_km($vehicule,$releve_kilometrique)
{
	global $bdd;
	$return=array('estimation_km_totale' => null, 'estimation_km_achat' => null, 'moy_km_totale'=>41,'moy_km_achat'=>41);
	//moy_km_totale: estimation des km par jours depuis la mise en circulation 41 par default (14965/ans)
	//moy_km_achat: estimation des km par jours depuis achat 41 par default (14965/ans)
	$date_now=date_create('now');

	$date_achat=date_create($vehicule['date_achat']);
	$diff_achat_now=date_diff($date_achat,$date_now);

	$date_mise_circulation=date_create($vehicule['date_1_immat']);
	$diff_mise_circulation_now=date_diff($date_mise_circulation,$date_now);

	if(!empty($releve_kilometrique))
	{
		$date_releve=date_create($releve_kilometrique['date_releve']);
		$diff_releve_now=date_diff($date_releve,$date_now);

		$diff_achat_releve=date_diff($date_releve,$date_achat);
		$return['moy_km_achat']=($releve_kilometrique['km_releve']-$vehicule['km_achat'])/$diff_achat_releve->format('%a');
		$return['estimation_km_achat']=round(($releve_kilometrique['km_releve'])+$return['moy_km_achat']*$diff_releve_now->format('%a'));

		$diff_mise_circulation_releve=date_diff($date_releve,$date_mise_circulation);
		$return['moy_km_totale']=$releve_kilometrique['km_releve']/$diff_mise_circulation_releve->format('%a');
		$return['estimation_km_totale']=round(($releve_kilometrique['km_releve'])+$return['moy_km_totale']*$diff_releve_now->format('%a'));
	}
	else
	{
		$diff_mise_en_circulation_achat=date_diff($date_achat,$date_mise_circulation);
		if($diff_mise_en_circulation_achat->format('%a')>0)
		{
			$return['moy_km_achat']=$vehicule['km_achat']/$diff_mise_en_circulation_achat->format('%a');
			$return['estimation_km_achat']=round(($vehicule['km_achat'])+$return['moy_km_achat']*$diff_achat_now->format('%a'));
		}
		else $return['estimation_km_achat']=round($return['moy_km_achat']*$diff_achat_now->format('%a'));
		
		$return['estimation_km_totale']=round($return['moy_km_totale']*$diff_mise_circulation_now->format('%a'));

	}
	return $return;
}