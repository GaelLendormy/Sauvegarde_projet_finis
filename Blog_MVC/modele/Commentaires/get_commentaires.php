<?php
function get_commentaires($offset,$limit,$id)
	{
		global $bdd;
		$offset = (int) $offset;
		$limit = (int) $limit;
		$id = (int) $id;
		
		$req = $bdd->prepare('SELECT id, id_billet, pseudo, commentaire, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\')
		as date_creation_fr FROM commentaires WHERE id_billet = :id ORDER BY id DESC LIMIT :offset, :limit');
		$req->bindParam(':offset' , $offset, PDO::PARAM_INT);
		$req->bindParam(':limit' , $limit, PDO::PARAM_INT);
		$req->bindParam(':id' , $id, PDO::PARAM_INT);
		$req->execute();
		$commentaires = $req->fetchAll();
		
		return $commentaires;
	}