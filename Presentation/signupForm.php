<?php
    declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <title>Pizzeria login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet">
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
        <div class="container" id="aanmelden">
            <div class="aanmeldenForm" id="signup">
            <form action="signup.php?action=signup" method="post">
                <label class="required" for="voornaam">Voornaam:</label>
                <input type="text" id="voornaam" name="voornaam" required><br>

                <label class="required" for="naam">Naam:</label>
                <input type="text" id="naam" name="naam" required><br>

                <label class="required" for="straat">Straat:</label>
                <input type="text" id="straat" name="straat" autocomplete="address-line1" required><br>

                <label class="required" for="huisNr">Huis nummer:</label>
                <input type="text" id="huisNr" name="huisNr" required><br>

                <label class="required" for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" autocomplete="postal-code" required><br>

                <label class="required" for="woonplaats">Woonplaats:</label>
                <input type="text" id="woonplaats" name="woonplaats" autocomplete="address-level2" required><br>

                <label for="telefoonNr">Telefoon nummer:</label>
                <input type="tel" id="telefoonNr" name="telefoonNr"><br>

                <label for="gsmNr">GSM nummer:</label>
                <input type="tel" id="gsmNr" name="gsmNr"><br>

                <label class="required" for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label class="required" for="wachtwoord">Wachtwoord:</label>
                <input type="password" id="wachtwoord" name="wachtwoord" required><br>

                <label class="required" for="herhaalWachtwoord">Herhaal Wachtwoord:</label>
                <input type="password" id="herhaalWachtwoord" name="herhaalWachtwoord" required><br>

                <input type="submit" value="Sign Up">
            </form>
                <?php if (isset($error)) print ("<p class='error'> $error </p>"); ?>
            </div>
        </div>
        <footer>
            <p>&copy; Copyright Pizzeria</p>
        </footer>
    </body>
</html>

