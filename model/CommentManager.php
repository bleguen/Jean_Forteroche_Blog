<!-- Fichier pour la connexion à la base de données qui contient les 
fonctions afin de faire appel aux commentaires, commentaire ou poster un commentaire -->
<?php

require_once("model/Manager.php");

class CommentManager extends Manager {
    
    public function getAllComments() {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT comments.id, id_Chapters,comment_text, reported, username FROM comments INNER JOIN users ON users.id = id_Users ORDER BY `reported` DESC");
        $req->execute();

        return $req;
    }
    
    public function getComments($id_Chapters) {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT comments.id, avatar, username, comment_text, id_Chapters, DATE_FORMAT(comment_date, '%d/%m/%Y') AS comment_date_fr FROM comments INNER JOIN users ON users.id = id_Users WHERE id_Chapters = ? ORDER BY comment_date DESC ");
        $req->execute(array($id_Chapters));
        $comments = $req->fetchAll();

        return $comments;
    }

    public function postComment($id_Chapters, $id_Users, $comment_text) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (id_Chapters, id_Users, comment_text, comment_date) VALUES(?,?,?, NOW())');
        $comments = $req->execute(array($id_Chapters, $id_Users, $comment_text ));

        return $comments;
    }


    public function reported($id) {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE `comments` SET `reported` = `reported`+1  WHERE `id` = ?");
        $req->execute(array($id));

        return $req;
    }

    public function updateComment($newText, $id) {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE `comments` SET `comment_text` = ? WHERE `id` = ?");
        $req->execute(array($newText, $id));

        return $req;
    }
    
    public function deleteAllComments($id_Chapters) {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM `comments` WHERE `id_Chapters` = ?");
        $req->execute(array($id_Chapters));

        return $req;
    }

    public function deleteComment($id) {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM `comments` WHERE `id` = ?");
        $req->execute(array($id));

        return $req;
    }
}

?>