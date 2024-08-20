<?php
declare(strict_types=1);

namespace Entities;

use Entities\Plaats;

class klant {
    private int $id;
    private string $naam;
    private string $voornaam;
    private string $straat;
    private string $huisNr;
    private Plaats $plaats;
    private string $telefoonNr;
    private string $gsmNr;
    private string $email;
    private string $wachtwoord;
    private float $korting;


    public function __construct(int $id, string $naam, string $voornaam, string $straat, string $huisNr, Plaats $plaats, 
    string $telefoonNr, string $gsmNr, string $email, string $wachtwoord, float $korting) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->huisNr = $huisNr;
        $this->plaats = $plaats;
        $this->telefoonNr = $telefoonNr;
        $this->gsmNr = $gsmNr;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->korting = $korting;
    }

    public function getId(): int { return $this->id; }
    public function getNaam(): string { return $this->naam; }
    public function getVoornaam(): string { return $this->voornaam; }
    public function getStraat(): string { return $this->straat; }
    public function getHuisNr(): string { return $this->huisNr; }
    public function getPlaats(): Plaats { return $this->plaats; }
    public function getTelefoonNr(): string { return $this->telefoonNr; }
    public function getGsmNr(): string { return $this->gsmNr; }
    public function getEmail(): string { return $this->email; }
    public function getWachtwoord(): string { return $this->wachtwoord; }
    public function getKorting(): float { return $this->korting; }

    public function setNaam(string $naam) { $this->naam = $naam; }
    public function setVoornaam(string $voornaam) { $this->voornaam = $voornaam; }
    public function setStraat(string $straat) { $this->straat = $straat; }
    public function setHuisNr(string $huisNr) { $this->huisNr = $huisNr; }
    public function setPlaats(Plaats $plaats) { $this->plaats = $plaats; }
    public function setTelefoonNr(string $telefoonNr) { $this->telefoonNr = $telefoonNr; }
    public function setGsmNr(string $gsmNr) { $this->gsmNr = $gsmNr; }
    public function setEmail(string $email) { $this->email = $email; }
    public function setWachtwoord(string $wachtwoord) {
        $this->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT); 
    }
    public function setKorting(float $korting) { $this->korting = $korting; }

}
?>