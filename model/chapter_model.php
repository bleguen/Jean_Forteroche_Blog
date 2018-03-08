<!-- Fichier pour la connexion à la base de données qui contient les 
fonctions afin de faire appel aux chapitres, chapitre -->

<?php

require_once("model/manager.php");

class ChapterManager extends Manager {
    
    public function getAllChapters () {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, chapter_img, chapter_texte, DATE_FORMAT(chapter_date, \'%d/%m/%Y\') AS chapter_date_fr FROM chapters ORDER BY chapter_date ASC LIMIT 0, 3');

        return $req;
    }

    public function getChapter ($id) {

        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, title, chapter_img, chapter_texte, DATE_FORMAT(chapter_date, '%d/%m/%Y') AS chapter_date_fr FROM chapters WHERE `id` = :id");
        $req->bindParam(":id", $id);
        $req->execute();
        $chapter = $req->fetch();

        return $chapter;
    }
    
}

?>