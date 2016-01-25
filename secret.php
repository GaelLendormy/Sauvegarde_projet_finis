<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Ceci est une page de test de mot de passe</title>
	</head>
	
	<body>
		
		<?php
		
		//Si le mot de passe existe et est le bon montrer le code caché
			if (isset($_POST['mdp']) AND $_POST['mdp'] =="kangourou")
				{
					echo "Le code d'accès est : </br> <strong>N2SZAAVF</strong>";
				}
				
		/*Si le mot de passe existe mais n'est pas bon afficher un message d'erreur 
		et redemander le mot de passse */
			elseif (isset($_POST['mdp']) AND $_POST['mdp'] !="kangourou") 
				{
		?>	
			<p>
				ERREUR </br> <strong>Veuillez entrer le bon mot de passe</strong>
			</p>
			
			<p>
				Veuillez entrer le mot de passe:
			</p>

			<form action="secret.php" method="post" >
				<p>
					<input type="password" name="mdp" />
					<input type="submit" value="Valider" />
				</p>
			</form>			
		<?php
				}
				
		//Sinon (le mot de passe n'existe pas) demander le mot de passe	
			else	
				{
		?>		
				 <p>
					Veuillez entrer le mot de passe:
				</p>

				<form action="secret.php" method="post" >
					<p>
						<input type="password" name="mdp" />
						<input type="submit" value="Valider" />
					</p>
				</form>
		<?php		
				}
		?>		
	
	</body>
</html>