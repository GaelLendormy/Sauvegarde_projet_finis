<?php
function set_billet()
{
	global $bdd;
	
	$req = $bdd->prepare('INSERT INTO billets(titre,contenu,date_creation)
	VALUES (:titre, :contenu, NOW())');
	$req->bindValue('titre',$_POST['titre'],PDO::PARAM_STR);
	$req->bindValue('contenu',$_POST['contenu'],PDO::PARAM_STR);
	$req->execute();
	
}