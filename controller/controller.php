<!-- Le controleur fait appel aux modèles, prend la décision et renvoie les infos aux views -->
<?php 
require_once('model/chapter_model.php');
require_once('model/comment_model.php');
require_once('model/users_model.php');

function listChapters() {
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getAllChapters();

    require('view/chapters.php');
}

function chapter($id) {
    $chapterManager = new ChapterManager();
    $chapter = $chapterManager->getChapter($id);

    require('view/uniqueChapter.php');
}

function inscription() {
    require('view/inscription.php');
}