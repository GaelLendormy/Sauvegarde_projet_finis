<?php
function check_pseudo($pseudo)
	{
		global $bdd;
		
		$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo');
		$req->bindValue('pseudo',$pseudo,PDO::PARAM_STR);
		$req-> execute();
		$resultat = $req->fetch();
		
		
		return $resultat;
	}