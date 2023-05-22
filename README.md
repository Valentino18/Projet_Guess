**Rapport Projet GuessWhat**

**Mon matériel :**

- MacBook pro M1 2020
- PHP 8.0
- GIT 2.33

**Requis :**

- [Composer](https://getcomposer.org/download/)
- [PHPUnit](https://github.com/sebastianbergmann/phpunit)
- [GuessWhat](https://gitlab.com/okpu/guesswhat)

**Installation de Composer &amp; PHPUnit :**

Composer : 

Pour commencer nous allons télécharger Composer lien dans la catégorie « Requis », installer la dernière version, 2.16 est la dernière version a l’heure actuelle.
Ouvrer le terminal et aller à l’endroit où il a été télécharger pour se repérer dans l’arborescence vous pouvez effectuer la commande LS
Donc pour ma part il se trouve dans Downloads donc j’ai simplement fait :

`
ls
cd downloads
`

Puis effectuer cette simple commande :
sudo mv composer.phar /usr/local/bin/composer

Il va donc déplacer composer.phar dans /usr/local/bin/composer …. Il va tout simplement s’ajouter au Pattern Environnement

Normalement après cela il suffira de taper sur le terminal composer pour qu’il s’exécute.



PHPUnit :

Nous allons commencer par télécharger le projet GuessWord disponible dans les requis mais pour faire cela nous allons utiliser GIT.

Sur mon terminal je vais me déplacer dans mes documents pour ma part là où il y a mes cours.

`
ls
cd .. (car j’étais dans Downloads)
cd Documents
ls
cd Cours
ls
cd Symfony
git clone https://gitlab.com/okpu/guesswhat
`

Donc là nous venons de cloner le projet et nous allons y accéder :

cd guesswhat

il vous suffira maintenant de faire cela :

composer install

Si vous rencontrer des problèmes vous devez faire cela :

composer update

PHPUnit est maintenant installé ici /bin/phpunit

Pour effectuer un test via phpunit rien de plus simple 

./bin/phpunit
Vous avez donc normalement des erreurs dans le code nous allons les résoudre maintenant.

Résolution des erreurs test PHPUnit :

Il y a actuellement 4 tests qui ont une erreur.

Ouvrons le fichier test PHPUnit nommé « CardTest.php » accessible dans « tests/Core/CardTest.php » 

Attaquons-nous au premier problème qui se situe dans la fonction testCompareSameNameNoSameColor()

Donc enlevons :

`
$this->fail(“not implemented !”);
`

Et copions ce qu’il y a ecrit en haut car c’est a peu près le même test :

`
$card1 = new Card('As', 'Trèfle');
$card2 = new Card('As', 'Trèfle');
$this->assertEquals(0, CardGame32::compare($card1,$card2));
`

Sauf qu’il faut remplace la couleur car nous souhaitons faire un test sur le faite qu’elle soit pas de la même couleur

Donc modifions Trèfle par Pique pourquoi pas, et dernier petite truc a modifié vue que Pique est au-dessus de Trèfle il faudra mettre +1 au lieu de 0 qui correspond à égalité :

`
$card1 = new Card('As', 'Pique');
$card2 = new Card('As', 'Trèfle');
$this->assertEquals(+1, CardGame32::compare($card1,$card2));
`

Voilà la fonction est maintenant fini mais cela ne fonctionne toujours pas car CardGame32.php n’est pas modifié de faite que ce test fonctionne.

Dans un premier temps il faut définir un tableau qui définira qui est plus fort que qui ? (trèfle plus fort que pique ?)

Donc voici le tableau que j’ai choisi de définir j’ai donc associé les valeurs a 1,2,3,4

`
$TAB_COLOR = ["trèfle" => 1, "pique" => 2, "carreau" => 3, 
"coeur" => 4];
`

Puis maintenant nous allons définir via la fonction IF si la couleur est supérieure alors nous faisons cela.

Commençons par rajouter une petit variable qui va appeler la fonction getColor() et la transformé en minuscule.

    $c1Color = strtolower($c1->getColor());
    $c2Color = strtolower($c2->getColor());

Puis maintenant implémentons le test :

`
  if ($c1Name ===  $c2Name]) {
      if($TAB_COLOR[$c1Color] === $TAB_COLOR[$c2Color]) {
        return 0;
      }
      return ($TAB_COLOR[$c1Color] > $TAB_COLOR[$c2Color]) ? +1 : -1;  // Alors +1 Sinon -1
    }
        return ($c1Name > $c2Name) ? +1 : -1;
  }
`

Il vous reste plus qu’à tester 

./bin/phpunit

Et il affichera qu’il reste plus que 3 erreurs à corriger maintenant que c’est à peu près compris comment faire je vais juste montré toute les modifications que j’ai effectué pour n’avoir plus aucune erreurs.

CardTest.php :
```
  public function testCompareSameNameNoSameColor()
  {
    $card1 = new Card('As', 'Pique');
    $card2 = new Card('As', 'Trèfle');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }

  public function testCompareNoSameCardNoSameColor()
  {
    $card1 = new Card('As', 'Pique');
    $card2 = new Card('Roi', 'Trèfle');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }

  public function testCompareNoSameCardSameColor()
  {
    $card1 = new Card('As', 'Coeur');
    $card2 = new Card('Roi', 'Coeur');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));
  }

  public function testToString()
  {
    $card1 = new Card('As', 'Coeur');
    $card2 = new Card('As', 'Coeur');
    $this->assertEquals(0, CardGame32::compare($card1,$card2));
  }
```

CardGame32.php :

    // TABLEAU
    $TAB_COLOR = ["trèfle" => 1, "pique" => 2, "carreau" => 3, "coeur" => 4];
    $TAB_NAME = ["as" => 14, "roi" => 13, "dame" => 12, "valet" => 11, "10" => 10, "9" => 9, "8" => 8, "7" => 7];

    $c1Name = strtolower($c1->getName());
    $c2Name = strtolower($c2->getName());
    $c1Color = strtolower($c1->getColor());
    $c2Color = strtolower($c2->getColor());

    if ($TAB_NAME[$c1Name] === $TAB_NAME[$c2Name]) {
      if($TAB_COLOR[$c1Color] === $TAB_COLOR[$c2Color]) {
        return 0;
      }
      return ($TAB_COLOR[$c1Color] > $TAB_COLOR[$c2Color]) ? +1 : -1;  // Alors +1 Sinon -1
    }
    
    return ($TAB_NAME[$c1Name] > $TAB_NAME[$c2Name] ) ? +1 : -1; // Alors +1 Sinon -1

  }

Card.php :

`
  public function __toString() : string
  {
    $allValeur = $this->name. " ". $this->color;
    return $allValeur;
  }
`

Donc voilà une fois toute ces modifications effectuer plus qu’à faire le test final dans le terminal :

./bin/phpunit

Et vous devriez obtenir cela :

```
PHPUnit 7.5.20 by Sebastian Bergmann and contributors.

Testing Project Test Suite
........                                                            8 / 8 (100%)

Time: 124 ms, Memory: 6.00 MB

OK (8 tests, 10 assertions)

```

Cela signifie que vous venez de finir le challenge 2 

En d’autres termes j’ai donc fini le challenge 2 et je pense avoir expliquer un peu tout ce que j’ai dû effectuer et ce que j’ai dû subir pour réussir, j’ai bien sur passer les heures d’erreur que j’ai obtenu avec mes problèmes de PHP pas à jours, Composer qui ne fonctionne pas…

Mais tout fini bien et c’est le principale .

Enzo Carpentier
