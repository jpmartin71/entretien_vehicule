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
						<fieldset>
							<label for="id_vehicule">Véhicule:</label>
							<select name="id_vehicule" id="id_vehicule">
								<?php
									foreach($liste_vehicules as $vehicule)?> <option value='<?php echo $vehicule['id'];?>'><?php echo $vehicule['libelle'];?></option>
							</select>
							</br>
							
							<label for="denomination">Dénomination:</label>
							<input type="text" name="denomination" id="denomination" value="<?php echo $operation['denomination'];?>">
						</fieldset>
						
						<fieldset>
							<legend>Périodicité</legend>
							
							<label for="periodicite_km">Périodicité (en km)</label>
							<input type="number" name="periodicite_km" id="periodicite_km" value="<?php echo $operation['periodicite_km'];?>" <?php if(isset($_POST['inib_periodicite_km']))echo 'disabled';?>>
							</br>
							<input type="checkbox" onchange="checkbox_inib_periodicite_km()" name="inib_periodicite_km" id="inib_periodicite_km" <?php if(isset($_POST['inib_periodicite_km']))echo 'checked';?> />
							<label for="inib_periodicite_km" class="label_checkbox">Pas de périodicité kilométrique</label>
							</br>
							
							<label for="periodicite_tps">Périodicité (en mois)</label>
							<input type="number" name="periodicite_tps" id="periodicite_tps" value="<?php echo $operation['periodicite_tps'];?>" <?php if(isset($_POST['inib_periodicite_tps']))echo 'disabled';?>>
							</br>
							<input type="checkbox" onchange="checkbox_inib_periodicite_tps()" name="inib_periodicite_tps" id="inib_periodicite_tps" <?php if(isset($_POST['inib_periodicite_tps']))echo 'checked';?>/>
							<label for="inib_periodicite_tps" class="label_checkbox">Pas de périodicité temporelle</label>
						</fieldset>
						
					</div>
					<div class="form_operation">
						<fieldset>
							<legend>Opération effectuée:</legend>
							
							<input type="checkbox" onchange="checkbox_inib_operation_effectuee()" name="inib_effectuee" id="inib_effectuee" <?php if(isset($_POST['inib_effectuee']))echo 'checked';?>/>
							<label for="inib_effectuee" class="label_checkbox">Opération jamais éffectuée.</label>
							</br>
							
							<label for="effectuee_km">Effectué à (en km):</label>
							<input type="number" name="effectuee_km" id="effectuee_km" value="<?php echo $operation['effectuee_km'];?>" <?php if(isset($_POST['inib_effectuee']))echo 'disabled';?>>
							</br>
							
							<label for="effectuee_date">Effectué le (jj/mm/aaaa):</label>
							<input type="date" name="effectuee_date" id="effectuee_date" value="<?php echo date_create($operation['effectuee_date'])->format('d/m/Y');?>" <?php if(isset($_POST['inib_effectuee']))echo 'disabled';?>>
							</br>
							
							
						</fieldset>
						
						<fieldset>
							<legend>Prochaine écheance:</legend>
							
							<label for="echeance_km">Prochaine échéance (km)</label>
							<input type="number" name="echeance_km" id="echeance_km" value="<?php echo $operation['echeance_km'];?>"  disabled>
							</br>
							
							<label for="echeance_date">Prochaine échéance (date)</label>
							<input type="date" name="echeance_date" id="echeance_date" value="<?php echo $operation['echeance_date'];?>"  disabled>
						</fieldset>
							
							
						
					</div>

						<label for="obs">Observations:</label>
						<textarea name="obs" id="obs" ><?php echo $operation['obs'];?></textarea>
					
						<input type="hidden" name="" id="" value="">
						<input type="submit" valuer="Créer">

				</form>
			<!--</article>
			<aside>-->
			
			</aside>
		</section>
		
		
        <script type="text/javascript">
		function checkbox_inib_periodicite_km()
		{ 
			if(document.getElementById("inib_periodicite_km").checked)document.getElementById("periodicite_km").disabled = true;
			else document.getElementById("periodicite_km").disabled = false;
		}
        	function checkbox_inib_periodicite_tps()
		{ 
			if(document.getElementById("inib_periodicite_tps").checked)document.getElementById("periodicite_tps").disabled = true;
			else document.getElementById("periodicite_tps").disabled = false;
		}
		function checkbox_inib_operation_effectuee()
		{ 
			if(document.getElementById("inib_effectuee").checked)
			{
				document.getElementById("effectuee_km").disabled = true;
				document.getElementById("effectuee_date").disabled = true;
			}
			else 
			{
				document.getElementById("effectuee_km").disabled = false;
				document.getElementById("effectuee_date").disabled = false;
			}
		}
        

    </script>
	</body>
</html>
