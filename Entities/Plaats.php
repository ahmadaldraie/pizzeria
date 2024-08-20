<?php
declare(strict_types=1);

namespace Entities;

class Plaats {
    private int $id;
    private string $postcode;
    private string $woonplaats;
    private int $beschikbaar;
    

    public function __construct(int $id, string $postcode, string $woonplaats, int $beschikbaar) {
        $this->id = $id;
        $this->postcode = $postcode;
        $this->woonplaats = $woonplaats;
        $this->beschikbaar = $beschikbaar; 
    }

    //Getters
    public function getId(): int { return $this->id; }
    public function getPostcode(): string { return $this->postcode; }
    public function getWoonplaats(): string { return $this->woonplaats; }
    public function getBeschikbaar(): int { return $this->beschikbaar; }

    //Setters
    public function setPostcode(string $postcode) { return $this->postcode = $postcode; }
    public function setWoonplaats(string $woonplaats) { return $this->woonplaats = $woonplaats; }
    public function setBeschikbaar(int $beschikbaar) { return $this->beschikbaar = $beschikbaar; }

}
?>