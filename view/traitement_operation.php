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
			<article class="synthese_operation">
				<div class="liste_operations">
					<h3>Opérations par véhicule</h3>

					<table>
						<tr>
							<th>Modifier</th>
							<th>Supprimer</th>
							<th>Véhicule</th>
							<th>Dénomination</th>
							<th>Date d'échéance</th>
							<th>Echéance kilométrique</th>
							<th>Effectuée le</th> 
							<th>à XX km</th> 
						</tr>
						<?php foreach ($listes_operations as $operation) 
						{?>
							<tr>
								<td>
									<form method='post' action='?form=update_operation'>
										<input type='hidden' id='id_operation' name='id_operation' value="<?php echo $operation['id'];?>">
										<input type='submit' value='Modifier'>
									</form>
								</td>
								<td>
									<form method='post' action='?form=delete_operation'>
										<input type='hidden' id='id_operation' name='id_operation' value="<?php echo $operation['id'];?>">
										<input type='submit' value='Supprimer'>
									</form>
								</td>			
								<td><?php echo $operation['marque'].' - '.$operation['modele'];?></td>
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
			</article>
			<aside>
				
			</aside>
		</section>
		
		
        
	</body>
</html>
