	<?php
			//On affiche le bouton précedent
		if ($actual_page != 1)
		{
			echo '<a href="admin.php?page=' . ($actual_page - 1) . '"> Préc </a>';
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
				echo '<a href="admin.php?page=' . $numero_page . '"> ' . $numero_page . ' </a>';
			}
		}	

		//On affiche le bouton suivant 
		if ($actual_page != $nb_page)
		 {
				echo '<a href="admin.php?page=' . ($actual_page + 1) . '"> Suiv </a></br>';
		 }
		?>
				
		<!-- On affiche un formulaire pour choisir sa page -->
		<form action="admin.php" method="get">
			<label for="page">Page</label> : <input type="number" min="1" name="page" id="page">
		</form></br>
		
		<!-- On crée un bouton pour actualiser la page -->
		<p>
			<a href="admin.php">Actualiser</a>
		</p>