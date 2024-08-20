<?php
declare(strict_types=1);

namespace Entities;

use Entities\Klant;
use Entities\Koerier;
use Entities\BestellingStatus as Status;

class Bestelling {
    private int $id;
    private Klant $klant;
    private string $datum;
    private Status $status;
    private Koerier $koerier;
    private string $opmerking;


    public function __construct(int $id, Klant $klant, string $datum, Status $status, Koerier $koerier, string $opmerking) {
        $this->id = $id;
        $this->klant = $klant;
        $this->datum = $datum;
        $this->status = $status;
        $this->koerier = $koerier;
        $this->opmerking = $opmerking;
    }

    public function getId(): int { return $this->id; }
    public function getKlant(): Klant { return $this->klant; }
    public function getDatum(): string { return $this->datum; }
    public function getStatus(): Status { return $this->status; }
    public function getKoerier(): Koerier { return $this->koerier; }
    public function getOpmerking(): string { return $this->opmerking; }

    public function setKlant(Klant $klant) { $this->klant = $klant; }
    public function setDatum(string $datum) { $this->datum = $datum; }
    public function setStatus(Status $status) { $this->status = $status; }
    public function setKoerier(Koerier $koerier) { $this->koerier = $koerier; }
    public function setOpmerking(string $opmerking) { $this->opmerking = $opmerking; }

}
?>