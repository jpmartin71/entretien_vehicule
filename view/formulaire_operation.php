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
					<?php if((isset($_GET['form']) and $_GET['form']=='update_operation') or (isset($_GET['action']) and $_GET['action']=='update_operation'))
					{?>
						<h2>Modification de l'opération</h2>
						<div class="form_operation retour_operation">
							<a href="#">lien à definir</a>
						</div> 
					<?php
					}
					else{?> <h2>Création d'une opération</h2> <?php } ?>
					<fieldset>
						<div class="form_operation <?php if(isset($erreur_view['vehicule']))echo 'erreur';?>">
							<?php if(isset($erreur_view['vehicule']))echo $erreur_view['vehicule'];?>
							<label for="id_vehicule">Véhicule:</label>
							<select name="id_vehicule" id="id_vehicule" >
								<option value='0' selected>Choisir un vehicule</option>
								<?php	foreach($liste_vehicules as $vehicule)
								{?> 
								<option value='<?php echo $vehicule['id'];?>' <?php if ($operation['id_vehicule']==$vehicule['id'])echo 'selected';?>>
									<?php echo $vehicule['libelle'];?>
								</option>
								<?php
								}?>
							</select>
						</div>
						<div class="form_operation <?php if(isset($erreur_view['denomination']))echo 'erreur';?>">
							<?php if(isset($erreur_view['denomination']))echo $erreur_view['denomination'];?>
							<label for="denomination">Dénomination:</label>
							<input type="text" name="denomination" id="denomination" value="<?php echo $operation['denomination'];?>">
						</div>
					</fieldset>
					
					<fieldset>
						<legend>Périodicité</legend>
						<div class="form_operation <?php if(isset($erreur_view['periodicite_km']))echo 'erreur';?>">
							<div class="form_operation">
								<?php if(isset($erreur_view['periodicite_km']))echo $erreur_view['periodicite_km'];?>	
								<label for="periodicite_km">Périodicité (en km)</label>
								<input type="number" name="periodicite_km" id="periodicite_km" value="<?php echo $operation['periodicite_km'];?>" <?php if(isset($_POST['inib_periodicite_km']))echo 'disabled';?>>
							</div>	
							<div class="form_operation">
								<input type="checkbox" onchange="checkbox_inib_periodicite_km()" name="inib_periodicite_km" id="inib_periodicite_km" <?php if(isset($_POST['inib_periodicite_km']))echo 'checked';?> />
								<label for="inib_periodicite_km" class="label_checkbox">Pas de périodicité kilométrique</label>
							</div>
						</div>
						
						<div class="form_operation <?php if(isset($erreur_view['periodicite_tps']))echo 'erreur';?>">
							<?php if(isset($erreur_view['periodicite_tps']))echo $erreur_view['periodicite_tps'];?>		
							<label for="periodicite_tps">Périodicité (en mois)</label>
							<input type="number" name="periodicite_tps" id="periodicite_tps" value="<?php echo $operation['periodicite_tps'];?>" <?php if(isset($_POST['inib_periodicite_tps']))echo 'disabled';?>>
							</br>
							<input type="checkbox" onchange="checkbox_inib_periodicite_tps()" name="inib_periodicite_tps" id="inib_periodicite_tps" <?php if(isset($_POST['inib_periodicite_tps']))echo 'checked';?>/>
							<label for="inib_periodicite_tps" class="label_checkbox">Pas de périodicité temporelle</label>
						</div>
					</fieldset>
						
					<fieldset>
						<legend>Opération effectuée:</legend>
						
							<input type="checkbox" onchange="checkbox_inib_operation_effectuee()" name="inib_effectuee" id="inib_effectuee" <?php if(isset($_POST['inib_effectuee']))echo 'checked';?>/>
							<label for="inib_effectuee" class="label_checkbox">Opération jamais éffectuée.</label>
						
						<div class="form_operation <?php if(isset($erreur_view['effectuee_km']))echo 'erreur';?>">
							<?php if(isset($erreur_view['effectuee_km']))echo $erreur_view['effectuee_km'];?>
							<label for="effectuee_km">Effectué à (en km):</label>
							<input type="number" name="effectuee_km" id="effectuee_km" value="<?php echo $operation['effectuee_km'];?>" <?php if(isset($_POST['inib_effectuee']))echo 'disabled';?>>
						</div>
						
						<div class="form_operation <?php if(isset($erreur_view['effectuee_date']))echo 'erreur';?>">
							<?php if(isset($erreur_view['effectuee_date']))echo $erreur_view['effectuee_date'];?>
							<label for="effectuee_date">Effectué le (jj/mm/aaaa):</label>
							<input type="date" name="effectuee_date" id="effectuee_date" value="<?php if($operation['effectuee_date']!=null)echo date_create($operation['effectuee_date'])->format('Y-m-d');?>" <?php if(isset($_POST['inib_effectuee']))echo 'disabled';?>>
							</br>
						</div>
							
					</fieldset>
						
					<fieldset>
						<legend>Prochaine écheance:</legend>
						<div class="form_operation">
							<label for="echeance_km">Prochaine échéance (km)</label>
							<input type="number" name="echeance_km" id="echeance_km" value="<?php echo $operation['echeance_km'];?>"  disabled>
						</div>
						<div class="form_operation">
							<label for="echeance_date">Prochaine échéance (date)</label>
							<input type="date" name="echeance_date" id="echeance_date" value="<?php if($operation['echeance_date']!=null)echo date_create($operation['echeance_date'])->format('Y-m-d');?>"  disabled>
						</div>
					</fieldset>
					<fieldset>
						<legend>Observations:</legend>
						<textarea name="obs" id="obs" ><?php echo $operation['obs'];?></textarea>
					</fieldset>
					<div class="form_operation">
						<input type="hidden" name="" id="" value="">
						<input type="submit" value="Créer">
						<input type="reset" value="Reset"
					</div>
				</form>
			</article>
			<aside>
			
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
