<?php
declare(strict_types = 1);

namespace Business;

use Data\BestellingDAO;
use Data\BestellijnDAO;
use Entities\Bestelling;

class BestellingService {
    public function nieuweBestelling(int $klantId, string $opmerking): ?Bestelling {
        $bestellingDAO = new BestellingDAO();
        $bestelling = $bestellingDAO->create($klantId, $opmerking);
        return $bestelling;
    }

    public function nieuweBestellijn(int $bestellingId, int $productId, int $aantal, float $verkoopPrijs) {
        $bestellijnDAO = new BestellijnDAO();
        $bestellijnDAO->create($bestellingId, $productId, $aantal, $verkoopPrijs);
    }

    public function haalDeBestellijnenvoorEenBestelling(int $bestellingId): ?array {
        $bestellijnDAO = new BestellijnDAO();
        $bestellijnen = $bestellijnDAO->getBestellijnenVoorBestelling($bestellingId);
        return $bestellijnen;
    }
}
?>