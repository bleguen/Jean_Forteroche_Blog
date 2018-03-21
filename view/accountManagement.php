<?php $title = "Gestion de compte" ?>

<?php ob_start(); ?>

<?php $content= ob_get_clean(); ?>
    <section id="gestionCompte" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Gestion de votre compte</h1>

                <form action="index.php?action=updateUser" method="post" enctype="multipart/form-data">
                    <h2>Changer votre avatar </h2>
                    <div class="form-group">
                        <label for="avatar">Votre avatar : </label><br>
                        <?= htmlspecialchars($_SESSION['avatar']) ?>
                        <label for="avatar">Fichier (tous formats | max. 1 Mo) :</label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000000" />
                        <input type="file" name="avatar" id="avatar" /><br>
                    </div>
                    <h2>Changer votre e-mail </h2>
                    <div class="form-group">
                        <p>Votre adresse e-mail actuelle : <?= htmlspecialchars($user['mail']) ?></p>
                        <label for="mail">Changer votre e-mail</label><br>
                        <input name='mail' type='email' placeholder='Nouvel adresse e-mail'><br>
                    </div>
                    <h2>Changer votre mot de passe </h2>
                    <div class="form-group">
                        <label for="">Mot de passe :</label><br>
                        <input name='passwordHash' type='password' placeholder='Votre nouveau mot de passe'><br>
                    </div>
                    <div class="form-group">
                        <label for="passwordHashSecond"> Confirmation Mot de passe : </label><br>
                        <input name='passwordHashSecond' type='password' placeholder='Confirmer votre mot de passe'><br>
                    </div>
                    <input class="btn btn-primary" type='submit' value='Submit'>
                </form>
            </div>
        </div>
    </section>
<?php require('template.php'); ?>