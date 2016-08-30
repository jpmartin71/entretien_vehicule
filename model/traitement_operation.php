<?php

function get_operations()
{
	global $bdd;
	$req=$bdd->query('SELECT op.*, v.modele, v.marque
						FROM operations as op 
						LEFT JOIN vehicules as v 
						ON op.id_vehicule=v.id
						ORDER BY v.modele');
	
	$operations=$req->fetchall();
	$req->closecursor();
	return $operations;
}