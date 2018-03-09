<!-- Le controleur fait appel aux modèles, prend la décision et renvoie les infos aux views -->
<?php 
require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');
require_once('model/UsersManager.php');

class Controller {

    private $chapterManager = NULL;
    private $commentsManager = NULL;
    
    public function __construct() {
        $this->chapterManager = new ChapterManager();
        $this->commentsManager = new CommentManager();
    }

    public function listChapters() {
        $chapters = $this->chapterManager->getAllChapters();

        require('view/chapters.php');
    }
    public function chapter($id) {
        
        $chapter = $this->chapterManager->getChapter($id);

        $comments = $this->commentsManager->getComments($id);
    
        require('view/uniqueChapter.php');
    }
    
    public function inscription() {
        require('view/inscription.php');
    }
}


