<?php
    declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <title>Pizzeria afrekenen</title>
        <link href="style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="afrekenenMandje.js" defer></script>
    </head>
    <body>
        <header>
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
        <div class="wrapper">
            <section class="midden" id="afrekenen">
                <div class="bestelling">
                    <h1>Bestelling: </h1>
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: left;">Product</th>
                                <th>Aantal</th>
                                <th></th>
                                <th>Prijs</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <?php if ($klant->getKorting() > 0) { ?>
                            <tr>
                                <td>Korting: </td>
                                <td class="prijs" id="kortingTd" colspan="3" style="text-align: right;"><span id="korting"><?php echo $klant->getKorting()*100; ?></span>&percnt;</td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>Totaal: </td>
                                <td class="prijs" id="totaalTd" colspan="3" style="text-align: right;"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <button class="wijzigen" id="mandjeWijzigen" onclick="bestellingWijzigen()">Wijzigen</button>
                </div>
                <div class="adresGegevens">
                    <h1>Adres: </h1>
                    <form action="adresWijzigen.php" method="post">
                        <label for="straat">Straat:</label>
                        <input type="text" id="straat" name="straat" autocomplete="address-line1" value="<?php echo $klant->getStraat(); ?>" disabled><br>

                        <label for="huisNr">Huis nummer:</label>
                        <input type="text" id="huisNr" name="huisNr" value="<?php echo $klant->getHuisNr(); ?>" disabled><br>

                        <label for="postcode">Postcode:</label>
                        <input type="text" id="postcode" name="postcode" autocomplete="postal-code" value="<?php echo $klant->getPlaats()->getPostcode(); ?>" disabled><br>

                        <label for="woonplaats">Woonplaats:</label>
                        <input type="text" id="woonplaats" name="woonplaats" autocomplete="address-level2" value="<?php echo $klant->getPlaats()->getWoonplaats(); ?>" disabled><br>

                        <input id="adresOpslaan" style="width: auto;" type="submit" value="opslaan" hidden>
                    </form>
                    <button class="wijzigen" onclick="adresWijzigen()">Wijzigen</button>
                </div>
                <label for="opmerking">Opmerking:</label><br>
                <textarea id="opmerking" name="opmerking" placeholder="Heeft u opmerkingen voor de koerier?"></textarea><br>
                <button class="bestellen" onclick="bestellen()">Bestellen</button>
                <p id="feedback" hidden>Uw bestelling wordt verwerkt!<br>U wordt binnen vijf seconden automatisch doorgestuurd naar de hoofdpagina of klik  <a href="index.php">hier</a></p>
                <p class='error' id="errorFeedback"><?php if(isset($_GET['error']) && $_GET['error'] === 'postcode') echo 'U moet een geldige Belgische postcode invoeren' ?></p>
            </section>
            <section class="verticaalLijst" id="mandje">
                    <dl class="mandjeLijst">
                        
                    </dl>
                    <p class="Totaal">Totaal: <span id="totaal"></span></p>
                    <button class="opslaan" id="mandjeOpslaan" onclick="mandjeOpslaan()">Opslaan</button>
            </section>
        </div>
        <footer>
            <p>&copy; Copyright Pizzeria</p>
        </footer>
    </body>
</html>