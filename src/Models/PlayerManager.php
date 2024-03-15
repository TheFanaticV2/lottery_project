<?php

require_once 'Player.php';

class PlayerManager {
    private $players = [];

    public function loadPlayersFromCSV($csvFile) {
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            // Ignorer la première ligne (en-tête)
            fgetcsv($handle);
    
            // Initialiser un tableau pour compter les occurrences de chaque joueur
            $playerCounts = [];
    
            // Lire chaque ligne du fichier CSV
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Extraire les données de la ligne
                $name = $data[0];
                $numbers = array_slice($data, 1, 7);
                $chanceNumber = $data[8];
    
                // Incrémenter le compteur pour ce joueur
                if (!isset($playerCounts[$name])) {
                    $playerCounts[$name] = 1;
                } else {
                    $playerCounts[$name]++;
                }
    
                // Ignorer les grilles supplémentaires pour les joueurs qui apparaissent plus de 5 fois
                if ($playerCounts[$name] <= 5) {
                    // Créer un objet Player avec les données de la ligne
                    $player = new Player($name, $numbers, $chanceNumber);
                    echo "Player: ".$player->getName() . " Numbers: " . implode(", ", $player->getNumbers()) . " Chance number: " . $player->getChanceNumber() . "\n";
    
                    // Ajouter le joueur à la liste des joueurs
                    $this->players[] = $player;
                }
            }
            echo "\n\n\n";
            fclose($handle);
            return true;
        } else {
            return false; // Erreur lors de l'ouverture du fichier
        }
    }
    

    public function getPlayers() {
        //var_dump($this->players);
        return $this->players;
    }

}

?>
