<!-- Fichier pour la connexion à la base de données qui contient les 
fonctions afin de faire appel aux commentaires, commentaire ou poster un commentaire -->
<?php

require_once("model/manager.php");

class CommentManager extends Manager {

    public function getComments() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, id_Users, comment_text, id_Chapters, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date_fr FROM chapters ORDER BY comment_date DESC');

        return $req;
    }


    // A retravailler 
    public function postComment() {
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO comments (id, id_Users, comment_text, id_Chapter, DATE_FORMAT(comment_date, \'%d/%m/%Y\'))');

        return $req;
    }
}

?>