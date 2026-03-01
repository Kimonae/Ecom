<?php
require_once('connexion.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$loggedIn = isset($_SESSION['user_id']);
$userName = $loggedIn ? $_SESSION['user_name'] : null;


function login($mail, $password) {
    global $db;

    $stmt = $db->prepare("SELECT * FROM users WHERE mail = :mail LIMIT 1");
    $stmt->execute([':mail' => $mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }

    return false;
}


$loginError = '';


if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['login'], $_POST['mail'], $_POST['password'])
) {
    $mail = strip_tags($_POST['mail']);
    $password = strip_tags($_POST['password']);

    if (login($mail, $password)) {
        header("Location: index.php");
        exit;
    } else {
        $loginError = "mail ou mot de passe incorrect.";
    }
}
?>