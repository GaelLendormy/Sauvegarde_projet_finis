<?php
function set_commentaires()
{
	global $bdd;
		
		$req = $bdd->prepare('INSERT INTO commentaires(pseudo,commentaire,id_billet,date_creation) 
		VALUES(:pseudo,:commentaire,:id_billet,NOW())');
		$req->bindValue('pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$req->bindValue('commentaire',$_POST['message'],PDO::PARAM_STR);
		$req->bindValue('id_billet',$_GET['id_billet'],PDO::PARAM_STR);
		$req->execute();
}

