<!-- Fichier pour la connexion à la base de données qui contient les 
fonctions afin de faire appel aux commentaires, commentaire ou poster un commentaire -->
<?php

require_once("model/manager.php");

class CommentManager extends Manager {

    public function getComments($id_Chapters) {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT comments.id, username, comment_text, id_Chapters, DATE_FORMAT(comment_date, '%d/%m/%Y') AS comment_date_fr FROM comments INNER JOIN users ON users.id = id_Users WHERE id_Chapters = ? ORDER BY comment_date DESC ");
        $req->execute(array($id_Chapters));
        $comments = $req->fetchAll();

        return $comments;
    }

    public function postComment() {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (id, id_Users, comment_text, id_Chapter, DATE_FORMAT(comment_date, \'%d/%m/%Y\'))');
        $req->execute();

        return $req;
    }
}

?>