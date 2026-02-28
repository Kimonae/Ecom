<?php

require_once('connexion.php');

function getAllProduct()
{
    global $db;

    $stmt = $db->query("SELECT * FROM products;");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById($id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM products WHERE id = :id;");
    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addProduct($titre, $prix, $image, $description)
{
    global $db;

    $stmt = $db->prepare("INSERT INTO products (titre, prix, image, description) 
                          VALUES (:titre, :prix, :image, :description);");

    $stmt->execute([
        ':titre' => $titre,
        ':prix' => $prix,
        ':image' => $image,
        ':description' => $description
    ]);
}

function updateProduct($id, $titre, $prix, $image, $description)
{
    global $db;

    $stmt = $db->prepare("UPDATE products 
                          SET titre = :titre, prix = :prix, image = :image, description =:description
                          WHERE id = :id;");

    $stmt->execute([
        ':id' => $id,
        ':titre' => $titre,
        ':prix' => $prix,
        ':image' => $image,
        ':description' => $description
    ]);
}

function deleteProduct($id)
{
    global $db;

    $stmt = $db->prepare("DELETE FROM products WHERE id = :id;");
    $stmt->execute([
        ':id' => $id
    ]);
}