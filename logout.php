<?php
declare(strict_types=1);

session_start();

require_once('Data/autoloader.php');

if (isset($_SESSION['klant'])) {
    unset($_SESSION['klant']);
}

header('Location: login.php');
exit(0);
?>