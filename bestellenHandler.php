<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

$klant = unserialize($_SESSION['klant']);

use Business\BestellingService;

$bestellingService = new BestellingService();
$leveringBeschikbaar = $klant->getPlaats()->getBeschikbaar();
if ($leveringBeschikbaar == 1) {
    $feedback = 'besteld';
    if (isset($_POST['mandjeItems'])) { 
        $mandjeItems = array();
        foreach ($_POST['mandjeItems'] as $item) {
            if (!empty($item)) {
                array_push($mandjeItems, $item);
            }
        }
        $bestelling = $bestellingService->nieuweBestelling($klant->getId(), $_POST['opmerking']);
        foreach ($mandjeItems as $item) {
            if(!empty($item['promotiePrijs'])) {
                $bestellingService->nieuweBestellijn($bestelling->getId(), (int) $item['id'], (int) $item['aantal'], (float) $item['promotiePrijs']);
            } else {
                $bestellingService->nieuweBestellijn($bestelling->getId(), (int) $item['id'], (int) $item['aantal'], (float) $item['prijs']);
            }
            
        }
        echo $feedback;
    } else {
        echo "No data received";
    }
}
else {
    echo "Helaas! kunnen we niet leveren op uw locatie.";
}


?>