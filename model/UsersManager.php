<?php

require_once("model/Manager.php");

class UsersManager extends Manager {

    public function getUser($username) {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT username, avatar,  passwordHash, id, mail  FROM users WHERE username =  '$username'");
        $req->execute(array($username));
        $user = $req->fetch();

        return $user;
    }
    
    public function postUser($username, $passwordHash, $mail) {

        $passwordHash = password_hash($passwordHash, PASSWORD_DEFAULT);

        $db = $this->dbConnect();
        $user = $db->prepare('INSERT INTO users (username, passwordHash, mail, inscription_date) VALUES (?, ?, ?, CURDATE())');
        $user->execute(array($username, $passwordHash, $mail));

        return $user;
    }

    public function updateUser($avatar, $mail, $passwordHash, $username) {

        $db = $this->dbConnect($avatar, $mail, $passwordHash, $username);
        $user = $db->prepare("UPDATE `users` SET `avatar`= ?, `mail`= ? ,`passwordHash`= ? WHERE `username` = ?");
        $user->execute(array($avatar, $mail, $passwordHash, $username));

        return $user;
    }
}

?>