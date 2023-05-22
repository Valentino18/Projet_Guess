<?php

require '../../vendor/autoload.php';

echo "*** Création d'un jeu de 32 cartes.***\n";
$cardGame = App\Core\CardGame32::factoryCardGame32();

echo " ==== Instanciation du jeu, début de la partie. ==== \n";
$game =  new App\Core\Guess($cardGame, $cardGame->getCard(0), false);

$userCardIndex = readline("Entrez une position de carte dans le jeu : ");

// code naïf, car aucun contrôle de validité de $userCardIndex...
$userCard = $cardGame->getCard($userCardIndex);

if ($game->isMatch($userCard)) {
  echo "Bravo ! \n";
} else {
  echo "Loupé !\n";
}

echo " ==== Fin prématurée de la partie ====\n";
echo "*** Terminé ***\n";