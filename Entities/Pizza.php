<?php
declare(strict_types=1);

namespace Entities;
use Entities\Product;

class Pizza extends Product{
    private string $omschrijving;
    private string $foto;

    public function __construct(int $id, string $naam, ProductSoort $soort, float $prijs, float $promotiePrijs, string $omschrijving, string $foto) {
        parent::__construct($id, $naam, $soort, $prijs, $promotiePrijs);
        $this->omschrijving = $omschrijving;
        $this->foto = $foto;
    }

    //Getters
    public function getOmschrijving(): string { return $this->omschrijving; }
    public function getFoto(): string { return $this->foto; }

    //Setters
    public function setOmschrijving(string $omschrijving) { return $this->omschrijving = $omschrijving; }
    public function setFoto(string $foto) { return $this->foto = $foto; }
}
?>