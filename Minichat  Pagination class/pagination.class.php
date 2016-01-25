<?php
class Pagination
{
	private $total_entry;
	private $max_entry_page;
	private $nb_page;
	private $actual_page;
	private $first_entry;
	
	public function __construct($max_entry_page)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//On compte le nombre de message
		$return_nb_entry = $bdd->query('SELECT COUNT(*) AS total_entree FROM minichat');
		$nb_entry = $return_nb_entry->fetch();
		$total_entry = $nb_entry['total_entree'];

		//On calcul le nombre de page
		$nb_page = ceil($total_entry/$max_entry_page);

		//On definit numéros de la page
		if (isset ($_GET['page']))
		{
				$actual_page = (int)$_GET['page'];
				
				if ($actual_page >= $nb_page)
				{
						$actual_page = $nb_page;

				}
								if ($actual_page <= 0)
						{
							$actual_page = 1;
						}
		}
		else
		{
			$actual_page = 1;	
		}

		//On definit la premiere entree de la page
		$first_entry = ($actual_page - 1)*$max_entry_page;
		
	$this->total_entry = $total_entry;
	$this->max_entry_page = $max_entry_page;
	$this->nb_page = $nb_page;
	$this->actual_page = $actual_page;
	$this->first_entry = $first_entry;

	}
	
	public function setMax_entry_page($new_max)
	{
		$this->max_entry_page = $new_max;
	}
	
	public function getFirst_entry()
	{
		return $this->first_entry;
	}
	
	public function getActual_page()
	{
		return $this->actual_page;
	}
	
	public function getMax_entry_page()
	{
		return $this->max_entry_page;
	}
	
	public function getNb_page()
	{
		return $this->nb_page;
	}	
}
?>






