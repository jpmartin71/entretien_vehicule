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
			<article class="synthese_vehicule">
				<div class="infos_vehicule synthese_vehicule">
					<h2><?php echo $vehicule['marque'];?> - <?php echo $vehicule['modele'];?></h2>
				</div>
				
				<div class="kilometrage synthese_vehicule">
					<h3>Kilométrage</h3>
					<p><strong>Kilometrage estimé:</strong> depuis l'achat <strong><?php echo $estimation_km['estimation_km_achat'];?> km </strong>(<?php echo $estimation_km['moy_annuelle_km_achat'];?>km/an) / depuis la mise en circulation <?php echo $estimation_km['estimation_km_totale'];?> km (<?php echo $estimation_km['moy_annuelle_km_totale'];?>km/an).
					<?php if(!empty($releve_kilometrique))
					{?>
						</br>Dernier relevé <strong><?php echo $releve_kilometrique['km_releve'];?>km, le <?php echo $releve_kilometrique['date_releve'];?></strong> </p>
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

				<div class="ope_a_echeance synthese_vehicule">
					<h3>Opérations arrivées à échéance</h3>
					<table>
						<tr>
							<th>Valider</th>
							<th>Dénomination</th>
							<th>Date d'échéance</th>
							<th>Echéance kilométrique</th>
							<th>Effectuée le</th> 
							<th>à XX km</th> 
						</tr>
						<?php foreach ($op_echeance as $operation) 
						{?>
							<tr>
								<td>
									<form method='post' action='#'>
										<input type='hidden' id='id' name='id' value'<?php echo $operation['id'];?>'>
										<input type='submit' value='valid'>
									</form>
								</td>								<td><?php echo $operation['denomination'];?></td>
								<td class="<?php if($operation['its_date']) echo 'echeance';?> "><?php echo $operation['echeance_date'];?></td>
								<td class="<?php if($operation['its_km']) echo 'echeance';?> "><?php echo $operation['echeance_km'];?></td>
								<td><?php echo $operation['effectuee_date'];?></td>
								<td><?php echo $operation['effectuee_km'];?></td>
							</tr>
						<?php	
						}?>
					</table>
				</div>

				<div class="ope_a_venir synthese_vehicule">
					<h3>Opérations prévisionnelles (12mois)</h3>
					<p><?php echo $date_limite->format('d/m/Y');?> ou <?php echo $km_limite;?>km</p>
					<table>
						<tr>
							<th>Dénomination</th>
							<th>Date d'échéance</th>
							<th>Echéance kilométrique</th>
							<th>Effectuée le</th> 
							<th>à XX km</th> 
						</tr>
						<?php foreach ($op_previ as $operation) 
						{?>
							
							<tr>
								<td><?php echo $operation['denomination'];?></td>
								<td class="<?php if($operation['its_date']) echo 'echeance';?> "><?php echo $operation['echeance_date'];?></td>
								<td class="<?php if($operation['its_km']) echo 'echeance';?> "><?php echo $operation['echeance_km'];?></td>
								<td><?php echo $operation['effectuee_date'];?></td>
								<td><?php echo $operation['effectuee_km'];?></td>
							</tr>
						<?php	
						}?>
					</table>
				</div>
				
				<div class="operations synthese_vehicule">
					<h3>Opérations du véhicule</h3>
					<?php
					if(!empty($operations))
					{?>
						<table>
							<tr>
								<th>Dénomination</th>
								<th>Date d'échéance</th>
								<th>Echéance kilométrique</th>
								<th>Effectuée le</th> 
								<th>à XX km</th> 
							</tr>
						<?php foreach ($operations as $operation) 
						{?>
							<tr>
								<td><?php echo $operation['denomination'];?></td>
								<td><?php echo $operation['echeance_date'];?></td>
								<td><?php echo $operation['echeance_km'];?></td>
								<td><?php echo $operation['effectuee_date'];?></td>
								<td><?php echo $operation['effectuee_km'];?></td>
							</tr>
						<?php	
						}?>
					</table>
					<?php
					}
					else echo "<p>Néant</p>";?>
				</div>

			</article>
			<aside class="synthese_vehicule">
				<div class="infos_vehicule">
					<h3>Infos véhicule</h3>
					<ul>
						<li><strong>Constructeur:</strong><br><?php echo $vehicule['marque'];?></li>
						<li><strong>Modèle:</strong><br><?php echo $vehicule['modele'];?></li>
						<li><strong>1ere mise en circulation:</strong><br><?php echo date_create($vehicule['date_1_immat'])->format('d/m/Y');?></li>
						<li><strong>Date d'achat:</strong><br><?php echo date_create($vehicule['date_achat'])->format('d/m/Y');?></li>
						<li><strong>Kilométrage à l'achat:</strong><br><?php echo $vehicule['km_achat'];?> km</li>
						<li><strong>Immatriculation:</strong><br><?php echo $vehicule['immatriculation'];?></li>
						<li><strong>VIN:</strong><br><?php echo $vehicule['vin'];?></li>
						<li class="lien_modif"><a href="?form=update_vehicule&vehicule=<?php echo $vehicule['id'];?>">Modifier le véhicule</a></li>
					</ul>
							
					
				</div>
			</aside>
		</section>
		
		
        
	</body>
</html>
