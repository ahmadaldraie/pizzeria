<?php
    declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pizzeria</title>
        <link href="style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="indexMandje.js" defer></script>
    </head>
    <body>
        <header class="">
            <a href="index.php"><img src="img/logo.png" alt="Pizzeria"></a>
            <nav class="top_menu">
                <ul>
                    <?php if (isset($_SESSION['klant'])) { 
                        $klant = unserialize($_SESSION['klant']);?>
                        <li>Welcome <span style="color: orange;"><?php echo $klant->getVoornaam(); ?></span></li>
                        <li><a href="logout.php">Uitloggen</a></li>
                    <?php } else { ?>
                    <li><a href="login.php">Aanmelden</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>
        <div class="container">
            <section class="inhoud" id="productenLijst">
                <h1>Pizza</h1>
                <dl>
                    <?php foreach ($pizzas as $pizza) { ?>
                        <dd class="product pizza clearFix">
                            <h2 class="naam"><?php echo $pizza->getNaam(); ?></h2>
                            <div class="omschrijving"><?php echo $pizza->getOmschrijving(); ?></div>
                            <div class="prijs"><span><?php echo $pizza->getPrijs(); ?></span>&euro;</div>
                            <button class="toevoegen" id="<?php echo $pizza->getId(); ?>">Toevoegen</button>
                            <img class="productImg" src="img/<?php echo $pizza->getFoto(); ?>" alt="<?php echo $pizza->getNaam(); ?>">
                        </dd>
                    <?php } ?>
                </dl>
                <h1>Dranken</h1>
                <dl>
                    <?php foreach ($dranken as $drank) { ?>
                        <dd class="product clearFix">
                            <h2 class="naam"><?php echo $drank->getNaam(); ?></h2>
                            <div class="prijs"><span><?php echo $drank->getPrijs(); ?></span>&euro;</div>
                            <button class="toevoegen" id="<?php echo $drank->getId(); ?>">Toevoegen</button>
                            <img class="productImg" src="img/<?php echo $drank->getFoto(); ?>" alt="<?php echo $drank->getNaam(); ?>">
                            
                        </dd>
                    <?php } ?>
                </dl>
                <h1>Extra's</h1>
                <dl>
                    <?php foreach ($extras as $extra) { ?>
                        <dd class="product extra clearFix">
                            <h2 class="naam"><?php echo $extra->getNaam(); ?></h2>
                            <div class="prijs"><span><?php echo $extra->getPrijs(); ?></span>&euro;</div>
                            <button class="toevoegen" id="<?php echo $extra->getId(); ?>">Toevoegen</button>                            
                        </dd>
                    <?php } ?>
                </dl>
            </section>
            <section class="verticaalLijst" id="mandje">
                <dl class="mandjeLijst">
                    <p class="error" id="mandjeLeeg" hidden>Voeg eerste iets toe!</p>
                </dl>
                <p class="Totaal">Totaal: <span id="totaal"></span></p>
                <button class="afrekenen" id="afrekenenKnop">Afrekenen</button>
            </section>
        </div>
        <footer>
            Disclaimer: Deze website is gemaakt als een opdracht voor de opleiding Full-Stack developer van VDAB
            <p>&copy; Pizzeria</p>
        </footer>
    </body>
</html>