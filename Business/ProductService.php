<?php
declare(strict_types = 1);

namespace Business;

use Data\ProductDAO;
use Entities\Product;

class ProductService {
    public function haalProductenOpPerSoort(int $soortId): ?array {
        $productDAO = new ProductDAO();
        $lijst = $productDAO->getProductenPerSoort($soortId);
        return $lijst;
    }

    public function haalProductOp(int $id) : ?Product {
        $productDAO = new ProductDAO();
        $product = $productDAO->getProductById($id);
        return $product;
    }
    
}
?>