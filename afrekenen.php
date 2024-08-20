<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

if (!isset($_SESSION['klant'])) {
    header("location: login.php");
    exit(0);
}

include("Presentation/afrekenenPagina.php");
?>