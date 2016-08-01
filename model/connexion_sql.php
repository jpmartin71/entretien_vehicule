<?php
	
	/*if(isset($_SESSION['admin'])AND $_SESSION['admin']==true)
	{
		$loginSql='webmaster';
		$passwordSql='webmaster';
	}
	else
	{
		$loginSql='client';
		$passwordSql='client';
	}*/
	$loginSql='vehicule';
	$passwordSql='vehicule';
	try
	{
		$servername='localhost';
		$dbname='entretien_vehicules';
		$bdd=new PDO(	"mysql:host=$servername;
						dbname=$dbname;
						charset=utf8",
						$loginSql,$passwordSql,
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		//echo $loginSql;
	}
	catch (Exception $e)
	{
		die('Erreur:'.$e->getMessage());
	}
