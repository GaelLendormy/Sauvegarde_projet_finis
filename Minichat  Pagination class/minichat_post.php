<?php
//si le cookie pseudo n'est pas vide remplacer par le post pseudo
if (!empty ($_POST['pseudo']))
{
	setcookie('pseudo',$_POST['pseudo'],time()+365*24*3600,null,null,false,true );
}
?>

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
		echo "value:" . $_POST['pseudo'];
		$req = $bdd->prepare('INSERT INTO minichat(pseudo,message) 
		VALUES(:pseudo,:message)');
		$req->execute(array(
		'pseudo' => $_POST['pseudo'],
		'message' => $_POST['message'],
		));
	}		
?>

<?php
//Nous renvoie vers le minichat
header('location:minichat.php');
?>
