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
				<form class="form_vehicule" method="post" action="<?php echo $action_form;?>" >
					<div class="form_vehicule">
						<label for="marque">Marque:</label>
						<input type="text" name="marque" id="marque">
					</div>
					<div class="form_vehicule">
						<label for="modele">Modèle*:</label>
						<input type="text" name="modele" id="modele">
					</div>
					<div class="form_vehicule">
						<label for="date_1_immat">Date de 1ere mise en circulation:</label>
						<input type="date" name="date_1_immat" id="date_1_immat">
					</div>
					<div class="form_vehicule">
						<label for="vin">VIN:</label>
						<input type="text" name="vin" id="vin">
					</div>
					<div class="form_vehicule">
						<label for="immat">Immatriculation:</label>
						<input type="text" name="immat" id="immat">
					</div>
					<div class="form_vehicule">
						<label for="date_achat">Date d'achat:*</label>
						<input type="date" name="date_achat" id="date_achat">
					</div>
					<div class="form_vehicule">
						<label for="km_achat">Kilometrage  l'achat:</label>
						<input type="number" name="km_achat" id="km_achat">
					</div>
					<div class="form_vehicule">
						<label for="possession">Vehicule en ma possession actuellement:</label>
						<input type="checkbox" name="possession" id="possession"/>
					</div>
	
					<input type="submit" value="<?php echo $text_submit;?>"/>
				</form>
					
				<p>*: champs obligatoire.</p>
				

				

			</article>
			<aside>
			
			</aside>
		</section>
		
		
        
	</body>
</html>


