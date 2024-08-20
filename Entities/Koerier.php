<?php
declare(strict_types=1);

namespace Entities;

class Koerier {
    private int $id;
    private string $naam;
    private string $voornaam;
    private string $gsmNr;

    public function __construct(int $id, string $naam, string $voornaam, string $gsmNr) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->gsmNr = $gsmNr;
    }

    public function getId(): int { return $this->id; }
    public function getNaam(): string { return $this->naam; }
    public function getVoornaam(): string { return $this->voornaam; }
    public function getGsmNr(): string { return $this->gsmNr; }

    public function setNaam(string $naam) { $this->naam = $naam; }
    public function setVoornaam(string $voornaam) { $this->voornaam = $voornaam; }
    public function setGsmNr(string $gsmNr) { $this->gsmNr = $gsmNr; }
}
?>