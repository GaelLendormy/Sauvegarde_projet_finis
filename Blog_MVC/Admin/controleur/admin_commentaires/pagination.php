<?php
	//On affiche le bouton précedent
		if ($actual_page != 1)
		{
			echo '<a href="admin_commentaires.php?id= ' . htmlspecialchars($_GET['id']) . '&page= ' . ($actual_page - 1) . '"> Préc </a>';
		}

		//On affiche les numeros de page
		for($numero_page = 1; $numero_page <= $nb_page; $numero_page ++ )
		{
			if($numero_page == $actual_page)
			{
				echo '[' . $numero_page . ']';
			}
			
			else
			{
				echo '<a href="admin_commentaires.php?id= ' . htmlspecialchars($_GET['id']) . '&page=' . $numero_page . '"> ' . $numero_page . ' </a>';
			}
		}	

		//On affiche le bouton suivant 
		if ($actual_page != $nb_page)
		 {
				echo '<a href="admin_commentaires.php?id= ' . htmlspecialchars($_GET['id']) . '&page=' . ($actual_page + 1) . '"> Suiv </a></br>';
		 }
		?>
				
		
		<!-- On crée un bouton pour actualiser la page -->
		<p>
			<a href="admin_commentaires.php?id=<?php echo htmlspecialchars($_GET['id']) ?>">Actualiser</a>
			<a href="admin.php">Retour</a>
		</p>
		