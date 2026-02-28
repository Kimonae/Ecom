<?php

require_once('connexion.php');

require_once('../user.php');
$usr = new User($db);
$result = $usr->register();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>

<h1>Inscription</h1>

<?php
if ($result === true) {
    echo "<p>Inscription réussie ! <a href='/login.php'>Connectez-vous</a></p>";
} elseif (is_string($result)) {
    echo "<p style='color:red;'>$result</p>";
}
?>

<form action="" method="post">
    <div>
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="firstname">Prénom :</label>
        <input type="text" id="firstname" name="firstname" required>
    </div>
    <div>
        <label for="mail">E-mail :</label>
        <input type="email" id="mail" name="mail" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="S'inscrire">
    </div>
</form>

</body>
</html>