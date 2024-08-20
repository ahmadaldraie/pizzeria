<?php
declare(strict_types=1);

namespace Data;

use Entities\Klant;
use Data\DBConfig;
use Entities\Plaats;
use \PDO; 
use \Exception;
use Exceptions\EmailReedsInGebruikException;
use Exceptions\WachtwoordenKomenNietOvereenException;

class KlantDAO {

    public function getKlantByEmail(string $email): ?Klant
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare("SELECT * FROM klanten_pizzeria, plaatsen_pizzeria WHERE email = :email and klanten_pizzeria.plaatsId = plaatsen_pizzeria.plaatsId");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
            if($result){
                $plaats = new Plaats($result['plaatsId'],$result['postcode'], $result['woonplaats'], $result['beschikbaar']);
                return new Klant($result['klantId'], $result['naam'], $result['voornaam'], $result['straat'], $result['huisNr'], $plaats,
                                 $result['telefoonNr'], $result['gsmNr'], $result['email'], $result['wachtwoord'], $result['korting']);
            }
            else return null;
        } catch (Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }

    public function getKlantById(int $id): ?Klant
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare("SELECT * FROM klanten_pizzeria, plaatsen_pizzeria WHERE klantId = :id and klanten.plaatsId_pizzeria = plaatsen_pizzeria.plaatsId");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
            if($result){
                $plaats = new Plaats($result['plaatsId'],$result['postcode'], $result['woonplaats'], $result['beschikbaar']);
                return new Klant($result['klantId'], $result['naam'], $result['voornaam'], $result['straat'], $result['huisNr'], $plaats,
                $result['telefoonNr'], $result['gsmNr'], $result['email'], $result['wachtwoord'], $result['korting']);
            }
            else return null;
        } catch (Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }

    public function register(Klant $klant, string $herhaalWachtwoord): ?klant
    {
        if (!is_null($this->getKlantByEmail($klant->getEmail()))) {
            throw new EmailReedsInGebruikException();
        }
        if ($klant->getWachtwoord() === $herhaalWachtwoord)
            $klant->setWachtwoord($herhaalWachtwoord);
        else
            throw new WachtwoordenKomenNietOvereenException();
        

        try {
            $sql = "INSERT INTO klanten_pizzeria (naam, voornaam, straat, huisNr, plaatsId, telefoonNr, gsmNr, email, wachtwoord, korting) 
            VALUES (:naam, :voornaam, :straat, :huisNr, :plaatsId, :telefoonNr, :gsmNr, :email, :wachtwoord, :korting)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":naam" => $klant->getNaam(),
                ":voornaam" => $klant->getVoornaam(),
                ":straat" => $klant->getStraat(),
                ":huisNr" => $klant->getHuisNr(),
                ":plaatsId" => $klant->getPlaats()->getId(),
                ":telefoonNr" => $klant->getTelefoonNr(),
                ":gsmNr" => $klant->getGsmNr(),
                ":email" => $klant->getEmail(),
                ":wachtwoord" => $klant->getWachtwoord(),
                ":korting" => $klant->getKorting()
            ));
            $lastUserId = (int) $dbh->lastInsertId();
            $dbh = null;
            $newKlant = $this->getKlantById($lastUserId);
            return $newKlant;

        } catch (Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }

    public function update(Klant $klant) : ?Klant {
        try {
            $sql = "UPDATE klanten_pizzeria SET naam = :naam, voornaam = :voornaam, straat = :straat, huisNr = :huisNr, plaatsId = :plaatsId, telefoonNr = :telefoonNr, gsmNr = :gsmNr, korting = :korting where klantId = :id";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":id" => $klant->getId(),
                ":naam" => $klant->getNaam(),
                ":voornaam" => $klant->getVoornaam(),
                ":straat" => $klant->getStraat(),
                ":huisNr" => $klant->getHuisNr(),
                ":plaatsId" => $klant->getPlaats()->getId(),
                ":telefoonNr" => $klant->getTelefoonNr(),
                ":gsmNr" => $klant->getGsmNr(),
                ":korting" => $klant->getKorting()
            ));
            $dbh = null;
            $newKlant = $this->getKlantById($klant->getId());
            return $newKlant;

        } catch (Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    } 
}
?>