<?php 	echo "</br>view formulaire opération"; 
	echo "<p>Branche nouvelle opération</p>";?>
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
			<article >
				<form class="form_operation" method="post" action="?action=create_operation">
					<div class="form_operation">
						<legend for="id_vehicule">Véhicule:</legend>
						<select name="id_vehicule" id="id_vehicule">
							<?php
								foreach($liste_vehicules as $vehicule)?> <option value='<?php echo $vehicule['id'];?>'><?php echo $vehicule['libelle'];?></option>
						</select>
						
						<legend for="denomination">Dénomination:</legend>
						<input type="text" name="denomination" id="denomination" value="<?php echo $opreration['denomination'];?>">

						<legend for="periodicite_km">Périodicité (en km)</legend>
						<input type="number" name="periodicite_km" id="periodicite_km">

						<legend for="periodicite_tps">Périodicité (en mois)</legend>
						<input type="number" name="periodicite_tps" id="periodicite_tps">
					</div>
					<div class="form_operation">
						<legend for="effectuee_km">Effectué à</legend>
						<input type="number" name="effectuee_km" id="effectuee_km">

						<legend for="effectuee_tps">Effectué le</legend>
						<input type="date" name="effectuee_tps" id="effectuee_tps">

						<legend for="echeance_km">Prochaine échéance (km)</legend>
						<input type="number" name="echeance_km" id="echeance_km">

						<legend for="echeance_date">Prochaine échéance (date)</legend>
						<input type="date" name="echeance_date" id="echeance_date">

						
					</div>

						<legend for="obs">Observations:</legend>
						<textarea></textarea>
					
						<input type="hidden" name="" id="" value="">
						<input type="submit" valuer="Créer">

				</form>

				<!--<legend for=""></legend>
				<input type="" name="" id="">
				
				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="" name="" id="">

				<legend for=""></legend>
				<input type="submit" valuer="Créer">-->

				

			</article>
			<aside>
			
			</aside>
		</section>
		
		
        
	</body>
</html>
