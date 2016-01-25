<?php
function get_billets($offset,$limit)
	{
		global $bdd;
		$offset = (int) $offset;
		$limit = (int) $limit;
		
		$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\')
		as date_creation_fr FROM billets ORDER BY id DESC LIMIT :offset, :limit');
		$req->bindParam(':offset' , $offset, PDO::PARAM_INT);
		$req->bindParam(':limit' , $limit, PDO::PARAM_INT);
		$req->execute();
		$billets = $req->fetchAll();
		
		return $billets;
	}