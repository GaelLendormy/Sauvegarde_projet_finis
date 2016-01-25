<?php
function get_commentaire($id)
	{
		global $bdd;
		
		$id = (int) $id;
		
		$req = $bdd->prepare('SELECT id, id_billet, pseudo, commentaire, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\')
		as date_creation_fr FROM commentaires WHERE id = :id');
		$req->bindParam(':id' , $id, PDO::PARAM_INT);
		$req->execute();
		$commentaire = $req->fetchAll();
		
		return $commentaire;
	}