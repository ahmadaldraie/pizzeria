<?php
declare(strict_types=1);

namespace Entities;

class BestellingStatus {
    private int $id;
    private string $status;
    

    public function __construct(int $id, string $status) {
        $this->id = $id;
        $this->status = $status;
    }

    //Getters
    public function getId(): int { return $this->id; }
    public function getStatus(): string { return $this->status; }

    //Setters
    public function setStatus(string $status) { return $this->status = $status; }
}
?>