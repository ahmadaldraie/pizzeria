<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

use Business\KlantService;
use Entities\klant;
use Exceptions\EmailReedsInGebruikException;
use Exceptions\WachtwoordenKomenNietOvereenException;
use Exceptions\PlaatsBestaatNietException;

$klantService = new KlantService();

if (isset($_GET['action']) && $_GET['action'] === 'signup') {
    $voornaam = $_POST['voornaam'];
    $naam = $_POST['naam'];
    $straat = $_POST['straat'];
    $huisNr = $_POST['huisNr'];
    $postcode = $_POST['postcode'];
    $woonplaats = $_POST['voornaam'];
    $telefoonNr = $_POST['telefoonNr'];
    $gsmNr = $_POST['gsmNr'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $herhaalWachtwoord =  $_POST['herhaalWachtwoord'];
    try {
        $plaats = $klantService->haalPlaatsOpByPostcode($postcode);
        $korting = $plaats->getPostcode() === '2018' ? (float) 0.2 : (float) 0;
        $klantParam = new Klant(-1, $naam, $voornaam, $straat, $huisNr, $plaats, $telefoonNr, $gsmNr, $email, $wachtwoord, $korting);
        $klant = $klantService->signup($klantParam, $herhaalWachtwoord);
        $_SESSION['klant'] = serialize($klant);
        header('Location: index.php');
        exit(0);
    } catch (EmailReedsInGebruikException $e) {
        $error = "Email reeds in gebruik!";
    } catch (WachtwoordenKomenNietOvereenException $e) {
        $error = "Wachtwoorden moeten overeenkomen!";
    } catch (PlaatsBestaatNietException $e) {
        $error = "U moet een geldige Belgische postcode invoeren";
    }
}


include("Presentation/signupForm.php");
?>