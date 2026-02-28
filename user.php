<?php
require_once "model/connexion.php"; 

class User {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {
  
        if (
            isset($_POST["name"]) && !empty($_POST["name"]) &&
            isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
            isset($_POST["mail"]) && !empty($_POST["mail"]) &&
            isset($_POST["password"]) && !empty($_POST["password"])
        ) {
            $name = strip_tags($_POST["name"]);
            $firstname = strip_tags($_POST["firstname"]);
            $mail = strip_tags($_POST["mail"]);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


            $check = $this->db->prepare("SELECT id FROM users WHERE mail = :mail");
            $check->bindValue(':mail', $mail);
            $check->execute();
            if ($check->rowCount() > 0) {
                return "Cet e-mail est déjà utilisé.";
            }


            $sql = "INSERT INTO users (name, firstname, mail, password) VALUES (:name, :firstname, :mail, :password)";
            $query = $this->db->prepare($sql);
            $query->bindValue(':name', $name);
            $query->bindValue(':firstname', $firstname);
            $query->bindValue(':mail', $mail);
            $query->bindValue(':password', $password);

            try {
                $query->execute();
                return true; // succès
            } catch (PDOException $e) {
                return "Erreur lors de l'inscription : " . $e->getMessage();
            }
        }
        return null; 
    }
}