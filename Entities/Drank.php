<?php
declare(strict_types=1);

namespace Entities;
use Entities\Product;

class Drank extends Product{
    private string $foto;

    public function __construct(int $id, string $naam, ProductSoort $soort, float $prijs, float $promotiePrijs, string $foto) {
        parent::__construct($id, $naam, $soort, $prijs, $promotiePrijs);
        $this->foto = $foto;
    }

    //Getters
    public function getFoto(): string { return $this->foto; }

    //Setters
    public function setFoto(string $foto) { return $this->foto = $foto; }
}
?>