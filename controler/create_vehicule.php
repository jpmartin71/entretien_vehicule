<?php 

	if(isset($_POST['modele']) and !empty($_POST['modele']))
	{
		if(!isset($_POST['date_1_immat']) or empty($_POST['date_1_immat']))
		{
			$_POST['date_1_immat']='2000-01-01';
		}
		if(!isset($_POST['date_achat']) or empty($_POST['date_achat']))
		{
			$_POST['date_achat']='2000-01-01';
		}
		if(!isset($_POST['possession']) or empty($_POST['possession']))
		{
			$_POST['possession']=0;
		}
		else if($_POST['possession']='on')
		{
			$_POST['possession']=1;
		}

		set_new_vehicule($_POST);

		echo '$_POST:'; print_r($_POST); echo '</br>';

		header('location:?no_erreur=create_vehicule');
	}
	else
	{
		header('location:./?form=create_vehicule&erreur=modele');
	}
