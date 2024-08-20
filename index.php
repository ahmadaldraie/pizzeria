<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

use Business\ProductService;

$productService = new ProductService();

$pizzas = $productService->haalProductenOpPerSoort(1);
$dranken = $productService->haalProductenOpPerSoort(3);
$extras = $productService->haalProductenOpPerSoort(4);
$totaal = 0;

if (isset($_SESSION['mandje'])) {
    foreach ($_SESSION['mandje'] as $item) {
        $unItem = unserialize($item);
        $totaal += $unItem->getPrijs() * $_SESSION['aantal'][(string) $unItem->getId()];
    }
}

include("Presentation/hoofdpagina.php");
?>