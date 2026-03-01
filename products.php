<?php
require_once('./model/connexion.php');
require_once('./model/products.model.php');

$products = getAllProduct(); 

$updateProduct = null; 
$readProduct = null;  


if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'read') {
        $readProduct = getProductById($id);
    }

    if ($action === 'update') {
        $updateProduct = getProductById($id);
    }
        if ($action === 'delete') {
            deleteProduct($id);
            header("Location: index.php");
            exit;
        }
}


if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['titre'], $_POST['prix'], $_POST['description'])
) {
    $titre = strip_tags($_POST["titre"]);
    $prix = strip_tags($_POST["prix"]);
    $description = strip_tags($_POST["description"]);
    $image = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) die("Type de fichier non autorisé");

        $image = uniqid() . "_" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "./img/" . $image);
    }

    if (!empty($_POST['id'])) {

        $id = intval($_POST['id']);
        $current = getProductById($id);
        if (!$image) $image = $current['image']; 
        updateProduct($id, $titre, $prix, $image, $description);
    } else {

        addProduct($titre, $prix, $image, $description);
    }

    header("Location: index.php");
    exit;
}


?>