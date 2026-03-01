<?php
require_once('connexion.php');
require_once('./user.php');

$usr = new User($db);
$result = $usr->register();
?>

<?php
if ($result === true) {
    echo "<p class='text-success'>Inscription réussie !</p>";
} elseif (is_string($result)) {
    echo "<p class='text-danger'>$result</p>";
}
?>

<form action="" method="post">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text" name="firstname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="mail" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        S'inscrire
    </button>
</form>