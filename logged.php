<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
$loggedIn = !empty($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? null;
}

require_once('./model/connexion.php');

?>