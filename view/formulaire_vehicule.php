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
				<?php if((isset($_GET['form']) and $_GET['form']=='update_vehicule') or (isset($_GET['action']) and $_GET['action']=='update_vehicule'))
				{?>
					<form class="form_vehicule" method="post" action="?page=vehicule&vehicule=<?php echo $vehicule['id'];?>">
						<input type="submit" value="Annuler et revenir à la page du vehicule"/>
					</form>
				<?php
				}?>
				<form class="form_vehicule" method="post" action="<?php echo $action_form;?>" >
					<div class="form_vehicule">
						<label for="marque">Marque:</label>
						<input type="text" name="marque" id="marque"  value="<?php echo $vehicule['marque'];?>">
					</div>
					<div class="form_vehicule <?php if(isset($erreur_view['modele']))echo 'erreur';?>">
						<?php if(isset($erreur_view['modele']))echo $erreur_view['modele'];?>
						<label for="modele">Modèle*:</label>
						<input type="text" name="modele" id="modele" value="<?php echo $vehicule['modele'];?>">
					</div>
					<div class="form_vehicule <?php if(isset($erreur_view['date_1_immat']))echo 'erreur';?>">
						<?php if(isset($erreur_view['date_1_immat']))echo $erreur_view['date_1_immat'];?>
						<label for="date_1_immat">Date de 1ere mise en circulation*:</label>
						<input type="date" name="date_1_immat" id="date_1_immat" value="<?php  if($vehicule['date_1_immat']!=null)echo date_create($vehicule['date_1_immat'])->format('d/m/Y');?>">
					</div>
					<div class="form_vehicule <?php if(isset($erreur_view['date_achat']))echo 'erreur';?>">
						<?php if(isset($erreur_view['date_achat']))echo $erreur_view['date_achat'];?>
						<label for="date_achat">Date d'achat*:</label>
						<input type="date" name="date_achat" id="date_achat" value="<?php if($vehicule['date_achat']!=null)echo date_create($vehicule['date_achat'])->format('d/m/Y');?>">
					</div>
					<div class="form_vehicule <?php if(isset($erreur_view['km_achat']))echo 'erreur';?>">
						<?php if(isset($erreur_view['km_achat']))echo $erreur_view['km_achat'];?>
						<label for="km_achat">Kilometrage  l'achat*:</label>
						<input type="number" name="km_achat" id="km_achat" value="<?php echo $vehicule['km_achat'];?>">
					</div>
					<div class="form_vehicule">
						<label for="immatriculation">Immatriculation:</label>
						<input type="text" name="immatriculation" id="immatriculation" value="<?php echo $vehicule['immatriculation'];?>">
					</div>
					<div class="form_vehicule">
						<label for="vin">VIN:</label>
						<input type="text" name="vin" id="vin" value="<?php echo $vehicule['vin'];?>">
					</div>
					<div class="form_vehicule">
						<label for="possession">Vehicule en ma possession actuellement:</label>
						<input type="checkbox" name="possession" id="possession"  <?php if($vehicule['possession'])echo 'checked';?>/>
					</div>
					<input type="hidden" name="id" id="id" value="<?php echo $vehicule['id'];?>">
					<input type="submit" value="<?php echo $text_submit;?>"/>
					<input type="reset" value="Reset"/>
				</form>
				
					
				<p>*: champs obligatoire.</p>
				

				

			</article>
			<aside>
			
			</aside>
		</section>
		
		
        
	</body>
</html>


