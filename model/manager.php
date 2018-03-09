<!-- Fichier pour la connexion à la base de données jean_forteroche -->

<?php

class Manager {
    protected function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
        return $db;
    }
}

?>