<?php
declare(strict_types=1);

namespace Data;

use Entities\Product;
use Entities\Pizza;
use Entities\Drank;
use Entities\Extra;
use \PDO;
use Data\DBConfig;
use Entities\ProductSoort;
use Exception;

class ProductDAO {

    public function getProductenPerSoort(int $soortId): ?array {
        try {
            $producten = array();
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare("select * from producten_pizzeria, productsoorten_pizzeria where producten_pizzeria.soortId = ? and producten_pizzeria.soortId = productsoorten_pizzeria.soortId");
            $stmt->execute(array($soortId));
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);	
            $dbh = null;
            $soort = new ProductSoort($resultSet[0]['soortId'], $resultSet[0]['soort']);
            switch ($soortId) {
                case 1:
                    foreach ($resultSet as $rij) {         
                        $pizza = new Pizza($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs'], $rij['omschrijving'], $rij['foto']);
                        array_push($producten, $pizza);
                    }
                break;
                case 3:
                    foreach ($resultSet as $rij) {
                        $drank = new Drank($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs'], $rij['foto']);
                        array_push($producten, $drank);
                    }
                break;
                case 4:
                    foreach ($resultSet as $rij) {
                        $extra = new Extra($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs']);
                        array_push($producten, $extra);
                    }
                break;
                default:
                foreach ($resultSet as $rij) {
                    $product = new Product($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs']);
                    array_push($producten, $product);
                }
            }
            
            return $producten;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    }

    public function getAllPizza(): ?array {
        try {
            $pizzas = array();
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $resultSet = $dbh->query("select * from producten_pizzeria, productsoorten_pizzeria where producten_pizzeria.soortId = 1 and producten_pizzeria.soortId = productsoorten_pizzeria.soortId");
            $dbh = null;
            foreach ($resultSet as $rij) {
                $soort = new ProductSoort($rij['soortId'], $rij['soort']);
                $pizza = new Pizza($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs'], $rij['omschrijving'], $rij['foto']);
                array_push($pizzas, $pizza);
            }
            
            return $pizzas;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    }

    public function getAllDranken(): ?array {
        try {
            $dranken = array();
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $resultSet = $dbh->query("select * from producten_pizzeria, productsoorten_pizzeria where producten_pizzeria.soortId = 3 and producten_pizzeria.soortId = productsoorten_pizzeria.soortId");
            $dbh = null;
            foreach ($resultSet as $rij) {
                $soort = new ProductSoort($rij['soortId'], $rij['soort']);
                $drank = new Drank($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs'], $rij['foto']);
                array_push($dranken, $drank);
            }
            
            return $dranken;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    }

    public function getAllExtras(): ?array {
        try {
            $extras = array();
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $resultSet = $dbh->query("select * from producten_pizzeria, productsoorten_pizzeria where producten_pizzeria.soortId = 4 and producten_pizzeria.soortId = productsoorten_pizzeria.soortId");
            $dbh = null;
            foreach ($resultSet as $rij) {
                $soort = new ProductSoort($rij['soortId'], $rij['soort']);
                $extra = new Extra($rij['productId'], $rij['naam'], $soort, $rij['prijs'], $rij['promotiePrijs']);
                array_push($extras, $extra);
            }
            
            return $extras;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
    }

    public function getProductById(int $id): ?Product {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "select * from producten_pizzeria, productsoorten_pizzeria where productsoorten_pizzeria.soortId = producten_pizzeria.soortId and productId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            $dbh = null;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $soort = new ProductSoort($result['soortId'], $result['soort']);
            switch ($result['soortId']) {
                case 1: 
                $product = new Pizza($result['productId'], $result['naam'], $soort, $result['prijs'], $result['promotiePrijs'], $result['omschrijving'], $result['foto']);
                break;
                case 3:
                $product = new Drank($result['productId'], $result['naam'], $soort, $result['prijs'], $result['promotiePrijs'], $result['foto']);
                break;
                default: $product = new Extra($result['productId'], $result['naam'], $soort, $result['prijs'], $result['promotiePrijs']);
                break;
                
            }

            return $product;
        } catch(Exception $e) {
            $error = $e->getMessage(); 
            echo('<p class="error">' . $error . '</p>'); 
            return null;
        }
        
    }
}
?>