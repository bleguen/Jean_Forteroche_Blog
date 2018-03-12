<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'incription -->

<?php $title = "Page inscription" ?>

<?php ob_start(); ?>

<section class="container-fluid">
    <h3>Inscription</h3>
    <form action='index.php?action=addUser' method='post'>
        Votre pseudo : <br>
        <input name='username' type='text' placeholder ='Pseudo'><br>
        Mot de passe :<br>
        <input name='passwordHash' type='password' placeholder='Votre mot de passe'><br>
        Confirmation Mot de passe : <br>
        <input name='passwordHashSecond' type='password' placeholder='Confirmer votre mot de passe'><br>
        Adresse e-mail : <br>
        <input name='mail' type='email' placeholder='Votre e-mail'><br>
        <br>
        <input type='submit' value='Submit'>
    </form>
</section>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>