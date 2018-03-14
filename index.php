<!-- Routeur, fait appel au bon controleur afin de faire afficher la bonne page en question -->

<?php 

session_start();

require('controller/controller.php');

$controller = new Controller();

try {
    if(isset($_GET['action'])){
        if($_GET['action'] == 'chapter') {
            if(isset($_GET['id']) && $_GET['id']>0) {
                $controller->chapter($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if(isset($_GET['id']) && $_GET['id']>0) {
                if(!empty($_POST['id_Users']) && !empty($_POST['comment_text'])) {
                    $controller->addComment($_GET['id'], $_POST['id_Users'], $_POST['comment_text']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif($_GET['action'] == 'inscription') {
            $controller->pageInscription();
        } elseif($_GET['action'] == 'addUser') {
            if(isset($_POST['username']) && $controller->checkUsername($_POST['username'])) {
                if(isset($_POST['passwordHash']) && $controller->checkPasswordCompare($_POST['passwordHash'], $_POST['passwordHashSecond']) && $controller->checkPasswordQuality($_POST['passwordHash'])) {
                    if (!$controller->checkEmail($_POST['mail'])) {
                        throw new Exception('L"email ne me convient pas !');
                    } else {
                        $controller->inscription($_POST['username'], $_POST['passwordHash'], $_POST['mail']);
                    }
                } else {
                    throw new Exception('Les mots de passe ne correspond pas au attente, vérifier sa longueur, une minuscule, majuscule etc !');
                }
            } else {
                throw new Exception('Nom d\'utilisateur ne respecte pas les règles !');
            }
            
        } elseif($_GET['action'] == 'connection') {
            $controller->connection($_POST['username'], $_POST['passwordHash']);
        } elseif ((isset($_GET['action'])) && ($_GET['action'] == 'logout')) {
           $controller->deconnection();
        } elseif($_GET['action'] == 'sendChapter') { 
            if(isset($_POST['title'])) {
                $controller->checkFilesForNewChapter();
                $controller->addChapter($_POST['title'], ($_FILES['mon_fichier']["name"]), $_POST['text']);
            }
            require('view/createChapter.php');
        } elseif($_GET['action'] == 'admin') {
            $controller->admin();
        } else {
            echo "erreur";
        }
    
    } else {
        $controller->listChapters();
    }
} catch(Exception $e) {
    echo 'Erreur :' . $e->getMessage();
}
