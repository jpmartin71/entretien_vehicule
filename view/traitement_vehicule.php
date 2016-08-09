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
				<div class="infos_vehicule">
					<h2><?php echo $vehicule['marque'];?> - <?php echo $vehicule['modele'];?></h2>
				</div>
				
				<div class="kilometrage">
					<h3>Kilométrage</h3>
					<p>Kilometrage estimé: depuis l'achat <?php echo $estimation_km['estimation_km_achat'];?> km (<?php echo $estimation_km['moy_annuelle_km_achat'];?>km/an) / depuis la mise en circulation <?php echo $estimation_km['estimation_km_totale'];?> km (<?php echo $estimation_km['moy_annuelle_km_totale'];?>km/an).</p>
					<?php if(!empty($releve_kilometrique))
					{?>
						<p>Dernier relevé <?php echo $releve_kilometrique['km_releve'];?>km, le <?php echo $releve_kilometrique['date_releve'];?></p>
					<?php }
					else 
					{?>
						<p>Aucun relevé effectué.</p>
					<?php }?>
					
					<form class="form_kilometrage" method='post' action='?page=vehicule&vehicule=<?php echo $vehicule['id'];?>'>
						<legend for="date_releve">Date du relevé:</legend>
						<input type='date' name="date_releve" id="date_releve" value=now>
						<legend for="km_releve">Kilométrage:</legend>
						<input type="number" name="km_releve" id="km_releve">
						<input type='submit' Value='Enregistrer'>

					</form>
				</div>

				<div class="ope_a_echeance">
					<h3>Opérations arrivées à échéance</h3>
					<table>
						<?php foreach ($op_echeance as $operation) 
						{?>
							<tr>
								<td><?php echo $operation['denomination'];?></td>
								<td class="<?php if($operation['its_date']) echo 'erreur';?> "><?php echo $operation['echeance_date'];?></td>
								<td class="<?php if($operation['its_km']) echo 'erreur';?> "><?php echo $operation['echeance_km'];?></td>
								<td><?php echo $operation['effectuee_date'];?></td>
								<td><?php echo $operation['effectuee_km'];?></td>
								<td><?php echo $operation['delta_km_estim'];?></td>
							</tr>
						<?php	
						}?>
					</table>
				</div>

				<div class="ope_a_venir">
					<h3>Opérations prévisionnelles (12mois)</h3>
					<table>
						<?php foreach ($op_previ as $operation) 
						{?>
							<tr>
								<td><?php echo $operation['denomination'];?></td>
								<td class="<?php if($operation['its_date']) echo 'erreur';?> "><?php echo $operation['echeance_date'];?></td>
								<td class="<?php if($operation['its_km']) echo 'erreur';?> "><?php echo $operation['echeance_km'];?></td>
								<td><?php echo $operation['effectuee_date'];?></td>
								<td><?php echo $operation['effectuee_km'];?></td>
								<td><?php echo $operation['delta_km_estim'];?></td>
							</tr>
						<?php	
						}?>
					</table>
				</div>
				
				<div class="operations">
					<h3>Opérations du véhicule</h3>
					<?php
					if(!empty($operations))
					{

					}
					else echo "<p>Néant</p>";?>
				</div>

			</article>
			<aside>
				<div class="infos_vehicule">
					<ul>
						<li>Constructeur:<br><?php echo $vehicule['marque'];?></li>
						<li>Modèle:<br><?php echo $vehicule['modele'];?></li>
						<li>Immatriculation:<br><?php echo $vehicule['immatriculation'];?></li>
						<li>1ere mise en circulation:<br><?php echo $vehicule['date_1_immat'];?></li>
						<li>VIN:<br><?php echo $vehicule['vin'];?></li>
						<li>Date d'achat:<br><?php echo $vehicule['date_achat'];?></li>
					</ul>
					<a href="?form=update_vehicule&vehicule=<?php echo $vehicule['id'];?>">Modifier le véhicule</a>
							
					
				</div>
			</aside>
		</section>
		
		
        
	</body>
</html>
