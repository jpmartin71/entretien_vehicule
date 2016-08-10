<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <title>Entretien des vehicules</title>
		<link href="./view/style.css" rel="stylesheet" type="text/css" /> 
    </head>
        
    <body>
		<?php include_once("header.php");?>
		<?php include_once("navigation.php");?>
		<?php include_once 'erreurs.php';?>
		<section>
			<article>
				<div class="parent_vehicule_acceuil">
					<?php
					foreach ($liste_vehicule as $vehicule) 
					{?>
						<div class="vehicule_acceuil"><a  href="?page=vehicule&vehicule=<?php echo $vehicule['id'];?>"><?php echo $vehicule['marque'].'</br>'.$vehicule['modele'];?></a></div>
					<?php
					}
					?>	
				</div>

			</article>
			<aside>
				
			</aside>
		</section>
		
		
        
	</body>
</html>
