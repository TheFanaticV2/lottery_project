<?php

require_once 'Player.php'; 

class Lottery {
    public function drawWinningNumbers() {
        $winningNumbers = [];
    
        // Générer les 6 premiers numéros gagnants
        while (count($winningNumbers) < 6) {
            $randomNumber = strval(rand(1, 49)); // Convertir en chaîne de caractères
            if (!in_array($randomNumber, $winningNumbers)) {
                $winningNumbers[] = $randomNumber;
            }
        }
    
        // Générer le numéro chance
        do {
            $randomLuckyNumber = strval(rand(1, 10)); // Convertir en chaîne de caractères
        } while (in_array($randomLuckyNumber, $winningNumbers)); // Vérifier qu'il n'est pas déjà présent parmi les numéros gagnants
    
        // Construire la phrase avec les numéros gagnants et le numéro chance
        $winningNumbersPhrase = "Les numéros gagnants sont " . implode(", ", $winningNumbers);
        $winningNumbersPhrase .= " et le numéro chance est " . $randomLuckyNumber . ". \n\n\n";
    
        echo $winningNumbersPhrase;

        echo "Attention ! ! ! , seulement les 5 premières grilles de chaque personne sont prises en compte. \n\n\n";
    
        // Ajouter le numéro chance à la liste des numéros gagnants
        $winningNumbers[] = $randomLuckyNumber;
    
        return $winningNumbers;
    }
    
    
    
    
    public function determineWinners($players) {
        $winningNumbers = $this->drawWinningNumbers();
        $results = [];
    
        foreach ($players as $player) {
            $playerResults = [];
            $matchingNumbers = array_intersect($player->getNumbers(), $winningNumbers);
            $matchingCount = count($matchingNumbers);
            $hasLuckyNumber = $player->getChanceNumber() && in_array($player->getChanceNumber(), $winningNumbers);
    
            switch ($matchingCount) {
                case 5:
                    if ($hasLuckyNumber) {
                        $playerResults[] = 1; // Rang 1: 5 numéros + numéro chance
                    } else {
                        $playerResults[] = 2; // Rang 2: 5 numéros sans numéro chance
                    }
                    break;
                case 4:
                    $playerResults[] = 3; // Rang 3: 4 numéros + numéro chance ou 4 numéros sans numéro chance
                    break;
                case 3:
                    $playerResults[] = 4; // Rang 4: 3 numéros + numéro chance ou 3 numéros sans numéro chance
                    break;
                case 2:
                    $playerResults[] = 5; // Rang 5: 2 numéros + numéro chance ou 2 numéros sans numéro chance
                    break;
                case 1:
                    if ($hasLuckyNumber) {
                        $playerResults[] = 6; // Rang 6: 1 numéro + numéro chance ou aucun numéro + numéro chance
                    } else {
                        $playerResults[] = 7; // Rang 7: 1 numéro sans numéro chance
                    }
                    break;
                default:
                    $playerResults[] = 8; // Aucun rang, pas de correspondance
                    break;
            }
    
            $results[] = ['player' => $player->getName(), 'results' => $playerResults];
        }
    
        // Trier les résultats par rang
        usort($results, function($a, $b) {
            return min($a['results']) <=> min($b['results']);
        });
    
        return $results;
    }
    
}

?>