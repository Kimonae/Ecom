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
