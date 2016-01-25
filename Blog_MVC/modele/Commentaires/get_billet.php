<?php
function get_billet($id)
	{
		global $bdd;
		$id = (int) $id;
		
		$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\')
		as date_creation_fr FROM billets WHERE id= :id ');
		$req->bindParam(':id' , $id, PDO::PARAM_INT);
		$req->execute();
		$billets = $req->fetchAll();
		
		return $billets;
	}