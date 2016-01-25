<?php
$id = htmlspecialchars($_GET['id']);
include_once('modele/admin_mod_billet/get_billet.php');

$billet = get_billet($id);

if(empty ($billet))
{
	echo "Le billet n'existe pas!";
}
else
{
foreach($billet as $cle => $Billet)
{
	$billet[$cle]['titre'] = htmlspecialchars($Billet['titre']);
	$billet[$cle]['contenu'] = htmlspecialchars($Billet['contenu']);
}

include_once('vue/admin_mod_billet/admin_mod_billet.php');
}