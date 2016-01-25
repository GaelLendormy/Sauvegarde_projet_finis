<?php
function set_membre($pass_crypt)
{
	global $bdd;
		
		$req = $bdd->prepare('INSERT INTO membres(pseudo,pass,mail,date_inscritpion) 
		VALUES(:pseudo,:pass,:mail,NOW())');
		$req->bindValue('pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$req->bindValue('pass',$pass_crypt,PDO::PARAM_STR);
		$req->bindValue('mail',$_POST['mail'],PDO::PARAM_STR);
		$req->execute();
}

