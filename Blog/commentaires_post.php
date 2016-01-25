<?php
//On se connecte à la bdd et on enleve l'affichage des erreurs
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
?>

<?php
//On remplit la bdd avec le pseudo et le message envoyé, on utilise des requetes préparés
	if (isset ($_POST['pseudo']) && isset($_POST['message']) && !empty ($_POST['pseudo']) && !empty($_POST['message'])) 
	{
		$req = $bdd->prepare('INSERT INTO commentaires(pseudo,commentaire,id_billet,date_creation) 
		VALUES(:pseudo,:commentaire,:id_billet,NOW())');
		$req->bindValue('pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$req->bindValue('commentaire',$_POST['message'],PDO::PARAM_STR);
		$req->bindValue('id_billet',$_GET['id_billet'],PDO::PARAM_STR);
		$req->execute();
	}		
?>

<?php
//Nous renvoie vers le minichat
header('location:commentaires.php?id= ' . htmlspecialchars($_GET['id_billet']));
?>