<?php

class Adherent

{
	private $_num;
	private $_nom;
	private $_prenom;
	
public function __construct($donnees) // Constructeur demandant 2 paramËtres

  {
   $this->hydrate2($donnees); //le constructeur appelle la fonction d'hydratation qui va initialiser les attributs avec les valeurs de la base
  }     
 	
 public function hydrate(array $donnees) //va hydrater l'objet adherent avec les bonnes valeurs des attributs

  {
	$num=(int) $donnees['num'];
    $this->setNum($num);
    $this->setNom($donnees['nom']);
	$this->setPrenom($donnees['prenom']);
  }
  
 public function hydrate2(array $donnees) // permet de gÈrer une modification des attributs de l'objet sans changer la m√©thode d'hydratation

{
  foreach ($donnees as $key => $value) //recupËre chaque cellule du tableau
  {
    $method = 'set'.ucfirst($key);//positionne la bonne mÈthode, avec une majuscule ‡ la premiËre lettre 
    if (method_exists($this, $method))
    {
      $this->$method($value);//appelle la bonne mÈthode setter
    }
  }
}
  
  public function setNum($num)
  {
  	$num=(int) $num;
  	if ($num>=0)
  		{
  			$this->_num=$num;
  		}
  	else
  	{
  		echo 'erreur sur la cle';
  	}
	
	
  }
  public function setNom($nom)
  {
  	if (is_string($nom))
  		{
  			$this->_nom=$nom;
  		}
  	else
  		{
  			echo 'erreur sur le nom';
  		}
  }
  
public function setPrenom($prenom)
  {
  	$this->_prenom=$prenom;
  }
  
public function getNum()
	{
		return $this->_num;
	}   
	
public function getNOm()
	{
		return $this->_nom;
	}   
	
public function getPrenom()
	{
		return $this->_prenom;
	}   
  
}	

class GestionBaseLivres

{

  private $_Mabase; // Instance de la base de donn√©es


  public function __construct($Mabase) //constructeur de la classe

  {
    $this->setDb($Mabase);
  }
  
  
  public function setDb(PDO $Mabase) //setter de l'attribut base
  {
    $this->_db = $Mabase;
  }
  
  public function getAdherent($num)
  {
    $num = (int) $num;

    $q = $this->_db->query('SELECT num, nom, prenom FROM adherent WHERE num = '.$num);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Adherent($donnees);
  }

public function afficherTousAdherents()
  {
   $adherents = [];

    $q = $this->_db->query('SELECT num, nom, prenom FROM adherent order by nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $adherents[] = new Adherent($donnees);
    }

    return $adherents;//retourne la collection de tous les adherents de la base
  }
}


try
{
$db = new PDO('mysql:host=localhost;dbname=biblio2016','test' ,'' );
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
print("connexion base biblio OK</br>");
$base = new GestionBaseLivres($db);
$adherent=$base->getAdherent(1);
echo $adherent->getNum();
echo '</br>';
echo $adherent->getNom();
echo '</br>';
echo $adherent->getPrenom();
$adherents=$base->afficherTousAdherents();
$nb=sizeof($adherents);
echo '</br>';
foreach($adherents as $adh) //parcours la collection d'adh√©rents
	{
		echo $adh->getPrenom();//affiche le pr√©nom des adh√©rents un par un
		echo '</br>';
	}
