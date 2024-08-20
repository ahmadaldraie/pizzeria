<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

use Business\KlantService;
use Entities\klant;
use Exceptions\PlaatsBestaatNietException;

$klantService = new KlantService();

$straat = $_POST['straat'];
$huisNr = $_POST['huisNr'];
$postcode = $_POST['postcode'];
$woonplaats = $_POST['woonplaats'];

try {
    $plaats = $klantService->haalPlaatsOpByPostcode($postcode);
    $klantParam = unserialize($_SESSION['klant']);
    $klantParam->setStraat($straat);
    $klantParam->sethuisNr($huisNr);
    $klantParam->setPlaats($plaats);
    $klant = $klantService->bijwerkKlantGegevens($klantParam);
    $_SESSION['klant'] = serialize($klant);
    header('Location: afrekenen.php');
    exit(0);
}  catch (PlaatsBestaatNietException $e) {
    header('Location: afrekenen.php?error=postcode');
    exit(0);
}


?>