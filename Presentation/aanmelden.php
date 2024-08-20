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
            <div class="aanmeldenForm">
                <form action="login.php?action=aanmelden" method="post">
                    <p>
                        <input type="email" name="email" placeholder="Uw e-mail" required>
                    </p>
                    <p>
                        <input type="password" name="wachtwoord" placeholder="Uw wachtwoord" required>
                    </p>
                    <p>
                        <input type="submit" value="Aanmelden">
                    </p>
                </form>
                <?php if (isset($error)) print ("<p class='error'> $error </p>"); ?>
            </div>
            
            <p class="accountMaken">Hebt u nog geen account? <a href="signup.php">Account maken</a></p>
        </div>
        <footer>
            <p>&copy; Copyright Pizzeria</p>
        </footer>
    </body>
</html>