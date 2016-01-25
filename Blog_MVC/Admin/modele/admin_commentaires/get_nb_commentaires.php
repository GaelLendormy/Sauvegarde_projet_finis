<?php
	function get_nb_commentaires($id)
	{
		global $bdd;
		$id = (int) $id;

		$req = $bdd->prepare('SELECT COUNT(*) AS total_entree FROM commentaires 
		WHERE id_billet = :id');
		$req->bindValue('id',$id,PDO::PARAM_INT);
		$req->execute();
		$Total_entry = $req->fetch();
		$total_entry = $Total_entry['total_entree'];

		return $total_entry;
	}