<?php

if (isset($_POST['pseudo']) AND isset($_POST['pass']) AND isset($_POST['pass2']) AND 
isset($_POST['mail']) AND !empty($_POST['pseudo']) AND !empty($_POST['pass']) AND !empty($_POST['pass2']) AND 
!empty($_POST['mail']))
{
	$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
	$_POST['pass'] = htmlspecialchars($_POST['pass']);
	$_POST['pass2'] = htmlspecialchars($_POST['pass2']);
	$_POST['mail'] = htmlspecialchars($_POST['mail']);

	if ($_POST['pass'] == $_POST['pass2'])
		{
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
				{
					include_once('modele/check_pseudo.php');
					
					$resultat = check_pseudo($_POST['pseudo']);
					
					if (!$resultat)
						{
							$pass_crypt = sha1($_POST['pass']);
							include_once('modele/set_membre.php');
							set_membre($pass_crypt);
							echo "Vous etes bien enregistré!! Bienvenue!!";
						}
						
					else
						{
						echo "Le pseudo existe deja";
						}
				}
			else
				{
					echo "l'adresse mail est invalide";
				}	




		}
	else
		{
			echo "Les mots de passes saisies sont différents";
		}

}
else
{
	include_once('vue/inscription.php');	
}
