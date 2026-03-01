<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {
        if (
            !empty($_POST["name"]) &&
            !empty($_POST["firstname"]) &&
            !empty($_POST["mail"]) &&
            !empty($_POST["password"])
        ) {
            $name = strip_tags($_POST["name"]);
            $firstname = strip_tags($_POST["firstname"]);
            $mail = strip_tags($_POST["mail"]);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $check = $this->db->prepare("SELECT id FROM users WHERE mail = :mail");
            $check->execute(['mail' => $mail]);

            if ($check->rowCount() > 0) {
                return "Cet e-mail est déjà utilisé.";
            }

            $sql = "INSERT INTO users (name, firstname, mail, password)
                    VALUES (:name, :firstname, :mail, :password)";

            $query = $this->db->prepare($sql);

            try {
                $query->execute([
                    'name' => $name,
                    'firstname' => $firstname,
                    'mail' => $mail,
                    'password' => $password
                ]);
                return true;
            } catch (PDOException $e) {
                return "Erreur lors dde l'inscription " . $e->getMessage();
            }
        }
        return null;
    }
}