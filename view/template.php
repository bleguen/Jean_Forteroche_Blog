<!-- Fichier permettant de faire le head et le header avec la barre de navigation -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Blog écrivain de Jean Forteroche">
    <meta name="keywords" content="Blog, écrivain, Jean, Forteroche, chapitre, alaska, faune, montagne">
    <meta name="author" content="Jean Forteroche">
    <title><?= $title ?></title>
    <!-- Script jQuery + BootStrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="public/js/script.js"></script>
    <!-- Lien vers le CSS -->
    <link rel="stylesheet" href="public/css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
    <!-- TinyMCE -->
    <script src="tinymce/js/tinymce/tinymce.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            theme : "modern",
            language: "fr_FR",
            height: 450,
            branding: false,
            plugins: [
                "advlist autolink save link lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
            ],
            toolbar1: " fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
            toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor | insertdatetime preview | forecolor backcolor",
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'],

            toolbar_items_size: 'medium',
        });
     </script>
    <!-- Meta OG et Twitter -->
    <meta property="og:title" content="Jean Forteroche Blog">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="http://#">
    <meta property="og:images" content="../images/alaska_accueil.jpg">
    <meta property="og:site_name" content="Jean Forteroche Blog">
    <!-- Meta Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@BenjaminLeGuen">
    <meta name="twitter:title" content="Jean Forteroche Blog">
    <meta name="twitter:description" content="Blog de Jean Forteroche, voyage en Alaska">
    <meta name="twitter:creator" content="@BenjaminLeGuen">
    <meta name="twitter:url" content="http://#">
    <meta name="twitter:images:src" content="../images/alaska_accueil.jpg">
</head>
<body>
    <header >
    <div id="myHeader" class="container-fluid" >
        <nav id="navbar" class="navbar fixed-top navbar-default navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="http://localhost/jean_forteroche_blog/index.php"><h1>Jean Forteroche</h1></a>
            <!-- Toggler/collapsibe Button -->
            <button id="burger" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarList">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse"  id="navbarList">
                <ul class="navbar-nav m-md-auto collapse">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/jean_forteroche_blog/index.php">Accueil</a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?action=presentation">Présentation</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                            Chapitres
                        </a>
                        <div class="dropdown-menu"> 
                            <?php include'dropdownChapter.php'; ?>
                        </div>
                    </li>
                            <?php include'navAdministration.php'; ?>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <?php 
                    if(isset($_SESSION['username'])) { ?>
                        
                        <li id="avatar" class='nav-item dropdown'>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuAvatar" data-toggle="dropdown">
                                <img src="public/images/<?= htmlspecialchars($_SESSION['avatar']) ?>" alt="avatar" class="avatar rounded-circle img-fluid">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                    <a class='dropdown-item' href="index.php?action=accountManagement">Gestion Compte</a>
                                    <a class='dropdown-item btn btn-danger border-0' href='index.php?action=logout' title='Déconnexion'>Se déconnecter <i class="fas fa-sign-out-alt"></i></a>
                            </div>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class='nav-item'>
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
                                            <div class="mb-1">
                                                <label for="username">Identifiant :</label><br>
                                                <input name='username' type='text' placeholder='Votre pseudo'/>
                                            </div>
                                            <div>
                                                <label for="passwordHash">Mot de passe :</label><br>
                                                <input name='passwordHash' type='password' placeholder='Votre mot de passe'/>
                                            </div>
                                            <div>
                                                <br>
                                                <input class='btn btn-primary' type='submit' value='Valider' />
                                            </div>
                                        </form>
                                        <div class=" row mt-3">
                                            <p class="col-md-8 align-self-center m-0">Vous n'etes pas encore inscris, cliquez-ici : </p>
                                            <a class="col-md-3 mr-1 btn btn-primary" href='index.php?action=inscription'>Inscription</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </div>
    </header>
    <?= $content ?>
    <footer id="footer" class="container-fluid">
        <div class="col-12 d-flex justify-content-center mt-3">
            <p>Benjamin Le Guen &#169;Copyright All rights reserved</p>
        </div>
    </footer>
</body>
</html>