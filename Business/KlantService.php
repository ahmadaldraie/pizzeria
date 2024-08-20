<?php
declare(strict_types = 1);

namespace Business;

use Data\KlantDAO;
use Data\PlaatsDAO;
use Entities\klant;
use Entities\Plaats;
use Exceptions\AccountBestaatNietException;
use Exceptions\PasswordWrongException;
use Exceptions\PlaatsBestaatNietException;

use function PHPUnit\Framework\isNull;

class KlantService {
    public function login(string $email, string $wachtwoord): ?klant {
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->getKlantByEmail($email);
        if ($klant === null)
            throw new AccountBestaatNietException();
        $wachtwoordCorrect = password_verify($wachtwoord, $klant->getWachtwoord());
        if (!$wachtwoordCorrect)
            throw new PasswordWrongException();

        return $klant;
    } 

    public function signup(Klant $klantParam, string $herhaalWachtwoord): ?Klant {
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->register($klantParam, $herhaalWachtwoord);
        return $klant;
    }

    public function haalPlaatsOpByPostcode(string $postcode): ?Plaats {
        $plaatsDAO = new plaatsDAO();
        $plaats = $plaatsDAO->getPlaatsByPostcode($postcode);
        if (empty($plaats))
            throw new PlaatsBestaatNietException();
        return $plaats;
    }

    public function bijwerkKlantGegevens(Klant $klantParam): ?Klant {
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->update($klantParam);
        return $klant;
    }
}
?>