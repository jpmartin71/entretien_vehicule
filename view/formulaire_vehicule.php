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

				<?php
				
				
				if((isset($_GET['form'])) and ($_GET['form']=='maj_vehicule'))
				{
					?>
					<form class="form_vehicule" method="post" action="?action=update_vehicule">
						<label for="marque">Marque:</label>
						<input type="text" name="marque" id="marque">
						</br>

						<label for="modele">Modèle*:</label>
						<input type="text" name="modele" id="modele">
						</br>

						<label for="date_1_immat">Date de 1ere mise en circulation:</label>
						<input type="date" name="date_1_immat" id="date_1_immat">
						</br>

						<label for="vin">VIN:</label>
						<input type="text" name="vin" id="vin">
						</br>

						<label for="immat">Immatriculation:</label>
						<input type="text" name="immat" id="immat">
						</br>

						<label for="date_achat">Date d'achat:</label>
						<input type="date" name="date_achat" id="date_achat">

						<label for="possession">Possession actuelle:</label>
						<input type="checkbox" name="possession" id="possession"/>
						</br>

						<input type="submit" value="Mettre a jour"/>
					</form>
					<?php
				}

				else 
				{
					?>
					<form class="form_vehicule" method="post" action="?action=create_vehicule">
						<label for="marque">Marque:</label>
						<input type="text" name="marque" id="marque">
						</br>

						<label for="modele">Modèle*:</label>
						<input type="text" name="modele" id="modele">
						</br>

						<label for="date_1_immat">Date de 1ere mise en circulation:</label>
						<input type="date" name="date_1_immat" id="date_1_immat">
						</br>

						<label for="vin">VIN:</label>
						<input type="text" name="vin" id="vin">
						</br>

						<label for="immat">Immatriculation:</label>
						<input type="text" name="immat" id="immat">
						</br>

						<label for="date_achat">Date d'achat:</label>
						<input type="date" name="date_achat" id="date_achat">
						</br>

						<label for="possession">Possession actuelle:</label>
						<input type="checkbox" name="possession" id="possession"/>
						</br>

						<input type="submit" value="Créer véhicule"/>
					</form>
					<?php
				}?>

				<p>*: champs obligatoire.</p>
				

				

			</article>
			<aside>
			
			</aside>
		</section>
		
		
        
	</body>
</html>


