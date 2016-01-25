<?php
	function get_nb_billets()
	{
		global $bdd;
		
		$req = $bdd->query('SELECT COUNT(*) AS total_billets FROM billets');
		$Total_billets = $req->fetch();
		$total_billets = $Total_billets['total_billets'];
		
		return $total_billets;
		
	}