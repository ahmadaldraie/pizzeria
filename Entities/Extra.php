<?php
declare(strict_types=1);

namespace Entities;
use Entities\Product;

class Extra extends Product{

    public function __construct(int $id, string $naam, ProductSoort $soort, float $prijs, float $promotiePrijs) {
        parent::__construct($id, $naam, $soort, $prijs, $promotiePrijs);
    }
}
?>