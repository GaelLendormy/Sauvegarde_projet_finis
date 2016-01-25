<?php
include_once('modele/admin_mod_billet_post/mod_billet.php');

//On remplit la bdd avec le pseudo et le message envoyé, on utilise des requetes préparés
	if (isset ($_POST['titre']) && isset($_POST['contenu']) && !empty($_POST['titre']) && !empty($_POST['contenu'])) 
	{
		mod_billet();
	}		

//Nous renvoie vers le minichat
header('location:admin.php');