<?php
function mod_billet()
{
	global $bdd;
	
	$req = $bdd->prepare('UPDATE billets SET titre = :titre, contenu = :contenu WHERE id = :id');
	$req->bindValue('titre',$_POST['titre'],PDO::PARAM_STR);
	$req->bindValue('contenu',$_POST['contenu'],PDO::PARAM_STR);
	$req->bindValue('id',$_GET['id'],PDO::PARAM_INT);
	$req->execute();
	
}