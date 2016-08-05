<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <title>Entretien des vehicules</title>
		<link href="" rel="stylesheet" type="text/css" /> 
    </head>
        
    <body>
		<?php include_once("header.php");?>
		<?php include_once("navigation.php");?>
		<?php include_once 'erreurs.php';?>
		<section>
			<article>
				
				<ul>
				<?php
					foreach ($liste_vehicule as $vehicule) 
					{?>
						<li><a class="vehicule_acceuil" href="?page=vehicule&vehicule=<?php echo $vehicule['id'];?>"><?php echo $vehicule['marque'].'</br>'.$vehicule['modele'];?></a></li>
					<?php
					}
					?>
				</ul>
			</article>
			<aside>
				
			</aside>
		</section>
		
		
        
	</body>
</html>