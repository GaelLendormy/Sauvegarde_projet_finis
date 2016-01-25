<?php
//On se connecte a la bdd et on efface l'affichage d'erreur
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 

	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}