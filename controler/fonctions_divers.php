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
