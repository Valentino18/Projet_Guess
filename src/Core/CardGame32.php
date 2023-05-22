<?php

namespace App\Core;

/**
 * Class CardGame32 : un jeu de cartes.
 * @package App\Core
 */
class CardGame32
{

  /**
   * @var $cards array a array of Cards
   */
  
  /**
   * Guess constructor.
   * @param array $cards
   */
  public function __construct(array $cards)
  {
    $this->cards = $cards;
  }

  /**
   * Brasse le jeu de cartes
   */
  public function shuffle()
  {
    // TODO (voir les fonctions sur les tableaux)
  }

  // TODO ajouter une méthode reOrder qui remet le paquet en ordre

  /** définir une relation d'ordre entre instance de Card.
   * à valeur égale (name) c'est l'ordre de la couleur qui prime
   * coeur > carreau > pique > trèfle
   * Attention : si AS de Coeur est plus fort que AS de Trèfle,
   * 2 de Coeur sera cependant plus faible que 3 de Trèfle
   *
   *  Remarque : cette méthode n'est pas de portée d'instance (static)
   *
   * @see https://www.php.net/manual/fr/function.usort.php
   *
   * @param $c1 Card
   * @param $c2 Card
   * @return int
   * <ul>
   *  <li> zéro si $c1 et $c2 sont considérés comme égaux </li>
   *  <li> -1 si $c1 est considéré inférieur à $c2</li>
   * <li> +1 si $c1 est considéré supérieur à $c2</li>
   * </ul>
   *
   */
  public static function compare(Card $c1, Card $c2) : int
  {
    // TODO code aïf, et de plus il faudra prendre en compte la couleur !

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


 // TODO manque PHPDoc
  public static function factoryCardGame32() : CardGame32 {
     // TODO création d'un jeu de 32 cartes
    $cardGame = new CardGame32([new Card('As', 'Trèfle'), new Card('2', 'Trèfle')]);

    return $cardGame;
  }

  // TODO manque PHPDoc
  public function getCard($index) : Card {
    // TODO naïf
    return  $this->cards[$index];
  }

}

