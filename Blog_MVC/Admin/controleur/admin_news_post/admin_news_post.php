<?php
include_once('modele/admin_news_post/set_billet.php');

//On remplit la bdd avec le pseudo et le message envoyé, on utilise des requetes préparés
	if (isset ($_POST['titre']) && isset($_POST['contenu']) && !empty($_POST['titre']) && !empty($_POST['contenu'])) 
	{
		set_billet();
	}		

//Nous renvoie vers le minichat
header('location:admin_news.php');