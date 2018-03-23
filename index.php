<!-- Routeur, fait appel au bon controleur afin de faire afficher la bonne page en question -->

<?php 

session_start();

require('controller/Controller.php');

$controller = new Controller();

try {
    if(isset($_GET['action'])){
        // Pour afficher les chapitres
        if($_GET['action'] == 'chapter') {
            if(isset($_GET['id']) && $_GET['id']>0 ) {
                $controller->chapter($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        // Pour faire afficher la page presentation
        } elseif($_GET['action'] == 'presentation') {
            require('view/presentation.php');
        // Pour ajouter des commentaires
        } elseif ($_GET['action'] == 'addComment') {
            if(isset($_GET['id']) && $_GET['id']>0) {
                if(!empty($_POST['id_Users']) && !empty($_POST['comment_text'])) {
                    $controller->addComment( $_GET['id'], $_POST['id_Users'], $_POST['comment_text']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        // Pour signaler un commentaire
        } elseif($_GET['action'] == 'report') {
            $controller->reported($_GET['id'], $_GET['idChap']);
        // Pour modifier un commentaire
        } elseif($_GET['action'] == 'updateComment') {
            $controller->updateComment($_POST['newText'], $_GET['id'], $_GET['id_Chapters']);
        // Pour afficher la page d'inscription
        } elseif($_GET['action'] == 'inscription') {
            $controller->pageInscription();
        // Pour ajouter un utilisateur, controle du pseudo, des mdp et de l'email puis envoi vers bdd
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
        // Pour se connecter
        } elseif($_GET['action'] == 'connection') {
            $controller->connection($_POST['username'], $_POST['passwordHash']);
        // Pour se déconnecter
        } elseif ((isset($_GET['action'])) && ($_GET['action'] == 'logout')) {
           $controller->deconnection();
        // Pour accéder à la page d'administration 
        } elseif (isset($_SESSION['username'])) {
            if(($_SESSION['id'] == 1)) {
                // Pour afficher la page admin
                if($_GET['action'] == 'admin') {
                    $controller->admin();
                // Pour créer un nouveau chapitre
                } elseif($_GET['action'] == 'sendChapter') { 
                    if(isset($_POST['title'])) {
                        if (strlen($_POST['title']) > 0 && strlen($_FILES['mon_fichier']["name"]) >0) {
                            $controller->checkImagesForNewChapter("mon_fichier");
                            $controller->addChapter($_POST['title'], ($_FILES['mon_fichier']["name"]), $_POST['text']);
                        } else {
                            throw new Exception ("Il manque un titre ET/OU une image");
                        } 
                    } 
                    require('view/createChapter.php');
                // Pour supprimer un chapitre
                } elseif($_GET['action'] == 'deleteChapter') {
                    $controller->deleteChapter($_GET['id']);
                // Pour modifier un chapitre
                } elseif($_GET['action'] == 'updateChapter') {
                    if(isset($_POST['title'])) {
                        if (strlen($_POST['title']) > 0) {
                            $monImage = $controller->imgTest($_GET['id']);
                            $controller->updateChapter($_GET['id'], $_POST['title'], $monImage, $_POST['text']);
                        }
                    }
                    $controller->chapterInfos($_GET['id']);
                // Pour supprimer un commentaire
                } elseif($_GET['action'] == 'deleteComment') {
                    $controller->deleteComment($_GET['id']);
                }
            }
            // Pour accéder à la page gestion de compte
            if($_GET['action'] == 'accountManagement') {
                $controller->accountManagement($_SESSION['username']);
            // Pour mettre à jour les données utilisateur 
            } elseif ($_GET['action'] == 'updateUser') {
                    $controller->updateUser(($_FILES['avatar']["name"]), $_POST['mail'], $_POST['passwordHash'], $_SESSION['username']);
            }
        } else {
            throw new Exception ("Vous devez être connecté");
        }
    // Pour afficher la page d'accueil
    } else {
        $controller->listChapters();
    }
} catch(Exception $e) {
    $errors = $e->getMessage();
    require('view/getErrors.php');
}