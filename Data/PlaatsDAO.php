<?php
declare(strict_types=1);

namespace Data;

use Entities\Plaats;
use \PDO;
use Data\DBConfig;
use Exception;

class PlaatsDAO {

    public function getPlaatsById(int $id): ?Plaats {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "select * from plaatsen_pizzeria where plaatsId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            $dbh = null;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $plaats = new Plaats($result['plaatsId'], $result['postcode'], $result['woonplaats'], $result['beschikbaar']);    
            
            return $plaats;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }

    public function getPlaatsByPostcode(string $postcode): ?Plaats {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "select * from plaatsen_pizzeria where postcode = :postcode";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('postcode', $postcode);
            $stmt->execute();
            $dbh = null;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result)
                return new Plaats($result['plaatsId'], $result['postcode'], $result['woonplaats'], $result['beschikbaar']);    
            else {
                return null;
            }
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }
}
?>