<?php

require_once("model/manager.php");

class UsersManager extends Manager {
    public function getUser($userId) {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, username, mail, password, DATE_FORMAT(inscription_date, \'%d/%m/%Y\') AS inscription_date_fr FROM users');
        $req = execute(array($userId));
        $user = $req->fetch();

        return $user;
    }
    // A retravailler
    public function postUser() {
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO comments (id, id_Users, comment_text, id_Chapter, DATE_FORMAT(comment_date, \'%d/%m/%Y\'))');
    }
}

?>