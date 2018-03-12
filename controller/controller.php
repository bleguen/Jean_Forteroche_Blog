<!-- Le controleur fait appel aux modèles, prend la décision et renvoie les infos aux views -->
<?php 
require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');
require_once('model/UsersManager.php');

class Controller {

    private $chapterManager = NULL;
    private $commentsManager = NULL;
    private $usersManager = NULL;
    
    public function __construct() {
        $this->chapterManager = new ChapterManager();
        $this->commentsManager = new CommentManager();
        $this->usersManager = new UsersManager();
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

    public function addComment($id_Chapters, $id_Users, $comment_text ) {
        $comments = $this->commentsManager->postComment($id_Chapters, $id_Users, $comment_text );

        header('location: index.php?action=post&id=' .$id_Chapters);
    }
    
    public function pageInscription() {
        require('view/inscription.php');
    }

    public function inscription($username, $passwordHash, $mail) {

        $user = $this->usersManager->postUser($username, $passwordHash, $mail);

        header('location: index.php');
    }

    public function connection($username) {
        $user = $this->usersManager->getUser($username);
        echo var_dump($_POST['passwordHash']);
        echo var_dump($user['passwordHash']);
        $isPasswordCorrect = password_verify($_POST['passwordHash'], $user['passwordHash']);
        
        echo var_dump($isPasswordCorrect);

        if($isPasswordCorrect) {
            echo 'je suis la';
            $_SESSION['username'] = $user['username'];
            $connected = true;
            //header('location: index.php');
        } else {
            echo 'Erreur : ';
        }
    
        
    }
}


