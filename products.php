<?php

require_once('./model/connexion.php');
require_once("./model/products.model.php");

// Récupération des produits pour l'affichage
$products = getAllProduct();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        !empty($_POST["titre"]) &&
        !empty($_POST["prix"]) &&
        !empty($_POST["description"]) &&
        isset($_FILES["image"]) &&
        $_FILES["image"]["error"] === 0
    ) {

        $titre = strip_tags($_POST["titre"]);
        $prix = strip_tags($_POST["prix"]);
        $description = strip_tags($_POST["description"]);

        // 🔒 Vérification du type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            die("Type de fichier non autorisé");
        }

        // Renommage de l'image
        $image = uniqid() . "_" . $_FILES["image"]["name"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Déplacement du fichier
        move_uploaded_file($tmpName, "./img/" . $image);

        // Ajout en base
        addProduct($titre, $prix, $image, $description);

        header("Location: products.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site e-com</title>
    <link rel="stylesheet" href="./style/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php include("./Template/header.html"); ?>

<h1>Bienvenue dans notre site e-com</h1>

<?php foreach ($products as $product) : 

    $res  = $product['titre'];
    $res2 = $product['prix'] . " €";
    $res3 = '<img src="./img/' . $product['image'] . '" class="product-img">';

?>

<div class="Products">

    <h2><?= $res ?></h2>
    <h3><?= $res2 ?></h3>

    <?= $res3 ?>

    <p><?= $product['description'] ?></p>

    <button type="button" id="buy">
        <img src="./img/icons/buy.svg" alt="Panier">
    </button>

</div>

<?php endforeach; ?>




<footer>
    <?php include("./Template/footer.html"); ?>
</footer>

<script src="/script/script.js"></script>
</body>
</html>