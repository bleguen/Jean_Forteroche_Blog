<?php $title = "Gestion de compte" ?>

<?php ob_start(); ?>

<?php $content= ob_get_clean(); ?>
    <section id="gestionCompte" class="container-fluid">
        <div class="row">
            <h1 class="d-flex justify-content-center">Gestion de votre compte</h1><br>
            <div class="col-12 d-flex justify-content-center">
                

                <form  id="formAccount" action="index.php?action=updateUser" method="post" enctype="multipart/form-data">
                    
                    <div class="gestionForm form-group">
                    <h3>Changer votre avatar </h3>
                        <label for="avatar">Votre avatar : </label><br>
                        <img src="public/images/<?= htmlspecialchars($_SESSION['avatar']) ?>" alt="avatar" class="avatarGestion rounded-circle img-fluid"><br>
                        <label for="avatar">Fichier (tous formats | max. 1 Mo) :</label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000000" />
                        <input type="file" name="avatar" id="avatarInput" /><br>
                    </div>
                    
                    <div class="gestionForm form-group">
                        <h3>Changer votre e-mail </h3>
                        <p>Votre adresse e-mail actuelle :<br>
                        <?= htmlspecialchars($user['mail']) ?></p>
                        <label for="mail">Changer votre e-mail</label><br>
                        <input name='mail' type='email' placeholder='Nouvel adresse e-mail'><br>
                    </div>
                    
                    <div class="gestionForm form-group">
                        <h3>Changer votre mot de passe </h3>
                        <label for="">Mot de passe :</label><br>
                        <input name='passwordHash' type='password' placeholder='Votre nouveau mot de passe'><br>
                    </div>
                    <div class="gestionForm form-group">
                        <label for="passwordHashSecond"> Confirmation Mot de passe : </label><br>
                        <input name='passwordHashSecond' type='password' placeholder='Confirmer votre mot de passe'><br>
                    </div>
                    <input class="submitFormGestion btn btn-primary" type='submit' value='Submit'>
                </form>
            </div>
        </div>
    </section>
<?php require('template.php'); ?>