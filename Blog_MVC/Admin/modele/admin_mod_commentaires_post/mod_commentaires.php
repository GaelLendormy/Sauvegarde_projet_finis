<?php
function mod_commentaires()
{
	global $bdd;
		
		$req = $bdd->prepare('UPDATE commentaires SET pseudo = :pseudo,commentaire = :commentaire 
		WHERE id = :id');
		$req->bindValue('pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$req->bindValue('commentaire',$_POST['commentaire'],PDO::PARAM_STR);
		$req->bindValue('id',$_GET['id'],PDO::PARAM_INT);
		$req->execute();
}

