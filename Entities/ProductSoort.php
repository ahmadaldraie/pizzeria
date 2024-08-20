<?php
declare(strict_types=1);

namespace Entities;

class ProductSoort {
    private int $id;
    private string $soortNaam;
    

    public function __construct(int $id, string $soortNaam) {
        $this->id = $id;
        $this->soortNaam = $soortNaam;
    }

    //Getters
    public function getId(): int { return $this->id; }
    public function getSoortNaam(): string { return $this->soortNaam; }

    //Setters
    public function setSoortNaam(string $soortNaam) { return $this->soortNaam = $soortNaam; }
}
?>