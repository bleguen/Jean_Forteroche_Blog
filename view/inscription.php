<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'incription -->

<?php $title = "Page inscription" ?>

<?php ob_start(); ?>

<section id="inscription" class="container-fluid">
    <div class="col-12">
    <h3>Inscription</h3>
        <form action='index.php?action=addUser' method='post'>
            <div class="form-group">
                <label for="username">Votre pseudo : </label><br>
                <input name='username' type='text' placeholder ='Pseudo'><br>
            </div>
            <div class="form-group">
                <label for="passwordHash">Mot de passe :</label><br>
                <input name='passwordHash' type='password' placeholder='Votre mot de passe'><br>
            </div>
            <div class="form-group">
                <label for="passwordHashSecond"> Confirmation Mot de passe : </label><br>
                <input name='passwordHashSecond' type='password' placeholder='Confirmer votre mot de passe'><br>
            </div>
            <div class="form-group">
                <label for="mail">Adresse e-mail :</label><br>
                <input name='mail' type='email' placeholder='Votre e-mail'><br>
            </div>
            <input class="btn btn-primary" type='submit' value='Submit'>
        </form>
    </div>
</section>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>