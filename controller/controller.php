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

        header('location: index.php?action=chapter&id=' .$id_Chapters);
    }
    
    public function pageInscription() {
        require('view/inscription.php');
    }

    public function inscription($username, $passwordHash, $mail) {

        $user = $this->usersManager->postUser($username, $passwordHash, $mail);

        //header('location: index.php');
    }

    public function connection($username) {
        $user = $this->usersManager->getUser($username);

        $isPasswordCorrect = password_verify($_POST['passwordHash'], $user['passwordHash']);

        if($isPasswordCorrect) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];
            header('location: index.php');
            
        } else {
            echo 'Erreur : Mot de passe ou nom utilisateur incorrect ';
        } 
    }

    public function deconnection() {
         // Destruction de la session ?
         $_SESSION = array();
         session_destroy();
         session_start();
         header('location: index.php');
    }

    public function checkUsername($username) {
        $user = $this->usersManager->getUser($username);

        if($username == $user['username']) {
            echo "Ce pseudo est déjà utilisé";
        }
        
        return preg_match (" #^[a-zA-Z0-9_]{5,16}$# " , $username);

    }

    public function checkPasswordQuality($pass) {
        return preg_match("#\w{8,25}#", $pass) && preg_match("#[A-Z]+#", $pass) && preg_match("#[0-9]+#", $pass);
    }

    public function checkPasswordCompare($pass, $secondPass) {
        if($pass == $secondPass) {
            return true;
        } else {
            echo "Les mots de passe ne correspondent pas";
        }
    }

    public function checkEmail($email) {
        return filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    }
}