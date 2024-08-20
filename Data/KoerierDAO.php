<?php
declare(strict_types=1);

namespace Data;

use Entities\Koerier;
use \PDO;
use Data\DBConfig;
use Exception;

class KoerierDAO {

    public function getKoerierById(int $id): ?Koerier {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "select * from Koeriers_pizzeria where koerierId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            $dbh = null;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $koerier = new Koerier($result['koerierId'], $result['naam'], $result['voornaam'], $result['gsmNr']);    
            
            return $koerier;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }
}
?>