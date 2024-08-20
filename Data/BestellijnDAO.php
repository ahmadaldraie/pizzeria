<?php
declare(strict_types=1);

namespace Data;

use Entities\Bestellijn;
use \PDO;
use Data\DBConfig;
use Exception;

class BestellijnDAO {

    public function create(int $bestellingId, int $productId, int $aantal, float $verkoopPrijs) {
        try {
            $sql = "insert into bestellijnen_pizzeria (bestellingId, productId, aantal, verkoopPrijs) values (:bestellingId, :productId, :aantal, :verkoopPrijs)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':bestellingId' => $bestellingId, ':productId' => $productId, ':aantal' => $aantal, ':verkoopPrijs' => $verkoopPrijs));
            $dbh = null;
            
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }


    }


    public function getBestellijnenVoorBestelling(int $bestellingId): ?array {
        try {
            $bestellijnen = array();
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "select * from bestellijnen_pizzeria where bestellingId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('id', $bestellingId);
            $stmt->execute();
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
            foreach ($resultSet as $rij) {
                $bestellijn = new Bestellijn($rij['bestellingId'], $rij['productId'], $rij['aantal'], $rij['verkoopPrijs']);
                array_push($bestellijnen, $bestellijn);
            }
            
            return $bestellijnen;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    }
}
?>