<!-- Fichier permettant de faire le head et le header avec la barre de navigation -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <!-- Lien vers le CSS -->
    <link rel="stylesheet" src="../public/css/style.css"/>
    <!-- Script jQuery + BootStrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <!-- Meta OG et Twitter -->
    <meta property="og:title" content="Jean Forteroche Blog">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="http://#">
    <meta property="og:images" content="">
    <meta property="og:site_name" content="Jean Forteroche Blog">
    <!-- Meta Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@BenjaminLeGuen">
    <meta name="twitter:title" content="Jean Forteroche Blog">
    <meta name="twitter:description" content="Blog de Jean Forteroche, voyage en Alaska">
    <meta name="twitter:creator" content="@BenjaminLeGuen">
    <meta name="twitter:url" content="http://#">
    <meta name="twitter:images:src" content="http://#">
</head>
<body>
    <header>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
            <a class="navbar-brand" href="http://localhost/jean_forteroche_blog/index.php">Jean Forteroche</a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarList">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse"  id="navbarList">
                <ul class="navbar-nav m-md-auto collapse">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/jean_forteroche_blog/index.php">Accueil</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                            Chapitre
                        </a>
                        <div class="dropdown-menu"> 
                        <?php
                            require_once('model/ChapterManager.php');

                            $chapterManager = new ChapterManager();
                            $chapters = $chapterManager->getAllChapters();
                            while($data = $chapters->fetch()) {
                        ?>
                            <a class="dropdown-item" href="index.php?action=chapter&amp;id=<?=$data['id'] ?>"> <?= htmlspecialchars($data['title']) ?></a>
                        <?php
                            }
                        ?>
                        </div>
                    </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?php 
                    if(isset($_SESSION['username'])) {
                        echo "<li class='nav-item '> <p>Bienvenue à toi mon ami "  . htmlspecialchars($_SESSION['username']). "</p></li>
                              <li class='nav-item'>
                                <p><a href='index.php?action=logout' title='Déconnexion'>Se déconnecter</a></p>
                              </li>";
                    } else {
                        echo "<li class='nav-item'>
                                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#connectModal'><i class='fas fa-sign-in-alt'></i> Login</button>
                             </li>

                            <!-- The Modal -->
                                <div class='modal fade' id='connectModal'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>

                                            <!-- Modal Header -->
                                            <div class='modal-header'>
                                                <h4 class='modal-title'>Espace de connexion</h4>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class='modal-body'>
                                                <form action='index.php?action=connection' method='post'>
                                                <div>
                                                    <label>Identifiant :</label>
                                                    <input name='username' type='text' placeholder='Veuillez rentrer votre pseudo'/>
                                                </div>
                                                <div>
                                                    <label>Mot de passe :</label>
                                                    <input name='passwordHash' type='password' placeholder='Veuillez rentrer votre mot de passe'/>
                                                </div>
                                                <div>
                                                    <input class='btn btn-primary' type='submit' value='Valider' />
                                                </div>
                                                </form>
                                                <div>
                                                    <p>Vous n'etes pas encore inscris, venez ici</p>
                                                    <a href='index.php?action=inscription'>Inscription</a>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>";
                    } ?>
                    
                </ul>
            </div>
        </nav>
    </div>
    </header>
    <?= $content ?>
</body>
</html>