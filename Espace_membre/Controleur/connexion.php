<?php
if (isset($_POST['pseudo']) AND !empty($_POST['pseudo']) AND isset($_POST['pass']) 
	AND !empty($_POST['pass']))
{
		$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
		$_POST['pass'] = htmlspecialchars($_POST['pass']);
		
		$pass_crypt = sha1($_POST['pass']);
		
		include_once('modele/check_membre.php');
		$resultat = check_membre($_POST['pseudo'], $pass_crypt);
		
		if(!$resultat)
		{
			echo 'Mauvais identifiant ou mot de passe';
		}
		else
		{
			session_start();
			$_SESSION['id'] = $resultat['id'];
			$_SESSION['pseudo'] = $_POST['pseudo'];
			echo 'Vous etes connecté!';
		}
}
else
{
		include_once('vue/connexion.php');
}