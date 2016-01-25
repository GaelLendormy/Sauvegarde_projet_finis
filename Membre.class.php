<?php
class Membre
{
	private $pseudo;
	private $email;
	private $signature;
	private $actif;
	
	public function __construct($idMembre)
	
	public function getPseudo()
	{
		//ici $this est utilisé pour indiquer que il s'agit du pseudo de cet objet
		return $this->pseudo;
	}
	
	public function setPseudo($nouveauPseudo)
	{
		//Si le pseudo n'est pas vide et inférieur à 15 caractère le changer
		if (!empty ($nouveauPseudo) AND strlen($nouveauPseudo) <15)
		{
				$this->pseudo = $nouveauPseudo;
		}
	}
	
	public function envoyerEmail($titre, $message)
	{
		mail($this-> email, $titre, $message);
	}
	
	public function bannir()
	{
		$this->actif = false;
		$this->envoyerEmail('Vous avez été banni', 'Ne revenez plus!!!');
	}
}
/*	Comme cet page ne contient que du php on peut ne pas ecrire la balise de fermeture
	ce qui peut eviter certaine erreur */