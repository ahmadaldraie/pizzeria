<?php
declare(strict_types=1);

namespace Entities;

class Bestellijn {
    private int $bestellingId;
    private int $productId;
    private int $aantal;
    private float $verkoopprijs;

    public function __construct(int $bestellingId, int $productId, int $aantal, float $verkoopprijs) {
        $this->bestellingId = $bestellingId;
        $this->productId = $productId;
        $this->aantal = $aantal;
        $this->verkoopprijs = $verkoopprijs;
    }

    public function getBestellingId(): int { return $this->bestellingId; }
    public function getProductId(): int { return $this->productId; }
    public function getAantal(): int { return $this->aantal; }
    public function getVerkoopprijs(): float { return $this->verkoopprijs; }

    public function setBestellingId(int $bestellingId) { $this->bestellingId = $bestellingId; }
    public function setProductId(int $productId) { $this->productId = $productId; }
    public function setAantal(int $aantal) { $this->aantal = $aantal; }
    public function setVerkoopprijs(float $verkoopprijs) { $this->verkoopprijs = $verkoopprijs; }

}
?>