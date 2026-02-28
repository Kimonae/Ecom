<?php

require_once('./model/products.model.php');

$action = "list";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


if ($action === "add" && !empty($_POST)) {

    addProduct($_POST['titre'], $_POST['prix']);
    header("Location: index.php");
    exit;
}


if ($action === "edit" && !empty($_POST) && !empty($_GET['id'])) {

    updateProduct($_GET['id'], $_POST['titre'], $_POST['prix']);
    header("Location: index.php");
    exit;
}


if ($action === "delete" && !empty($_GET['id'])) {

    deleteProduct($_GET['id']);
    header("Location: index.php");
    exit;
}


$products = getAllProduct();

if ($action === "edit" && !empty($_GET['id'])) {
    $productEdit = getProductById($_GET['id']);
}



require_once('./template/index.phtml');