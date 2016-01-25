<?php
function check_membre($pseudo,$pass)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND pass = :pass');
	$req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
	$req->bindValue('pass', $pass, PDO::PARAM_STR);
	$req->execute();
	
	$resultat = $req->fetch();
	
	return $resultat;
}
