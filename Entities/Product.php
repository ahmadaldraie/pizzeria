<?php
declare(strict_types=1);

namespace Entities;

use Entities\ProductSoort;

class Product {
    private int $id;
    private string $naam;
    private ProductSoort $soort;
    private float $prijs;
    private float $promotiePrijs;
    

    public function __construct(int $id, string $naam, ProductSoort $soort, float $prijs, float $promotiePrijs) {
        $this->id = $id;
        $this->naam = $naam;
        $this->soort = $soort;
        $this->prijs = $prijs;
        $this->promotiePrijs = $promotiePrijs;
    }

    //Getters
    public function getId(): int { return $this->id; }
    public function getNaam(): string { return $this->naam; }
    public function getSoort(): ProductSoort { return $this->soort; }
    public function getPrijs(): float { return $this->prijs; }
    public function getPromotiePrijs(): float { return $this->promotiePrijs; }

    //Setters
    public function setNaam(string $naam) { return $this->naam = $naam; }
    public function setSoort(ProductSoort $soort) { return $this->soort = $soort; }
    public function setPrijs(float $prijs) { return $this->prijs = $prijs; }
    public function setAantal(float $promotiePrijs) { return $this->promotiePrijs = $promotiePrijs; }

}
?>