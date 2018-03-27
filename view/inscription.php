<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'incription -->

<?php $title = "Page inscription" ?>

<?php ob_start(); ?>

<section id="inscription" class="container-fluid">
    <div class="col-12">
    <h3>Inscription</h3>
        <form action='index.php?action=addUser' method='post'>
            <div class="form-group">
                <label for="usernameInscrip">Votre pseudo : </label><br>
                <input name='usernameInscrip' type='text' placeholder ='Pseudo'><br>
                <div class="unvalidUsername"></div>
            </div>
            <div class="form-group">
                <label for="passwordHashInscrip">Mot de passe :</label><br>
                <input name='passwordHashInscrip' type='password' placeholder='Votre mot de passe'><br>
                <div class="unvalidPassword"></div>
            </div>
            <div class="form-group">
                <label for="passwordHashSecondInscrip"> Confirmation Mot de passe : </label><br>
                <input name='passwordHashSecondInscrip' type='password' placeholder='Confirmer votre mot de passe'><br>
                <div class="unvalidPasswordSecond"></div>
            </div>
            <div class="form-group">
                <label for="mailInscrip">Adresse e-mail :</label><br>
                <input name='mailInscrip' type='email' placeholder='Votre e-mail'><br>
                <div class="unvalidEmail"></div>
            </div>
            <p class="validInscrip"></p>
            <input id="validInscription" class="btn btn-primary" type='submit' value='Envoyer'>
            
        </form>
    </div>
</section>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>