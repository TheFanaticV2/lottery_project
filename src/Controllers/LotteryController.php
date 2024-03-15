<?php
require_once 'C:\xampp\htdocs\lottery_project\src\Models\PlayerManager.php';
require_once 'C:\xampp\htdocs\lottery_project\src\Models\Lottery.php';

class LotteryController {
    public function handleUpload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
                $csvFile = $_FILES['csvFile']['tmp_name'];
                $playerManager = new PlayerManager();
                $lottery = new Lottery();
                
                // Charger les joueurs à partir du fichier CSV
                if ($playerManager->loadPlayersFromCSV($csvFile)) {
                    $players = $playerManager->getPlayers();
                    // Effectuer le tirage et déterminer les gagnants
                    $winners = $lottery->determineWinners($players);
                    
                    // Enregistrer les résultats dans le fichier winner.csv
                    $this->saveWinnersToCSV($winners);
                    $this->downloadFile('Winner.csv');

                    echo "Résultats du tirage enregistrés avec succès dans winner.csv.";
                } else {
                    // Gérer les erreurs de chargement du fichier CSV
                    echo "Erreur lors du chargement du fichier CSV.";
                }
            } else {
                // Gérer les erreurs d'upload du fichier
                echo "Erreur lors de l'upload du fichier CSV.";
            }
        } else {
            // Gérer les erreurs de méthode HTTP
            echo "Méthode HTTP non autorisée.";
        }
    }

    public function saveWinnersToCSV($winners) {
        $file = 'C:\xampp\htdocs\lottery_project\data\Winner.csv';
        $fp = fopen($file, 'w');
        fputcsv($fp, ['Joueur',  'Rang']); // Ajouter l'en-tête du fichier CSV
        
        foreach ($winners as $winner) {
            fputcsv($fp, [$winner['player'], implode(', ', $winner['results'])]); // Ajouter chaque joueur avec ses résultats
        }
        fclose($fp);
    }
    private function downloadFile($filename) {
        $file = 'C:\xampp\htdocs\lottery_project\data\\' . $filename; // Chemin complet du fichier
        if (file_exists($file)) { // Vérifier si le fichier existe
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            readfile($file); // Lire et télécharger le fichier
            exit;
        } else {
            echo "Le fichier $filename n'existe pas.";
        }
    }
}

// Crée une instance de LotteryController et exécute la méthode handleUpload
$lotteryController = new LotteryController();
$lotteryController->handleUpload();
?>
