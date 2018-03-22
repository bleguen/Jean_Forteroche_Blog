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

    // Fonctions pour chapitres

    public function listChapters() {
        $chapters = $this->chapterManager->getAllChapters();

        require('view/chapters.php');
    }
    public function chapter($id) {
        
        $chapter = $this->chapterManager->getChapter($id);

        $comments = $this->commentsManager->getComments($id);

        require('view/uniqueChapter.php');
    }

    public function chapterInfos($id) {
        $chapter = $this->chapterManager->getChapter($id);

        require('view/updateChapter.php');
    }

    // Fonction pour la partie admin

    public function admin() {
        $chapters = $this->chapterManager->getAllChapters();
        $comments = $this->commentsManager->getAllComments();

        require('view/admin.php');
    }

    public function addChapter($title, $chapter_img, $chapter_text) {
        $newChapter = $this->chapterManager->createChapter($title, $chapter_img, $chapter_text);

        header('location: index.php?action=admin');
    }

    public function updateChapter($id, $title, $chapter_img, $chapter_text) {

        $updateChapter = $this->chapterManager->updateChapter($id, $title, $chapter_img, $chapter_text);

        header('location: index.php?action=admin');
    }

    public function imgTest($id) { 
        $chapter = $this->chapterManager->getChapter($id);
        if(empty($_FILES['mon_fichier']["name"])) {
            return $chapter['chapter_img'];
        } else {
            return ($_FILES['mon_fichier']["name"]);
        }
    }

    public function checkImagesForNewChapter($img) {

        $target_dir = "public/images/";
        $target_file = $target_dir . basename($_FILES["$img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["envoyer_article"])) {
            $check = getimagesize($_FILES["$img"]["tmp_name"]);
            if($check !== false) {
                throw new Exception ("Le fichier est une image : " . $check["mime"] . ".");
                $uploadOk = 1;
            } else {
                throw new Exception ("Le fichier n'est pas une iamge");
                $uploadOk = 0;
            }
        }
        
        // Check file size
        if ($_FILES["$img"]["size"] > 50000000) {
            throw new Exception ("Désolé votre image est trop grande");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            throw new Exception ("Désolé, seulement les extensions JPG, JPEG, PNG & GIF sont autorisé.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            throw new Exception ("Désolé, votre fichier n'as pas été téléchargé.");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["$img"]["tmp_name"], $target_file)) {
                throw new Exception ("Votre fichier ". basename( $_FILES["$img"]["name"]). " a été téléchargé.");
            } else {
                throw new Exception ("Désolé, votre fichier n'as pas été téléchargé");
            }
        }
    }

    public function deleteChapter($id) {
        $this->commentsManager->deleteAllComments($id);
        $deleteChapter = $this->chapterManager->deleteChapter($id);

        header('location: index.php?action=admin');
    }
    
    public function deleteComment($id) {
        $reported = $this->commentsManager->deleteComment($id);
        
        header('location: index.php?action=admin');
    }
    

    // Fonction pour les commentaires

    public function addComment($id_Chapters, $id_Users, $comment_text ) {
        
        $comments = $this->commentsManager->postComment($id_Chapters, $id_Users, $comment_text );

        header('location: index.php?action=chapter&id=' .$id_Chapters);
    }

    public function reported($id, $id_Chapters) {
        $reported = $this->commentsManager->reported($id);
        
        header('location: index.php?action=chapter&id=' .$id_Chapters);
    }

    public function updateComment($newText, $id, $id_Chapters) {
        $updateComment = $this->commentsManager->updateComment($newText, $id);

        header('location: index.php?action=chapter&id=' .$id_Chapters);
    }

    // Fonction pour la page d'inscription et connection deconnection
    
    public function pageInscription() {
        require('view/inscription.php');
    }

    public function inscription($username, $passwordHash, $mail) {

        $user = $this->usersManager->postUser($username, $passwordHash, $mail);

        header('location: index.php');
    }

    public function connection($username) {
        $user = $this->usersManager->getUser($username);

        $isPasswordCorrect = password_verify($_POST['passwordHash'], $user['passwordHash']);

        if($isPasswordCorrect) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['avatar'] = $user['avatar'];
            header('location: index.php');
            
        } else {
            throw new Exception ('Erreur : Mot de passe ou nom utilisateur incorrect ');
        } 
    }

    public function updateUser($avatar, $mail, $passwordHash, $username) {

        $user = $this->usersManager->getUser($username);

        if($avatar == NULL) {
            $avatar = $_SESSION['avatar'];
        } else {
            $this->checkImagesForNewChapter("avatar");
        }

        if($mail == NULL) {
            $mail = $user['mail'];
        } else {
            $this->checkEmail($_POST['mail']);
        }

        if($passwordHash == NULL) {
            $passwordHash = $user['passwordHash'];
        } else {
            $this->checkPasswordQuality($_POST['passwordHash']);
            $this->checkPasswordCompare($_POST['passwordHash'], $_POST['passwordHashSecond']);
            $passwordHash = password_hash($passwordHash, PASSWORD_DEFAULT);
        }

        $update = $this->usersManager->updateUser($avatar, $mail, $passwordHash, $username);

        $_SESSION['username'] = $user['username'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['avatar'] = $user['avatar'];

        header('location: index.php?action=accountManagement');
    }

    public function accountManagement($username) {
        $user = $this->usersManager->getUser($username);

        require('view/accountManagement.php');
    }

    public function deconnection() {
         // Destruction de la session 
         $_SESSION = array();
         session_destroy();
         session_start();
         header('location: index.php');
    }

    public function checkUsername($username) {
        $user = $this->usersManager->getUser($username);

        if($username == $user['username']) {
            throw new Exception ("Ce pseudo est déjà utilisé");
        }
        
        return preg_match (" #^[a-zA-Z0-9_]{5,16}$# " , $username);

    }

    public function checkPasswordQuality($pass) {
        if(preg_match("#\w{8,25}#", $pass) && preg_match("#[A-Z]+#", $pass) && preg_match("#[0-9]+#", $pass)) {
            return preg_match("#\w{8,25}#", $pass) && preg_match("#[A-Z]+#", $pass) && preg_match("#[0-9]+#", $pass);
        } else {
            throw new Exception ("Votre mot de passe doit avoir au minimum une majuscule et un chiffre et 8 caractères minimum");
        }
    }

    public function checkPasswordCompare($pass, $secondPass) {
        if($pass == $secondPass) {
            return true;
        } else {
            throw new Exception ("Les mots de passe ne correspondent pas");
        }
    }

    public function checkEmail($email) {
        return filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    }
}