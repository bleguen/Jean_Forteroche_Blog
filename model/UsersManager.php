<?php

require_once("model/manager.php");

class UsersManager extends Manager {

    public function getUser($username) {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT username, passwordHash, id  FROM users WHERE username =  '$username'");
        $req->execute(array($username));
        $user = $req->fetch();

        return $user;
    }
    // A retravailler
    public function postUser($username, $passwordHash, $mail) {

        $passwordHash = password_hash($_POST['passwordHash'], PASSWORD_DEFAULT);

        $db = $this->dbConnect();
        $user = $db->prepare('INSERT INTO users (username, passwordHash, mail, inscription_date) VALUES (?, ?, ?, CURDATE())');
        $user->execute(array($username, $passwordHash, $mail));

        return $user;
    }
}

?>