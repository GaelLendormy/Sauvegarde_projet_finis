<?php
include_once ('modele/admin_mod_commentaires_post/mod_commentaires.php');
//On remplit la bdd avec le pseudo et le message envoyé, on utilise des requetes préparés
	if (isset ($_POST['pseudo']) && isset($_POST['commentaire']) && !empty($_POST['pseudo']) && !empty($_POST['commentaire'])) 
	{
		mod_commentaires();
	}		

//Nous renvoie vers le minichat
header('location:admin_mod_commentaires.php?id= ' . htmlspecialchars($_GET['id']));
