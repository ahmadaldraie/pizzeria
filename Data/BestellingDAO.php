<?php
declare(strict_types=1);

namespace Data;

use Entities\Bestelling;
use \PDO;
use Data\DBConfig;
use Entities\BestellingStatus as status;
use Data\KlantDAO;
use Data\KoerierDAO;
use Exception;

class BestellingDAO {

    public function create(int $klantId, string $opmerking): ?Bestelling {
        try {
            $sql = "insert into bestellingen_pizzeria (klantId, statusId, koerierId, opmerking) values (:klantId, 1, 1, :opmerking)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('klantId', $klantId);
            $stmt->bindValue('opmerking', $opmerking);
            $stmt->execute();
            $lastId = (int) $dbh->lastInsertId();
            $dbh = null;
            $bestelling = $this->getBestellingById($lastId);
            
            return $bestelling;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }


    }


    public function getBestellingById(int $id): ?Bestelling {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "select * from bestellingen_pizzeria, bestellingstatussen_pizzeria where bestellingen_pizzeria.statusId = bestellingstatussen_pizzeria.statusId and bestellingId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
            $klantDAO = new KlantDAO();
            $koerierDAO = new KoerierDAO();
            $klant = $klantDAO->getKlantById($result['klantId']);
            $koerier = $koerierDAO->getKoerierById($result['koerierId']);
            $status = new Status($result['statusId'], $result['status']);
            $bestelling = new Bestelling($result['bestellingId'], $klant, $result['datum'], $status, $koerier, $result['opmerking']);    
            
            return $bestelling;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    }
}
?>