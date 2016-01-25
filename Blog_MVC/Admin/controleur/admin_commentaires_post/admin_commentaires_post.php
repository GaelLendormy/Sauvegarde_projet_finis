<?php
include_once ('modele/admin_commentaires_post/set_commentaires.php');
//On remplit la bdd avec le pseudo et le message envoyé, on utilise des requetes préparés
	if (isset ($_POST['pseudo']) && isset($_POST['message']) && !empty($_POST['pseudo']) && !empty($_POST['message'])) 
	{
		set_commentaires();
	}		

//Nous renvoie vers le minichat
header('location:admin_commentaires.php?id= ' . htmlspecialchars($_GET['id_billet']));
