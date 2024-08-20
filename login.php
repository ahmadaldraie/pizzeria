<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

if (isset($_SESSION['klant'])) {
    header("location: index.php");
    exit(0);
}

use Business\KlantService;
use Exceptions\AccountBestaatNietException;
use Exceptions\PasswordWrongException;

$klantService = new KlantService();

if (isset($_GET['action']) && $_GET['action'] === 'aanmelden') {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    try {
        $klant = $klantService->login($email, $wachtwoord);
        $_SESSION['klant'] = serialize($klant);
        header('Location: index.php');
        exit(0);
    } catch (AccountBestaatNietException $e) {
        $error = "Account bestaat niet";
    } catch (PasswordWrongException $e) {
        $error = "Wachtwoord is fout";
    }
}


include("Presentation/aanmelden.php");
?>