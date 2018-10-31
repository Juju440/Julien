<html>

    <head>

        <meta charset="utf-8" />

        <title>Affichage de tous les adhérents</title>

    </head>
<body>
<?php
$base = new GestionBaseLivres($db);
$adherents=$base->afficherTousAdherents();
echo '</br>';
echo '<center><h3> affichage de tous les adherents </h3>';
echo '</br>';
?>
<table cellpadding="10" cellspacing="1" border="2">
	<tr>
      <th align="center">Prénom</th>
      <th align="center">Nom</th>
      <th align="center">numéro</th>
   </tr>
<?
foreach($adherents as $adh) //parcours la collection d'adhérents
	{
	?>
	<tr>
		<td align="center">
			<?
				echo $adh->getPrenom();//affiche le prénom des adhérents 
			?>
		</td>
		<td align="center">
			<?
				echo $adh->getNom();//affiche le nom des adhérents 	
			?>
		</td>
		<td align="center">
			<?
				echo $adh->getNum();//affiche le numéro des adhérents 
			?>
		</td>
	</tr>
	<?
	}
?>
</table>
</center>
</body>
</html>